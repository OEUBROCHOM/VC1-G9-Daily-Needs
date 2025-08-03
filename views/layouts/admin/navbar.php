<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

function sendTelegramMessage($chatId, $message, $botToken) {
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        error_log("Failed to send Telegram message: " . print_r($http_response_header, true));
    }
    return $result;
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $todayStart = date('Y-m-d H:i:s', strtotime('-24 hours'));

    $totalStmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE orderdate >= :todayStart");
    $totalStmt->bindValue(':todayStart', $todayStart);
    $totalStmt->execute();
    $totalOrders = $totalStmt->fetchColumn();

    $stmt = $conn->prepare("
        SELECT o.*, u.username, u.profile AS user_profile, u.phone
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        WHERE o.orderdate >= :todayStart
        ORDER BY o.orderdate ASC
    ");
    $stmt->bindValue(':todayStart', $todayStart);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $orders = [];
    $totalOrders = 0;
}
?>

<style>
    .user-link {
        cursor: pointer;
        color: #007bff;
        text-decoration: none;
    }
                
    .user-link:hover {
        text-decoration: underline;
    }
    
    .popover {
        max-width: 300px;
    }

    /* Search styles */
    .search-container {
        position: relative;
        width: 100%;
        max-width: 400px;
    }

    .search-input {
        width: 100%;
        padding: 8px 40px 8px 16px;
        border: 1px solid #ddd;
        border-radius: 50px;
        outline: none;
        font-size: 14px;
        color: black;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: border-color 0.2s ease-in-out;
    }

    .search-input:focus {
        border-color: #007bff;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: black;
        font-size: 16px;
    }

    #suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        margin-top: 4px;
    }

    #suggestions a {
        display: block;
        padding: 10px 16px;
        color: black;
        text-decoration: none;
        font-size: 14px;
        border-bottom: 1px solid #eee;
        transition: background-color 0.2s ease-in-out;
    }

    #suggestions a:hover {
        background-color: #f0f0f0;
    }

    #suggestions .text-muted {
        padding: 10px 16px;
        color: #6c757d;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .search-container {
            max-width: 100%;
        }

        .search-input {
            font-size: 13px;
            padding: 8px 36px 8px 12px;
        }

        #suggestions {
            max-height: 150px;
        }

        #suggestions a {
            font-size: 13px;
            padding: 8px 12px;
        }
    }
</style>

<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar" style="border-right: none !important; border-left: none !important;">
    <div class="navbar-wrapper" style="background:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
        <div class="m-header">
            <a href="/admin" class="b-brand" style="text-align:center;">
                <img 
                    src="/assets/images/Daily.jpg" 
                    onerror="this.onerror=null; this.src='/views/assets/images/userPlaceHolder.png';" 
                    class="img-fluid logo-lg" 
                    alt="logo" 
                    style="width: 55px; height: 55px; border-radius: 50%;">
                <span style="margin-left: 20px; color: black;">DAILY NEEDS</span>
            </a>
        </div>
    </div>
    <div class="navbar-content" style="background:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
        <ul class="pc-navbar">
            <li class="pc-item">
                <a href="/admin" class="pc-link">
                    <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                    <span class="pc-mtext">Dashboard</span>
                </a>
            </li>
            <li class="pc-item pc-caption">
                <label>Components</label>
                <i class="ti ti-dashboard"></i>
            </li>
            <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">
                    <span class="pc-micon"><i class="ti ti-stack"></i></span>
                    <span class="pc-mtext">Product Management</span>
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                </a>
                <ul class="pc-submenu" id="order-submenu" style="display: none;">
                    <li class="pc-item">
                        <a class="pc-link" href="/products">
                            <i class="ti ti-package"></i> All Product
                        </a>
                    </li>
                    <li class="pc-item">
                        <a class="pc-link" href="/products/add-discount">
                            <i class="ti ti-discount"></i> Add Discount
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">
                    <span class="pc-micon"><i class="ti ti-stack"></i></span>
                    <span class="pc-mtext">Stock Management</span>
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                </a>
                <ul class="pc-submenu" id="order-submenu" style="display: none;">
                    <li class="pc-item">
                        <a class="pc-link" href="/stock">
                            <i class="bi bi-box-seam"></i> All Stocks
                        </a>
                    </li>
                    <li class="pc-item">
                        <a class="pc-link" href="/stock/in">
                            <i class="bi bi-box-arrow-in-down"></i> Stock In
                        </a>
                    </li>
                    <li class="pc-item">
                        <a class="pc-link" href="/stock/out">
                            <i class="bi bi-box-arrow-up"></i> Stock Out
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pc-item">
                <a href="/salesreport" class="pc-link">
                    <span class="pc-micon"><i class="ti ti-report"></i></span>
                    <span class="pc-mtext">Sale report</span>
                </a>
            </li>
            <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">
                    <span class="pc-micon"><i class="ti ti-user"></i></span>
                    <span class="pc-mtext">User Management</span>
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                </a>
                <ul class="pc-submenu" id="order-submenu" style="display: none;">
                    <li class="pc-item">
                        <a class="pc-link" href="/users">
                            <i class="bi bi-people"></i> All Users
                        </a>
                    </li>
                    <li class="pc-item">
                        <a class="pc-link" href="/users/active">
                            <i class="bi bi-person-check"></i> Active User
                        </a>
                    </li>
                    <li class="pc-item">
                        <a class="pc-link" href="/users/trash">
                            <i class="bi bi-trash"></i> Trash
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">
                    <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                    <span class="pc-mtext">Order Management</span>
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                </a>
                <ul class="pc-submenu" id="order-submenu" style="display: none;">
                    <li class="pc-item"><a class="pc-link" href="/All_order">All Orders</a></li>
                    <li class="pc-item"><a class="pc-link" href="/recent_order">Recent Orders</a></li>
                    <li class="pc-item"><a class="pc-link" href="/order_history">Order History</a></li>
                    <li class="pc-item"><a class="pc-link" href="/order_pending">Pending Orders</a></li>
                    <li class="pc-item"><a class="pc-link" href="/old_order">Older Orders</a></li>
                </ul>
            </li>
            <li class="pc-item">
                <a href="/somepage" class="pc-link">
                    <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
                    <span class="pc-mtext">Sample page</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- [ Sidebar Menu ] end --> 

