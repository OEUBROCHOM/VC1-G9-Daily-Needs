<?php
require_once "Models/ProductModel.php";
require_once "Models/CartModel.php";
require_once "Models/UserModel.php"; // Add UserModel
require_once "Models/LocationModel.php"; // Add LocationModel
require_once "Models/PaymentModelF.php"; // Use PaymentModelF instead of PaymentModel
require_once "Models/OrderModel.php"; // Add OrderModel

class CartController extends BasecustomerController {
    private $cartModel;
    private $productModel;
    private $userModel;
    private $locationModel;
    private $paymentModelF; // Rename to paymentModelF
    private $orderModel;

    public function __construct() {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel(); // Initialize UserModel
        $this->locationModel = new LocationModel(); // Initialize LocationModel
        $this->paymentModelF = new PaymentModelF(); // Initialize PaymentModelF
        $this->orderModel = new OrderModel(); // Initialize OrderModel
    }

    // Add item to cart
    public function add() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        $product_id = $this->getPost('product_id');
        $quantity = $this->getPost('quantity', 1);

        error_log("Adding to cart: user_id=$user_id, product_id=$product_id, quantity=$quantity");

        if ($quantity < 1) {
            error_log("Quantity validation failed");
            $this->jsonResponse(false, 'Quantity must be at least 1');
        }

        $product = $this->productModel->getProductById($product_id);
        if (!$product) {
            error_log("Product not found: product_id=$product_id");
            $this->jsonResponse(false, 'Product not found');
        }

        if ($product['stockquantity'] < $quantity) {
            error_log("Insufficient stock: product_id=$product_id, stock={$product['stockquantity']}, requested=$quantity");
            $this->jsonResponse(false, 'Not enough stock available');
        }

