<?php
// Database connection (remains unchanged)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailyneed_db";

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
 </style>              
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar"style="border-right: none !important; border-left: none !important;">
  <div class="navbar-wrapper" style="background:#1C2526">
    <div class="m-header">
      <a href="/admin" class="b-brand text-primary text-align:center;">
        <!-- ========   Change your logo from here   ============ -->
        <img src="../assets/images/Daily.jpg" class="img-fluid logo-lg" alt="logo" style="width: 55px; height: 55px; border-radius: 50%;">
        <span style="margin-left: 20px; color: white;">DAILY NEEDS</span>
      </a>
    </div>
    <!-- Nav move down inven tory -->
    <div class="navbar-content "style="background:#1C2526">
      <ul class="pc-navbar">
        <li class="pc-item">
          <a href="/admin" class="pc-link"style="color:white;">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>

        <li class="pc-item pc-caption"style="color:white;">
          <label>Components</label>
          <i class="ti ti-dashboard"></i>
        </li>
        <li class="pc-item pc-hasmenu ">
            <a href="#!" class="pc-link" style="color:white;">
                    <span class="pc-micon"><i class="ti ti-stack"></i></span>
                    <span class="pc-mtext ">Product Management</span>
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu" id="order-submenu" style="display: none;">
                <li class="pc-item"style="color:white;">
                    <a class="pc-link" href="/products"style="color:white;">
                        <i class="ti ti-package"></i> All Product
                    </a>
                </li>
                <li class="pc-item">
                    <a class="pc-link" href="/products/add-discount"style="color:white;">
                        <i class="ti ti-discount"></i> Add Discount
                    </a>
                </li>
            </ul>

        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"style="color:white;">
                <span class="pc-micon"><i class="ti ti-stack"></i></span>
                <span class="pc-mtext">Stock Management</span>
                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
          </a>
          <ul class="pc-submenu" id="order-submenu" style="display: none;">
                <li class="pc-item">
                    <a class="pc-link" href="/stock"style="color:white;">
                        <i class="bi bi-box-seam"></i> All Stocks
                    </a>
                </li>
                <li class="pc-item">
                    <a class="pc-link" href="/stock/in"style="color:white;">
                        <i class="bi bi-box-arrow-in-down"></i> Stock In
                    </a>
                </li>
                <li class="pc-item">
                    <a class="pc-link" href="/stock/out"style="color:white;">
                        <i class="bi bi-box-arrow-up"></i> Stock Out
                    </a>
                </li>
            </ul>

        </li>
        <li class="pc-item">
          <a href="/salesreport" class="pc-link"style="color:white;">
            <span class="pc-micon"><i class="ti ti-report"></i></span>
            <span class="pc-mtext">Sale report</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"style="color:white;">
                <span class="pc-micon"><i class="ti ti-user"></i></span>
                <span class="pc-mtext">User Management</span>
                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
          </a>
          <ul class="pc-submenu" id="order-submenu" style="display: none;"style="color:white;">
                <li class="pc-item">
                    <a class="pc-link" href="/users"style="color:white;">
                        <i class="bi bi-people"></i> All Users
                    </a>
                </li>
                <li class="pc-item">
                    <a class="pc-link" href="/users/active"style="color:white;">
                        <i class="bi bi-person-check"  style="color: white;"></i> Active User
                    </a>
                </li>
                <li class="pc-item">
                    <a class="pc-link" href="/users/trash"style="color:white;">
                        <i class="bi bi-trash"></i> Trash
                    </a>
                </li>
          </ul>
        </li>
        <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"style="color:white;">
                <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                <span class="pc-mtext">Order Management</span>
                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu" id="order-submenu" style="display: none;"style="color:white;">
                <li class="pc-item"><a class="pc-link"style="color:white;" href="/All_order">All Orders</a></li>
                <li class="pc-item"><a class="pc-link"style="color:white;" href="/recent_order">Recent Orders</a></li>
                <li class="pc-item"><a class="pc-link"style="color:white;" href="/order_history">Order History</a></li>
                <li class="pc-item"><a class="pc-link"style="color:white;" href="/order_pending">Pending Orders</a></li>
                <li class="pc-item"><a class="pc-link"style="color:white;" href="/old_order">Older Orders</a></li>
            </ul>
        </li>

        <li class="pc-item">
          <a href="/somepage" class="pc-link">
            <span class="pc-micon"><i class="ti ti-brand-chrome"style="color:white;"></i></span>
            <span class="pc-mtext"style="color:white;">Sample page</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- [ Sidebar Menu ] end --> 
     <!-- [ Header Topbar ] start -->
    <header class="pc-header" style="background: #1C2526">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i class="ti ti-menu-2" style="color:white;"></i></a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i class="ti ti-menu-2"></i></a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none m-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
                        >
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search ">
                            <form class="px-3 ">
                                <div class="form-group mb-0 d-flex align-items-center ">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border:blue; shadow-none " placeholder="Search here. . ."style="border: none; outline: none; border-radius: 50px; box-shadow: none;">
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex ">
                    <div class="animated-border">
                        <input type="search" class="form-control" placeholder="Search here. . ." style="border: none; outline: none; border-radius: 50px; box-shadow: none;"/>
                    </div>

                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
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
                    <i class="ti ti-bell" style="color:white;"></i>
                    <span class="badge bg-success pc-h-badge"><?php echo $totalOrders; ?></span>
                </a>
                <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                    <div class="dropdown-header d-flex align-items-center justify-content-between">
                    <h3 class="m-0">Notifications (Recent Orders)</h3>
                        <a href="/recent_order" class="pc-head-link bg-transparent"><i class="ti ti-circle-check text-success"></i></a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                        <div class="list-group list-group-flush w-100">
                            <?php if (empty($orders)): ?>
                                <a class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-1">
                                            <p class="text-body mb-1">No recent orders in the last 24 hours.</p>
                                        </div>
                                    </div>
                                </a>
                            <?php else: ?>
                                <?php foreach ($orders as $order): ?>
                                    <a class="list-group-item list-group-item-action" href="/recent_order?id=<?php echo $order['id']; ?>">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-success">
                                                    <i class="ti ti-shopping-cart"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted"><?php echo date('H:i', strtotime($order['orderdate'])); ?></span>
                                                <p class="text-body mb-1">
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
                                                    >
                                                        <?php echo htmlspecialchars($order['username'] ?? 'Unknown Customer'); ?>
                                                    </b>
                                                    - $<?php echo number_format($order['totalprice'], 2); ?>
                                                </p>
                                                <span class="text-muted"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($order['orderdate']))); ?></span>
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

            <!-- Add this script at the bottom of your page -->
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize Bootstrap Popovers
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
            });
            </script>