<!-- [ Header Topbar ] start -->
<header class="pc-header" style="background:white; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i class="ti ti-menu-2" style="color:black;"></i></a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i class="ti ti-menu-2" style="color:black;"></i></a>
                </li>
                <li class="pc-h-item">
                    <div class="search-container">
                        <input type="search" id="globalSearch" class="search-input" placeholder="Search here...">
                        <div id="suggestions" class="list-group"></div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="/recent_order"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <i class="ti ti-bell" style="color:black;"></i>
                        <span class="badge bg-success pc-h-badge"><?php echo $totalOrders; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown" style="background:white; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h3 class="m-0" style="color:black;">Notifications (Recent Orders)</h3>
                            <a href="/recent_order" class="pc-head-link bg-transparent"><i class="ti ti-circle-check text-success"></i></a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px); color: black;">
                            <div class="list-group list-group-flush w-100">
                                <?php if (empty($orders)): ?>
                                    <a class="list-group-item list-group-item-action" style="color: black;">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ms-1">
                                                <p class="text-body mb-1" style="color:black;">No recent orders in the last 24 hours.</p>
                                            </div>
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <?php foreach ($orders as $order): ?>
                                        <a class="list-group-item list-group-item-action" href="/recent_order?id=<?php echo $order['id']; ?>" style="color:black;">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="user-avtar bg-light-success">
                                                        <i class="ti ti-shopping-cart" style="color:white;"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-1">
                                                    <span class="float-end text-muted" style="color:grey;"><?php echo date('H:i', strtotime($order['orderdate'])); ?></span>
                                                    <p class="text-body mb-1" style="color:black;">
                                                        New order from
                                                        <b
                                                            class="user-link"
                                                            data-bs-toggle="popover"
                                                            data-bs-trigger="hover focus"
                                                            data-bs-placement="bottom"
                                                            data-bs-html="true"
                                                            data-bs-content="
                                                                <div>
                                                                    <strong>Username:</strong> <?php echo htmlspecialchars($order['username'] ?? 'Unknown'); ?><br>
                                                                    <strong>Phone:</strong> <?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?><br>
                                                                    <strong>User ID:</strong> <?php echo htmlspecialchars($order['user_id'] ?? 'N/A'); ?>
                                                                </div>"
                                                            style="color:black;"
                                                        >
                                                            <?php echo htmlspecialchars($order['username'] ?? 'Unknown Customer'); ?>
                                                        </b>
                                                        - $<?php echo number_format($order['totalprice'], 2); ?>
                                                    </p>
                                                    <span class="text-muted" style="color:grey;"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center py-2">
                            <a href="/recent_order" class="link-primary">View all</a>
                        </div>
                    </div>
                </li>
                <?php $conn = null; ?>
                <li class="dropdown pc-h-item header-user-profile">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                    >
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php
                                $profileImage = !empty($_SESSION['user_profile']) ? $_SESSION['user_profile'] : '';
                            ?>
                            <img 
                                src="<?= htmlspecialchars($profileImage) ?>" 
                                onerror="this.onerror=null; this.src='/views/assets/images/userPlaceHolder.png';" 
                                alt="user-image" 
                                class="user-avtar" 
                                style="width: 35px; height: 35px; border-radius: 50%; border: 3px solid #ccc; box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 0px 1px;">
                            <span style="color:black;"><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown" style="background:white; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <?php
                                            $profileImage = !empty($_SESSION['user_profile']) ? $_SESSION['user_profile'] : '';
                                        ?>
                                        <img 
                                            src="<?= htmlspecialchars($profileImage) ?>" 
                                            onerror="this.onerror=null; this.src='/views/assets/images/userPlaceHolder.png';" 
                                            alt="user-image" 
                                            class="user-avtar wid-35" 
                                            style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid #ccc;">
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <h6 class="mb-1" style="color:black;"><?=$_SESSION['user_name']?></h6>
                                        <span style="color:grey;"><?= $_SESSION['user_role']?></span>
                                    <?php endif; ?>
                                </div>
                                <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger"></i></a>
                            </div>
                        </div>
                        <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link active"
                                    id="drp-t1"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-1"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-1"
                                    aria-selected="true"
                                    style="color:black;"
                                ><i class="ti ti-user"></i> Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link"
                                    id="drp-t2"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-2"
                                    aria-selected="false"
                                    style="color:black;"
                                ><i class="ti ti-settings"></i> Setting</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="mysrpTabContent">
                            <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                <a href="/users/edit/<?= $_SESSION['user_id']?>" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-edit-circle"></i>
                                    <span data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</span>
                                </a>
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-user"></i>
                                    <span>View Profile</span>
                                </a>
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-clipboard-list"></i>
                                    <span>Social Profile</span>
                                </a>
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-wallet"></i>
                                    <span>Billing</span>
                                </a>
                                <a href="/logout" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                            <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-help"></i>
                                    <span>Support</span>
                                </a>
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-user"></i>
                                    <span>Account Settings</span>
                                </a>
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-lock"></i>
                                    <span>Privacy Center</span>
                                </a>
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-messages"></i>
                                    <span>Feedback</span>
                                </a>
                                <a href="#!" class="dropdown-item" style="color:black;">
                                    <i class="ti ti-list"></i>
                                    <span>History</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- [ Header ] end -->