        try {
            $success = $this->cartModel->addItem($user_id, $product_id, $quantity);
            if ($success) {
                error_log("Successfully added to cart: user_id=$user_id, product_id=$product_id");
            } else {
                error_log("Failed to add to cart: user_id=$user_id, product_id=$product_id");
            }
            $this->jsonResponse($success, $success ? 'Item added to cart' : 'Failed to add item');
        } catch (Exception $e) {
            error_log("Exception while adding to cart: " . $e->getMessage());
            $this->jsonResponse(false, 'Error: ' . $e->getMessage());
        }
    }

    // Get cart items for the user
    public function getItems() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        try {
            $items = $this->cartModel->getCartItems($user_id);
            error_log("Fetched cart items for user_id=$user_id, items_count=" . count($items));
            $this->jsonResponse(true, 'Cart items retrieved', $items);
        } catch (Exception $e) {
            error_log("Exception while fetching cart items: " . $e->getMessage());
            $this->jsonResponse(false, 'Error fetching cart items: ' . $e->getMessage());
        }
    }

    // Remove item from cart
    public function remove() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        $product_id = $this->getPost('product_id');
        
        try {
            $success = $this->cartModel->removeItem($user_id, $product_id);
            if ($success) {
                error_log("Successfully removed from cart: user_id=$user_id, product_id=$product_id");
            } else {
                error_log("Failed to remove from cart: user_id=$user_id, product_id=$product_id");
            }
            $this->jsonResponse($success, $success ? 'Item removed from cart' : 'Failed to remove item');
        } catch (Exception $e) {
            error_log("Exception while removing from cart: " . $e->getMessage());
            $this->jsonResponse(false, 'Error: ' . $e->getMessage());
        }
    }

    // Helper methods
    private function verifyUserLoggedIn() {
        if (!isset($_SESSION['user_id'])) {
            error_log("User not logged in");
            $this->jsonResponse(false, 'User not logged in');
        }
    }

    private function getPost($key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    private function jsonResponse($success, $message = '', $data = []) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }

    public function viewcart() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        try {
            $cartItems = $this->cartModel->getCartItems($user_id);
            error_log("Fetched cart items for user_id=$user_id, items_count=" . count($cartItems));
            
            // Pass the cart items to the view
            $this->view('pages/payment/viewcart', ['cartItems' => $cartItems]);
        } catch (Exception $e) {
            error_log("Exception while fetching cart items: " . $e->getMessage());
            $this->view('pages/payment/viewcart', ['cartItems' => [], 'error' => 'Error fetching cart items']);
        }
    }

    // Checkout 
    public function checkout() {
        $this->verifyUserLoggedIn();
        $user_id = $_SESSION['user_id'];
    
        try {
            $cartItems = $this->cartModel->getCartItems($user_id);
            if (empty($cartItems)) {
                $this->view('pages/payment/checkout', ['cartItems' => [], 'error' => 'Cart is empty']);
                return;
            }
    
            // Fetch user details
            $user = $this->userModel->getUserById($user_id);
    
            // Fetch shipping locations
            $locations = $this->locationModel->getAllLocations();
            error_log("CartController::checkout - Fetched locations: " . print_r($locations, true));
    
            $this->view('pages/payment/checkout', [
                'cartItems' => $cartItems,
                'user' => $user,
                'locations' => $locations
            ]);
        } catch (Exception $e) {
            error_log("Exception in checkout: " . $e->getMessage());
            $this->view('pages/payment/checkout', [
                'cartItems' => [],
                'error' => 'Error loading checkout: ' . $e->getMessage()
            ]);
        }
    }

    // Process checkout form submission
    public function process() {
        $this->verifyUserLoggedIn();
        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(false, 'Invalid request method');
        }

        $cart_items = $_POST['cart_items'] ?? [];
        $total_price = floatval($_POST['total_price'] ?? 0);
        $currency = $_POST['currency'] ?? 'USD';
        $location_id = intval($_POST['location_id'] ?? 0);
        $order_status = $_POST['order_status'] ?? 'Pending';
        $card_holder_name = $_POST['card_holder_name'] ?? '';
        $card_number = $_POST['card_number'] ?? '';
        $expiry_date = $_POST['expiry_date'] ?? '';
        $cvv = $_POST['cvv'] ?? '';

        // Log the raw inputs for debugging
        error_log("CartController::process - Raw inputs: card_number=$card_number, card_holder_name=$card_holder_name, expiry_date=$expiry_date, cvv=$cvv, currency=$currency");

        // Validate inputs
        if (empty($cart_items) || $total_price <= 0 || empty($location_id) || empty($card_holder_name) || empty($card_number) || empty($expiry_date) || empty($cvv)) {
            $this->jsonResponse(false, 'Missing required fields');
        }

        try {
            // Save payment method using PaymentModelF
            $payment_method_id = $this->paymentModelF->savePaymentMethod($user_id, $card_number, $card_holder_name, $expiry_date, $cvv, $currency);

            // Create order
            $order_id = $this->orderModel->createOrder($user_id, $payment_method_id, $location_id, $total_price, $order_status, $currency);

            // Save order items
            foreach ($cart_items as $item) {
                $product_id = $item['product_id'];
                $quantity = $item['quantity'];
                $this->orderModel->addOrderItem($order_id, $product_id, $quantity);
            }

            // Clear the cart
            $this->cartModel->clearCart($user_id);

            // Redirect to confirm payment page with order ID
            $this->jsonResponse(true, 'Order created successfully', ['order_id' => $order_id]);
        } catch (Exception $e) {
            error_log("Error processing checkout: " . $e->getMessage());
            $this->jsonResponse(false, 'Error processing order: ' . $e->getMessage());
        }
    }

    // Update quantity of an item in the cart
    public function update() {
        $this->verifyUserLoggedIn();
        
        $user_id = $_SESSION['user_id'];
        $product_id = $this->getPost('product_id');
        $quantity = $this->getPost('quantity', 1);
    
        error_log("Updating cart: user_id=$user_id, product_id=$product_id, quantity=$quantity");
    
        if ($quantity < 1) {
            error_log("Quantity validation failed");
            $this->jsonResponse(false, 'Quantity must be at least 1');
        }
    
        $product = $this->productModel->getProductById($product_id);
        if (!$product) {
            error_log("Product not found: product_id=$product_id");
            $this->jsonResponse(false, 'Product not found');
        }
    
        if ($product['stockquantity'] < $quantity) {
            error_log("Insufficient stock: product_id=$product_id, stock={$product['stockquantity']}, requested=$quantity");
            $this->jsonResponse(false, 'Not enough stock available');
        }
    
        try {
            $success = $this->cartModel->updateItem($user_id, $product_id, $quantity);
            error_log("Update result: " . ($success ? 'true' : 'false'));
            if ($success) {
                error_log("Successfully updated cart: user_id=$user_id, product_id=$product_id");
            } else {
                error_log("Failed to update cart: user_id=$user_id, product_id=$product_id");
            }
            $this->jsonResponse($success, $success ? 'Quantity updated' : 'Failed to update quantity');
        } catch (Exception $e) {
            error_log("Exception while updating cart: " . $e->getMessage());
            $this->jsonResponse(false, 'Error: ' . $e->getMessage());
        }
    }
}