<!-- Add some basic CSS -->
                    <li class="dropdown pc-h-item header-user-profile ">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            data-bs-auto-close="outside"
                            aria-expanded="false"
                        ><?php if (isset($_SESSION['user_id'])):?>
                            <img src="<?= $_SESSION['user_profile']?>" alt="user-image" class="user-avtar" style="width: 35px; height: 35px; border-radius: 50%; border: 3px solid #fff; box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
                            <span style="color:white;"><?= $_SESSION['user_name']?></span>
                        <?php endif;?>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex mb-1">
                                    <div class="flex-shrink-0">
                                        <?php if (isset($_SESSION['user_id'])):?>
                                            <img src="<?= $_SESSION['user_profile']?>" alt="user-image" class="user-avtar wid-35" style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid #fff;">
                                        <?php endif;?>
                                    </div>
                                    <div class="flex-grow-1 ms-3 ">
                                        <?php if (isset($_SESSION['user_id'])):?>
                                            <h6 class="mb-1"><?=$_SESSION['user_name']?></h6>
                                            <span><?= $_SESSION['user_role']?></span>
                                        <?php endif;?>
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
                                    ><i class="ti ti-user"></i> Profile</button
                                    >
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
                                    ><i class="ti ti-settings"></i> Setting</button
                                    >
                                </li>
                            </ul>
                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                    <a href="/users/edit/<?= $_SESSION['user_id']?>" class="dropdown-item">
                                        <i class="ti ti-edit-circle"></i>
                                        <span data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>View Profile</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-clipboard-list"></i>
                                        <span>Social Profile</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-wallet"></i>
                                        <span>Billing</span>
                                    </a>
                                    <a href="/logout" class="dropdown-item">
                                        <i class="ti ti-power"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-help"></i>
                                        <span>Support</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>Account Settings</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-lock"></i>
                                        <span>Privacy Center</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-messages"></i>
                                        <span>Feedback</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
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
                        <!-- Profile Image Upload -->
                        <?php if(isset($_SESSION['user_id'])):?>
                        <div class="position-relative d-inline-block">
                            <img id="profileImage" src="<?= $_SESSION['user_profile'] ?>" alt="Profile Image" class="rounded-circle border shadow" width="100" height="100">
                            <label for="profileUpload" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1" style="cursor: pointer;">
                                <i class="bi bi-camera"></i>
                            </label>
                            <input type="file" id="profileUpload" class="d-none" accept="image/*" onchange="previewImage(event)">
                        </div>
                        
                        <!-- Edit Form -->
                        <form action="/users/update/<?= $_SESSION['user_id']?>" method="POST" enctype="multipart/form-data" class="mt-3">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" value="<?=$_SESSION['user_name']?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="<?=$_SESSION['user_email'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="<?=$_SESSION['user_phone']?>">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </form>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('profileImage');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
<style>
  

</style>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">