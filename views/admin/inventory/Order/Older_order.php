<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pagination settings
    $itemsPerPage = 10;
    $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Define "older" range (older than 24 hours)
    $todayStart = date('Y-m-d H:i:s', strtotime('-24 hours'));

    // Get total number of older orders
    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE orderdate < :todayStart");
    $totalStmt->bindValue(':todayStart', $todayStart);
    $totalStmt->execute();
    $totalOrders = $totalStmt->fetchColumn();
    $totalPages = ceil($totalOrders / $itemsPerPage);

    // Fetch older orders for the current page
    $stmt = $conn->prepare("
        SELECT o.*, u.username, u.profile AS user_profile, u.phone
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        WHERE o.orderdate < :todayStart
        ORDER BY o.orderdate ASC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':todayStart', $todayStart);
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
    $totalPages = 1;
    $currentPage = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Older Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
    <style>
        /* Custom scrollbar */
        .scrollable-table {
            max-height: 60vh;
            overflow-y: scroll;
        }
        
        /* Make scrollbar always visible */
        .scrollable-table::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 10px;
        }
        
        /* Sticky header */
        .sticky-header thead tr th {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #2C4A6B;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .modal-content img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .status-pending {
            color: #D97706; /* Amber color for Pending */
        }

        .status-delivered {
            color: #16A34A; /* Green for Delivered */
        }

        .status-cancelled {
            color: #DC2626; /* Red for Cancelled */
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-white text-black border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Older Orders</h2>
                    <div class="relative">
                        <input type="text" id="search" 
                               placeholder="Search orders..." 
                               class="pl-10 pr-4 py-2 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="scrollable-table">
                <table class="w-full sticky-header">
                    <thead class="bg-[#2C4A6B] text-white">
                        <tr>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">No</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Phone</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Customer</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Payment</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Date</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Total</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody id="older-orders" class="divide-y divide-gray-200 bg-white">
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="8" class="py-6 px-6 text-center text-gray-600 text-lg">No older orders available.</td>
                            </tr>
                        <?php else: ?>
                            <?php $rowNumber = ($currentPage - 1) * $itemsPerPage + 1; ?>
                            <?php foreach ($orders as $index => $order): ?>
                                <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : 'bg-white'; ?> hover:bg-teal-50 transition" data-order-id="<?php echo $order['id']; ?>">
                                    <td class="py-4 px-6 text-blue-600 font-medium"><?php echo $rowNumber; ?></td>
                                    <td class="py-4 px-6 text-gray-800 font-medium"><?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?></td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <img src="<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>" 
                                                 class="w-10 h-10 rounded-full mr-3 border-2 border-purple-300" alt="Profile">
                                            <span class="text-gray-800 font-medium"><?php echo htmlspecialchars($order['username'] ?? 'Unknown Customer'); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-green-600"><?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?></td>
                                    <td class="py-4 px-6 text-gray-700"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></td>
                                    <td class="py-4 px-6">
                                        <span class="status-cell inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php 
                                            echo $order['orderstatus'] === 'Delivered' ? 'bg-green-200 text-green-800' : 
                                                 ($order['orderstatus'] === 'Pending' ? 'bg-yellow-200 text-yellow-800' : 
                                                 'bg-red-200 text-red-800'); 
                                        ?>">
                                            <?php echo htmlspecialchars($order['orderstatus']); ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-purple-600 font-semibold">$<?php echo number_format($order['totalprice'], 2); ?></td>
                                    <td class="py-4 px-6 relative">
                                        <button class="text-gray-600 hover:text-teal-600 transition text-xl p-2 rounded-full hover:bg-gray-100"
                                            onclick="toggleDropdown('dropdown-<?php echo $order['id']; ?>')">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div id="dropdown-<?php echo $order['id']; ?>"
                                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">
                                            <button onclick="showDetails('<?php echo $order['id']; ?>', '<?php echo htmlspecialchars($order['username'] ?? 'Unknown Customer'); ?>', 
                                                '<?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?>', '<?php echo htmlspecialchars($order['user_profile'] ?? 'https://i.pravatar.cc/40'); ?>', 
                                                '<?php echo htmlspecialchars($order['payments'] ?? 'N/A'); ?>', '<?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?>', 
                                                '<?php echo htmlspecialchars($order['orderstatus']); ?>', '<?php echo number_format($order['totalprice'], 2); ?>')"
                                                class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 w-full text-left">
                                                <i class="fas fa-eye mr-3 text-lg"></i> View Details
                                            </button>
                                            <button onclick="showEdit('<?php echo $order['id']; ?>', '<?php echo htmlspecialchars($order['orderstatus']); ?>')"
                                                class="flex items-center px-4 py-3 text-sm text-green-600 hover:bg-green-50 w-full text-left">
                                                <i class="fas fa-pen mr-3 text-lg"></i> Edit
                                            </button>
                                            <button onclick="showDelete('<?php echo $order['id']; ?>')"
                                                class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                                <i class="fas fa-trash mr-3 text-lg"></i> Delete
                                            </button>
                                            <button onclick="showMessage('<?php echo $order['id']; ?>')"
                                                class="flex items-center px-4 py-3 text-sm text-purple-600 hover:bg-purple-50 w-full text-left">
                                                <i class="fas fa-envelope mr-3 text-lg"></i> Message
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php $rowNumber++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 bg-gray-50 flex justify-between items-center">
                <a href="?page=<?php echo $currentPage > 1 ? $currentPage - 1 : 1; ?>" 
                   class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition <?php echo $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                    Previous
                </a>
                <span class="text-gray-700 font-medium">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
                <a href="?page=<?php echo $currentPage < $totalPages ? $currentPage + 1 : $totalPages; ?>" 
                   class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition <?php echo $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                    Next
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Container for View Details -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">×</span>
            <h2 class="text-xl font-bold mb-4">Order Details</h2>
            <div class="flex items-center mb-4">
                <img id="modalProfile" src="" alt="Profile">
                <div>
                    <p id="modalUsername" class="font-semibold"></p>
                    <p id="modalPhone" class="text-gray-600 text-sm"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 mb-4">
                <div>
                    <p class="text-gray-600 text-sm">Order ID:</p>
                    <p id="modalOrderId" class="font-medium"></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Date:</p>
                    <p id="modalOrderDate" class="font-medium"></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Payment:</p>
                    <p id="modalPayment" class="font-medium text-green-600"></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Status:</p>
                    <p id="modalStatus" class="font-medium"></p>
                </div>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Total:</p>
                <p id="modalTotal" class="font-semibold text-lg text-purple-600"></p>
            </div>
        </div>
    </div>

    <!-- Modal Container for Edit Order -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">×</span>
            <h2 class="text-xl font-bold mb-4">Edit Order</h2>
            <form id="editOrderForm">
                <input type="hidden" id="editOrderId" name="orderId">
                <div class="mb-4">
                    <label for="editOrderStatus" class="block text-gray-600 text-sm mb-2">Order Status</label>
                    <select id="editOrderStatus" name="orderStatus" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        <option value="Pending">Pending</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Modal Container for Send Message -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">×</span>
            <h2 class="text-xl font-bold mb-4">Send Message</h2>
            <form id="sendMessageForm">
                <input type="hidden" id="messageOrderId" name="orderId">
                <div class="mb-4">
                    <label for="messageContent" class="block text-gray-600 text-sm mb-2">Message</label>
                    <textarea id="messageContent" name="messageContent" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-teal-300" rows="4" placeholder="Type your message here..."></textarea>
                </div>
                <button type="submit" class="w-full bg-purple-500 text-white py-2 rounded-lg hover:bg-purple-600 transition">Send Message</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.getElementById("search").addEventListener("input", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#older-orders tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });

        function toggleDropdown(id) {
            // Close all dropdowns first
            const dropdowns = document.querySelectorAll("[id^='dropdown-']");
            dropdowns.forEach(dropdown => {
                if (dropdown.id !== id) {
                    dropdown.classList.add("hidden");
                }
            });

            // Toggle the clicked dropdown
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle("hidden");
        }

        document.addEventListener("click", function (event) {
            const dropdowns = document.querySelectorAll("[id^='dropdown-']");
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target) && !event.target.closest("button")) {
                    dropdown.classList.add("hidden");
                }
            });
        });

        // Function to show the order details in a modal
        function showDetails(id, username, phone, profile, payments, orderdate, orderstatus, totalprice) {
            const modal = document.getElementById("orderModal");
            const modalProfile = document.getElementById("modalProfile");
            const modalUsername = document.getElementById("modalUsername");
            const modalPhone = document.getElementById("modalPhone");
            const modalOrderId = document.getElementById("modalOrderId");
            const modalOrderDate = document.getElementById("modalOrderDate");
            const modalPayment = document.getElementById("modalPayment");
            const modalStatus = document.getElementById("modalStatus");
            const modalTotal = document.getElementById("modalTotal");

            modalProfile.src = profile;
            modalUsername.textContent = username;
            modalPhone.textContent = phone;
            modalOrderId.textContent = id;
            modalOrderDate.textContent = orderdate;
            modalPayment.textContent = payments;
            modalStatus.textContent = orderstatus;
            modalTotal.textContent = `$ ${totalprice}`;

            modalStatus.classList.remove("status-pending", "status-delivered", "status-cancelled");
            if (orderstatus.toLowerCase() === "pending") {
                modalStatus.classList.add("status-pending");
            } else if (orderstatus.toLowerCase() === "delivered") {
                modalStatus.classList.add("status-delivered");
            } else if (orderstatus.toLowerCase() === "cancelled") {
                modalStatus.classList.add("status-cancelled");
            }

            modal.style.display = "flex";

            const closeBtn = document.querySelector("#orderModal .modal-close");
            closeBtn.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };
        }

        // Function to show the edit order modal
        function showEdit(id, orderstatus) {
            const modal = document.getElementById("editModal");
            const orderIdInput = document.getElementById("editOrderId");
            const statusSelect = document.getElementById("editOrderStatus");

            orderIdInput.value = id;
            statusSelect.value = orderstatus;

            modal.style.display = "flex";

            const closeBtn = document.querySelector("#editModal .modal-close");
            closeBtn.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };
        }

        // Handle form submission for editing order status
        document.getElementById("editOrderForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const orderId = document.getElementById("editOrderId").value;
            const newStatus = document.getElementById("editOrderStatus").value;

            fetch("update_order_status.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `orderId=${orderId}&orderStatus=${newStatus}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Order status updated successfully!");
                    const statusCell = document.querySelector(`#older-orders tr[data-order-id="${orderId}"] .status-cell`);
                    if (statusCell) {
                        statusCell.textContent = newStatus;
                        statusCell.className = "inline-flex items-center px-3 py-1 rounded-full text-sm font-medium " + 
                            (newStatus === "Delivered" ? "bg-green-200 text-green-800" : 
                            (newStatus === "Pending" ? "bg-yellow-200 text-yellow-800" : "bg-red-200 text-red-800"));
                    }
                    document.getElementById("editModal").style.display = "none";
                    location.reload();
                } else {
                    alert("Failed to update order status: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while updating the order status.");
            });
        });

        // Function to show the send message modal
        function showMessage(id) {
            const modal = document.getElementById("messageModal");
            const orderIdInput = document.getElementById("messageOrderId");

            orderIdInput.value = id;

            modal.style.display = "flex";

            const closeBtn = document.querySelector("#messageModal .modal-close");
            closeBtn.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };
        }

        // Handle form submission for sending a message
        document.getElementById("sendMessageForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const orderId = document.getElementById("messageOrderId").value;
            const messageContent = document.getElementById("messageContent").value;

            if (!messageContent.trim()) {
                alert("Please enter a message.");
                return;
            }

            fetch("send_message.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `orderId=${orderId}&messageContent=${encodeURIComponent(messageContent)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Message sent successfully!");
                    document.getElementById("messageModal").style.display = "none";
                    document.getElementById("messageContent").value = ""; // Clear the textarea
                } else {
                    alert("Failed to send message: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while sending the message.");
            });
        });

        function showDelete(id) {
            if (confirm(`Are you sure you want to delete Order ID: ${id}?`)) {
                alert(`Delete Order ID: ${id}`);
                // Add your delete logic here
            }
        }
    </script>

<?php $conn = null; ?>
</body>
</html>