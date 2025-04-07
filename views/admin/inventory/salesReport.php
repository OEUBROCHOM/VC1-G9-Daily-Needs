
    <title>Sales Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <h1>Sales Report</h1>
    <style>
        h1{
            color:gray;
            margin-bottom: 40px;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .left-section {
            flex: 2;
        }
        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .btn-container {
            margin-bottom: 15px;
        }
        button {
            margin: 5px;
            padding: 8px 15px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        canvas {
            width: 100% !important;
            height: 100% !important;
        }
        h3{
            font-size:30px;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            /* background-color: #007bff; */
            color: black;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .action-buttons .material-icons {
            font-size: 24px;
            cursor: pointer;
        }
        .edit-btn {
            color: #007bff;
        }
        .delete-btn {
            color: #dc3545;
        }
        .sales-table{
            margin-top: 50px;
        }
        .chart-container {
            height: 450px; /* Increased chart height */
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds depth */
            padding: 20px;
            margin-bottom: 20px; /* Adds space below the chart */
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 5px; /* Reduced space between icons */
        }

        .action-buttons .material-icons {
            width: 20px;
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        /* .action-buttons .edit-btn:hover {
            background: rgba(0, 123, 255, 0.1);
        } */

        .action-buttons .delete-btn {
            color: #dc3545;
        }

        /* .action-buttons .delete-btn:hover {
            background: rgba(220, 53, 69, 0.1);
        } */


    </style>
    <div class="container">
        <div class="left-section">
            <div class="btn-container">
                <button onclick="updateChart('monthly')">Monthly</button>
                <button onclick="updateChart('weekly')">Weekly</button>
                <button onclick="updateChart('yearly')">Yearly</button>
            </div>
            <div class="chart-container">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
        <div class="right-section">
    <div class="customer-table">
        <h3>Customer List</h3>
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Purchased Products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="customerTableBody"></tbody>
        </table>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-pending { background-color: #fceabb; color: #a67c00; }
        .status-active { background-color: #d4edda; color: #155724; }
        .status-inactive { background-color: #f8d7da; color: #721c24; }
        .status-on-sale { background-color: #cce5ff; color: #004085; }
        .status-bouncing { background-color: #e2d9f3; color: #4b0082; }
        .product-img { width: 40px; height: 40px; border-radius: 50%; }
        .action-menu {
            position: relative;
            display: inline-block;
        }
        .action-menu-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 100px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .action-menu-content a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: black;
        }
        .action-menu-content a:hover {
            background: #f1f1f1;
        }
    </style>

<h2 class="mt-4">Product Table</h2>
    <div class="container-table mt-5">

        <!-- Product Table -->
        <table class="table table-hover">
            <tbody>
                <?php
                $products = [
                    [
                        "name" => "Cherry Delight",
                        "id" => "#KP267400",
                        "price" => "$90.50",
                        "stock" => "350 pcs",
                        "type" => "Dessert",
                        "status" => "Pending",
                        "image" => "profiles/1742657515_OEUB.jpg"
                    ],
                    [
                        "name" => "Kiwi",
                        "id" => "#TL651535",
                        "price" => "$12.00",
                        "stock" => "650 kg",
                        "type" => "Fruits",
                        "status" => "Active",
                        "image" => "profiles/1742657515_OEUB.jpg"
                    ],
                    [
                        "name" => "Mango Magic",
                        "id" => "#GB651535",
                        "price" => "$100.50",
                        "stock" => "1200 pcs",
                        "type" => "Ice Cream",
                        "status" => "Inactive",
                        "image" => "profiles/1742657515_OEUB.jpg"
                    ]
                ];
                
                ?>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Profile</th>
                            <th>Product Name</th>
                            <th>Product ID</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php foreach ($products as $index => $product): ?>
                            <tr data-index="<?= $index ?>">
                                <td><img src="<?= $product["image"] ?>" alt="<?= $product["name"] ?>" class="product-img" width="50"></td>
                                <td><?= $product["name"] ?></td>
                                <td><?= $product["id"] ?></td>
                                <td><?= $product["price"] ?></td>
                                <td><?= $product["stock"] ?></td>
                                <td><?= $product["type"] ?></td>
                                <td><span class="status-badge status-<?= strtolower(str_replace(' ', '-', $product["status"])) ?>"><?= $product["status"] ?></span></td>
                                <td>
                                <div class="action-menu">
                        <i class="fas fa-ellipsis-v toggle-menu" data-index="<?= $index ?>"></i>
                        <div class="action-menu-content" id="menu-<?= $index ?>">
                            <a href="#" class="edit-product" data-index="<?= $index ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a href="#" class="delete-product" data-index="<?= $index ?>"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                    </div>

                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Handle action menu toggle
                        document.addEventListener("click", function (event) {
                            if (event.target.classList.contains("toggle-menu")) {
                                let index = event.target.getAttribute("data-index");
                                let menu = document.getElementById("menu-" + index);

                                // Close all other open menus
                                document.querySelectorAll(".action-menu-content").forEach(m => m.style.display = "none");

                                // Toggle the clicked menu
                                menu.style.display = menu.style.display === "block" ? "none" : "block";
                                event.stopPropagation(); // Prevent closing when clicking inside
                            } else {
                                // Close all menus when clicking outside
                                document.querySelectorAll(".action-menu-content").forEach(menu => menu.style.display = "none");
                            }
                        });

                        // Handle edit and delete
                        document.addEventListener("click", function (event) {
                            let target = event.target.closest(".edit-product, .delete-product");
                            if (!target) return;

                            let index = target.getAttribute("data-index");

                            if (target.classList.contains("edit-product")) {
                                editProduct(index);
                            } else if (target.classList.contains("delete-product")) {
                                deleteProduct(index);
                            }
                        });

                        // Edit function (prompts for input)
                        function editProduct(index) {
                            let row = document.querySelector(`tr[data-index='${index}']`);
                            let name = row.cells[1].innerText;
                            let price = row.cells[3].innerText;
                            let stock = row.cells[4].innerText;
                            let type = row.cells[5].innerText;
                            let status = row.cells[6].innerText;
                            let image = row.cells[0].querySelector("img").src;

                            let newName = prompt("Edit Product Name:", name) || name;
                            let newPrice = prompt("Edit Price:", price) || price;
                            let newStock = prompt("Edit Stock:", stock) || stock;
                            let newType = prompt("Edit Type:", type) || type;
                            let newStatus = prompt("Edit Status:", status) || status;
                            let newImage = prompt("Edit Image URL:", image) || image;

                            // Update table row
                            row.cells[1].innerText = newName;
                            row.cells[3].innerText = newPrice;
                            row.cells[4].innerText = newStock;
                            row.cells[5].innerText = newType;
                            row.cells[6].innerText = newStatus;
                            row.cells[0].querySelector("img").src = newImage;

                            // Send update request to server via AJAX
                            updateProductInDatabase(index, newName, newPrice, newStock, newType, newStatus, newImage);
                        }

                        // Delete function
                        function deleteProduct(index) {
                            if (confirm("Are you sure you want to delete this product?")) {
                                // Send delete request to server via AJAX
                                deleteProductFromDatabase(index);

                                // Remove the table row from the DOM
                                document.querySelector(`tr[data-index='${index}']`).remove();
                            }
                        }

                        // AJAX request to update product in database
                        function updateProductInDatabase(index, name, price, stock, type, status, image) {
                            const xhr = new XMLHttpRequest();
                            xhr.open("POST", "updateProduct.php", true); // Replace with the actual PHP file handling the update
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    alert("Product updated successfully!");
                                }
                            };

                            xhr.send(`index=${index}&name=${name}&price=${price}&stock=${stock}&type=${type}&status=${status}&image=${image}`);
                        }

                        // AJAX request to delete product from database
                        function deleteProductFromDatabase(index) {
                            const xhr = new XMLHttpRequest();
                            xhr.open("POST", "deleteProduct.php", true); // Replace with the actual PHP file handling the delete
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    alert("Product deleted successfully!");
                                }
                            };

                            xhr.send(`index=${index}`);
                        }
                    });
                    </script>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>                
            </tbody>
        </table>
    </div>                                
    <script>
var chartData = {
    monthly: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        categories: ["Oral Health", "Feminine Hygiene", "Household Hygiene", "Tissue", "Drinking Water", "Beverages", "Clothing", "Cooking Ingredients", "Snacks"],
        data: {
            "Oral Health": [200, 220, 250, 230, 280, 300, 310, 330, 350, 370, 390, 400],
            "Feminine Hygiene": [180, 200, 210, 190, 230, 250, 270, 290, 310, 330, 350, 370],
            "Household Hygiene": [150, 180, 200, 190, 210, 230, 250, 270, 290, 310, 330, 350],
            "Tissue": [100, 120, 140, 130, 150, 170, 190, 210, 230, 250, 270, 290],
            "Drinking Water": [220, 240, 260, 250, 280, 300, 320, 340, 360, 380, 400, 420],
            "Beverages": [180, 190, 210, 220, 240, 260, 280, 300, 320, 340, 360, 380],
            "Clothing": [130, 150, 170, 160, 180, 200, 220, 240, 260, 280, 300, 320],
            "Cooking Ingredients": [250, 270, 290, 280, 300, 320, 340, 360, 380, 400, 420, 440],
            "Snacks": [300, 320, 340, 330, 350, 370, 390, 410, 430, 450, 470, 490]
        }
    },  // <-- Added missing comma

    weekly: {
        labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
        categories: ["Oral Health", "Feminine Hygiene", "Household Hygiene", "Tissue", "Drinking Water", "Beverages", "Clothing", "Cooking Ingredients", "Snacks"],
        data: {
            "Oral Health": [50, 55, 60, 58],
            "Feminine Hygiene": [45, 50, 55, 53],
            "Household Hygiene": [40, 42, 44, 46],
            "Tissue": [20, 25, 30, 28],
            "Drinking Water": [55, 60, 65, 63],
            "Beverages": [48, 52, 56, 54],
            "Clothing": [33, 36, 39, 37],
            "Cooking Ingredients": [60, 64, 68, 66],
            "Snacks": [75, 80, 85, 83]
        }
    },  // <-- Added missing comma
    yearly: {
        labels: ["2021", "2022", "2023", "2024"],
        categories: ["Oral Health", "Feminine Hygiene", "Household Hygiene", "Tissue", "Drinking Water", "Beverages", "Clothing", "Cooking Ingredients", "Snacks"],
        data: {
            "Oral Health": [2400, 2600, 2800, 2900],
            "Feminine Hygiene": [2200, 2400, 2600, 2700],
            "Household Hygiene": [1800, 2000, 2200, 2300],
            "Tissue": [1200, 1400, 1600, 1700],
            "Drinking Water": [2600, 2800, 3000, 3100],
            "Beverages": [2200, 2400, 2600, 2700],
            "Clothing": [1600, 1800, 2000, 2100],
            "Cooking Ingredients": [3000, 3200, 3400, 3500],
            "Snacks": [3600, 3800, 4000, 4100]
        }
    }
};

function loadChart(type = "monthly") {
    var ctx = document.getElementById("myBarChart").getContext("2d");
    var datasets = chartData[type].categories.map((category, index) => ({
        label: category,
        data: chartData[type].data[category],
        backgroundColor: getColor(index),
        borderColor: "rgba(0, 0, 0, 0.2)",
        borderWidth: 1
    }));
 
    window.myBarChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: chartData[type].labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { stacked: true, grid: { display: false } },
                y: { stacked: true, grid: { color: "#ddd" } }
            }
        }
    });
}
// Predefined colors
function getColor(index) {
    const colors = [
        "rgba(187, 222, 251, 0.8)",  // Light Blue 1
        "rgba(144, 202, 249, 0.8)",  // Light Blue 2
        "rgba(214, 100, 246, 0.8)",  // Light Blue 3
        "rgba(245, 197, 66, 0.8)",   // Blue 1
        "rgba(33, 243, 233, 0.8)",   // Blue 2
        "rgba(206, 229, 30, 0.8)",   // Darker Blue
        "rgba(79, 160, 241, 0.8)",   // Deep Blue
        "rgba(21, 192, 115, 0.8)",   // Strong Blue
        "rgba(161, 13, 119, 0.8)"     // Deepest Blue
    ];
    return colors[index % colors.length]; // Loops colors if more categories exist
}
// Update chart function
function updateChart(type) {
    if (!window.myBarChart) return;

    window.myBarChart.data.labels = chartData[type].labels;
    window.myBarChart.data.datasets = chartData[type].categories.map((category, index) => ({
        label: category,
        data: chartData[type].data[category],
        backgroundColor: getColor(index),
        borderColor: "rgba(0, 0, 0, 0.2)",
        borderWidth: 1
    }));

    window.myBarChart.update();
}
        var customerData = [
            { name: "John Doe", purchased: 5, profile: "profiles/1742657515_OEUB.jpg" },
            { name: "Jane Smith", purchased: 8, profile: "profiles/1742657515_OEUB.jpg" },
            { name: "Mike Johnson", purchased: 3, profile: "profiles/1742657515_OEUB.jpg" }
        ];

        function loadCustomerTable() {
            var tableBody = document.getElementById("customerTableBody");
            tableBody.innerHTML = ""; // Clear table before reloading
            customerData.forEach((customer, index) => {
                var row = tableBody.insertRow();
                row.setAttribute("data-index", index); // Store index for easy reference
                row.insertCell(0).innerHTML = `<img src="${customer.profile}" alt="Profile" class="profile-img">`;
                row.insertCell(1).innerText = customer.name;
                row.insertCell(2).innerText = customer.purchased;
                row.insertCell(3).innerHTML = `
                    <div class="action-buttons">
                        <span class="material-icons edit-btn" data-index="${index}">edit</span>
                        <span class="material-icons delete-btn" data-index="${index}">delete</span>
                    </div>
                `;
            });
        }
        // Event delegation for edit and delete buttons
        document.addEventListener("click", function (event) {
            let target = event.target;

            // Edit button clicked
            if (target.classList.contains("edit-btn")) {
                let index = target.getAttribute("data-index");
                editCustomer(index);
            }

            // Delete button clicked
            if (target.classList.contains("delete-btn")) {
                let index = target.getAttribute("data-index");
                deleteCustomer(index);
            }
        });

        // Edit function
        function editCustomer(index) {
            let customer = customerData[index];
            let newName = prompt("Edit Name:", customer.name);
            let newPurchased = prompt("Edit Purchases:", customer.purchased);




            if (newName !== null && newPurchased !== null) {
                customerData[index].name = newName.trim();
                customerData[index].purchased = parseInt(newPurchased.trim()) || customer.purchased;
                loadCustomerTable(); // Refresh table
            }
        }

        // Delete function
        function deleteCustomer(index) {
            if (confirm("Are you sure you want to delete this customer?")) {
                customerData.splice(index, 1); // Remove from array
                loadCustomerTable(); // Refresh table
            }
        }

        // Load table initially
        loadCustomerTable();


        window.onload = function() {
            loadChart();
            loadCustomerTable();
        };
    </script>