<!-- Profile Edit Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <?php if(isset($_SESSION['user_id'])): ?>
                <div class="position-relative d-inline-block">
                    <img id="profileImage" src="<?= $_SESSION['user_profile'] ?>" alt="Profile Image" class="rounded-circle border shadow" width="100" height="100">
                    <label for="profileUpload" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1" style="cursor: pointer;">
                        <i class="bi bi-camera"></i>
                    </label>
                    <input type="file" id="profileUpload" class="d-none" accept="image/*" onchange="previewImage(event)">
                </div>
                <form action="/users/update/<?= $_SESSION['user_id']?>" method="POST" enctype="multipart/form-data" class="mt-3">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['user_name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?= $_SESSION['user_email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['user_phone'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Profile image preview
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profileImage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Initialize Bootstrap Popovers
    document.addEventListener('DOMContentLoaded', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });

    // Search functionality
    const pages = [
        { name: "Dashboard", path: "/admin" },
        { name: "All Users", path: "/users" },
        { name: "Active Users", path: "/users/active" },
        { name: "Trash Users", path: "/users/trash" },
        { name: "All Products", path: "/products" },
        { name: "Add Discount", path: "/products/add-discount" },
        { name: "All Stocks", path: "/stock" },
        { name: "Stock In", path: "/stock/in" },
        { name: "Stock Out", path: "/stock/out" },
        { name: "Sales Report", path: "/salesreport" },
        { name: "All Orders", path: "/All_order" },
        { name: "Recent Orders", path: "/recent_order" },
        { name: "Order History", path: "/order_history" },
        { name: "Pending Orders", path: "/order_pending" },
        { name: "Older Orders", path: "/old_order" },
        { name: "Sample Page", path: "/somepage" }
    ];

    const searchInput = document.getElementById("globalSearch");
    const suggestionsBox = document.getElementById("suggestions");

    searchInput.addEventListener("input", function () {
        const query = this.value.toLowerCase().trim();
        suggestionsBox.innerHTML = '';

        if (!query) {
            suggestionsBox.style.display = "none";
            return;
        }

        const filteredPages = pages.filter(page => page.name.toLowerCase().includes(query));

        if (filteredPages.length === 0) {
            suggestionsBox.innerHTML = `<div class="list-group-item text-muted">No results found</div>`;
        } else {
            filteredPages.forEach(page => {
                const item = document.createElement("a");
                item.className = "list-group-item list-group-item-action";
                item.textContent = page.name;
                item.href = page.path;
                suggestionsBox.appendChild(item);
            });
        }

        suggestionsBox.style.display = "block";
    });

    document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = "none";
        }
    });

    // Ensure Feather icons are rendered
    feather.replace();
</script>

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">