<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) : ?>
    <h3 class="text-center">Welcome to some page</h3>

<?php
else:
    $this->redirect("/login");
endif;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .nav-link:hover {
            font-weight: bold;
            color: blue !important;
            /* Change color to blue on hover */
        }

        body {
            background-color: rgb(219, 226, 233);

        }

        .nav-link {
            font-weight: normal;
            /* Default weight */
            transition: color 0.3s ease, font-weight 0.3s ease;
            /* Smooth transition */
        }

        .text-white {
            height: 70vh;
        }

        .img_some {
            width: 400px;
            height: 400px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link " href=".//home" style="font-size: 1.2rem;">Shops</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/product" style="font-size: 1.2rem;">Product</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/about" style="font-size: 1.2rem;">About</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/contact" style="font-size: 1.2rem;">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <style>
        /* Cards Section */
        .cards {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            flex: 0 0 auto;
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
        }

        /* Info Overlay */
        .info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgb(89, 150, 219);
            color: white;
            padding: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover .info,
        .card:active .info {
            opacity: 1;
        }

        /* Content Section */
        .content-section {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-top: 40px;
        }

        .text-content .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background:rgb(89, 150, 219);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        /* .image-content-right img {
            width: 100%;
            height: auto;
            border-radius: 10px 70px 10px 70px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        } */

        /* Info Section */
        .info-section {
            background-color: #fff;
            padding: 40px 0;
            text-align: center;
        }

        .info-section p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
            max-width: 800px;
            margin: 0 auto 20px;
        }

        .info-section .cta-button {
            display: inline-block;
            padding: 12px 25px;
            background:rgb(89, 150, 219);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        /* Product Container */
        .product-container {
            display: flex;
            /* flex-wrap: wrap; */
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .learn-more {
            background-color:rgb(89, 150, 219);
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }

        @media (max-width: 1199px) {
            .products-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 767px) {
            .products-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 575px) {

            /* General adjustments */
            body {
                padding: 10px;
                font-size: 14px;
            }

            header h1 {
                font-size: 1.8rem;
                padding: 15px;
            }

            header p {
                font-size: 1.2rem;
            }

            /* Product cards container */
            .products-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            /* Product cards */
            .product-card {
                width: 100%;
                margin: 0;
                height: auto;
            }

            .product-image {
                height: 150px !important;
                /* Adjusted for better proportions */
                border-radius: 8px 8px 0 0;
                object-fit: cover;
            }

            .product-info {
                padding: 10px;
            }

            .product-name {
                font-size: 1.2rem;
                margin-bottom: 5px;
                font-family: serif;
            }

            .price {
                font-size: 1.5rem;
            }

            .add-to-cart {
                padding: 5px;
                font-size: 0.9rem;
            }

            /* Discount section */
            .discount-products {
                padding: 20px 10px;
            }

            .discount-header h2 {
                font-size: 1.5rem;
            }

            /* Content sections */
            .content-section {
                flex-direction: column;
                gap: 20px;
            }

            .text-content {
                order: 2;
            }

            .image-content-right,
            .image-content-left,
            .image-content-lefts {
                order: 1;
                width: 100%;
            }

            .image-content-right img,
            .image-content-left img,
            .image-content-lefts img {
                width: 100%;
                height: auto;
                max-height: 250px;
                object-fit: cover;
                border-radius: 10px !important;
            }

            /* Product cards in product-container */
            .product-container {
                flex-direction: column;
                align-items: center;
            }

            .product-card1 {
                width: 100%;
                max-width: 300px;
                margin-bottom: 20px;
            }

            .product-card1 img {
                height: 180px;
                object-fit: cover;
            }

            /* Cards carousel */
            .cards {
                gap: 10px;
                padding-bottom: 15px;
            }

            .card {
                width: 200px;
                flex: 0 0 auto;
            }

            .card img {
                height: 150px;
            }

            /* Info overlay */
            .info {
                font-size: 0.85rem;
                padding: 8px;
            }

            /* Info section */
            .info-section {
                padding: 20px 10px;
            }

            .info-section h2 {
                font-size: 1.5rem;
            }

            /* Buttons */
            .cta-button,
            .info-section .cta-button,
            .learn-more {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            /* Ensure all images maintain aspect ratio */
            img {
                max-width: 100%;
                height: auto;
            }

            /* Cart panel adjustments */
            .cart-panel {
                width: 90%;
                max-width: none;
            }

            /* Discount badge */
            .discount-badge {
                font-size: 0.8rem;
                padding: 3px 8px;
            }

            /* Remove animations on mobile */
            .card img {
                animation: none !important;
            }

            /* Adjust spacing */
            .container {
                padding: 10px;
            }

            /* Full width for text content */
            .text-content {
                width: 100%;
            }

            .text-content h2 {
                font-size: 1.5rem;
            }

            .text-content p {
                font-size: 0.95rem;
            }
        }

        .product-card1 {

            width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }
    </style>
    </head>


    <!-- Cards of Products -->
    <div class="cards">
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/3d8c2c16e953bf1a92c94dc5ab9ded8dcc2788ff5bca3067bff68afaf087555f?w=169&h=178&pmaid=343513914" alt="Hydrating Moisturizer">
            <div class="info">Perfect for a fast and flavorful meal, suitable for lunch, dinner, or a late-night snack.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/1965a9c16ce73349d259da9abc9004ba9c9b43f752c7effd84598a11fba0eca1?w=250&h=253&pmaid=343484602" alt="Vitamin C Serum">
            <div class="info">Contains aloe vera for soothing properties, helping to calm chapped or irritated lips.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/5aa6ae1348152e71698d05603dae45f56b76e9353abf603997529c5e8a6620cf?w=86&h=235&pmaid=343486079" alt="Sunscreen SPF 50">
            <div class="info">Made from green tea, which is rich in antioxidants, promoting overall health.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/f3ae46636d4454ec4d88a4856a272144721b51bf4d1a91b77e328a2a502fe52b?w=134&h=104&pmaid=343487270" alt="Hydrating Moisturizer">
            <div class="info">Suitable for a variety of dishes, enhancing the taste of vegetables, grains, and more.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/ba55db6e9c450008c27c46b1c2fd866e786d0601fddc8b89bc2efc828e62275a?w=102&h=196&pmaid=343488987" alt="Vitamin C Serum">
            <div class="info">Effectively tackle tough stains, ensuring clean laundry. a pleasant , leaving clothes smelling fresh after washing.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/0b80d3a156c65be087659a85e81930d379f7a2e4735c7de82cd0919fa450bbb7?w=119&h=274&pmaid=343489914" alt="Sunscreen SPF 50">
            <div class="info">Designed with medium bristles for effective cleaning while being gentle on gums.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/6b9a86a5e19557f2eee02364528bd78a3c1e2dcacf1de3926e43fc77c12cbbfd?w=144&h=183&pmaid=343490924" alt="Sunscreen SPF 50">
            <div class="info">Available in a range of flavors, including chicken, pork, and seafood, catering to different tastes.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/b0fc9599a84fdb98b3856e3b0a9ede6d1277b69f7e987693839d2a0628fe71de?w=212&h=181&pmaid=343512640" alt="Sunscreen SPF 50">
            <div class="info">Ideal for a variety of needs, including facial tissues, cleaning spills, or general hygiene.</div>
        </div>
        <div class="card">
            <img src="https://pfst.cf2.poecdn.net/base/image/020a30cf12bce0781273a10fe90f880e33356b15e25305206df0e9aea6c3ea74?w=69&h=235&pmaid=343492573" alt="Sunscreen SPF 50">
            <div class="info">Suitable as a dipping sauce, marinade, or ingredient in cooking for various dishes.</div>
        </div>
    </div>

    <!-- Left Paragraph Right Image -->
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <h2>Why Milène Acne Clear facial foam?</h2>
                <p>Formulated to help clear acne and prevent future breakoutsុំ​cleanse the skin without over-drying, suitable for daily use, contains salicylic acid or other acne-fighting ingredients to target blemishes effectively.</p>
                <a href="#" class="cta-button">Discover Our Story</a>
            </div>
            <div class="image-content-right">
                <img src="https://pfst.cf2.poecdn.net/base/image/78c61c371f19015f65d09ca3ec819ae7278d16d0b88ebfe261952de6dc2380aa?w=234&h=255&pmaid=343449343" alt="Glow Skincare Products" style="width: 400px; height: 400px;">
            </div>
        </div>
    </div>

<!-- card image for All Category -->

    <div class="container mt-5">
        <h2 class="Category text-center">All Category</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/0c03438664055ab8478d172526548fec29a8d2048473684bc2b84c9e73d41fad?w=107&h=270&pmaid=339868683" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">Known for its fresh floral scent, which can help keep clothes smelling pleasant.</p>
                        <button class="learn-more" onclick="showDescription('Clothing', 'Designed to be effective in smaller quantities, providing maximum softness and fragrance which can help keep clothes smelling pleasant Helps to soften fabrics, making them more comfortable to wear Reduces static cling in laundry.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/7a032e929fc97918618a90456fd51ab2d5b92394c71d102a80ec90bdb40d6558?w=203&h=203&pmaid=339863415" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">Typically offers a satisfying texture, often with chewy noodles.</p>
                        <button class="learn-more" onclick="showDescription('Snacks', 'Often available in various flavors, including spicy and savory. options Quick and easy to prepare, making it a popular choice for meals or snacks, Usually includes a seasoning packet, which enhances the flavor profile.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/1e7ffbb8aaae97d7c2f7bf90826e43e2e8da2bd1ee82638dccfc58c672de5f24?w=200&h=299&pmaid=339861196" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">Providing a gentle touch for sensitive skin typically has good absorbent properties.</p>
                        <button class="learn-more" onclick="showDescription('Tissue', 'Designed for comfort, providing a gentle touch for sensitive skin, durable and strong, suitable for various uses, including personal hygiene and household cleaning available in convenient packs for easy storage and use.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/148e15f672e9092e5a381cfede88d0ced996f663eab8adbc3ed3a7ff808d9e39?w=88&h=214&pmaid=339815535" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">It's a great dairy-free alternative for those who are lactose intolerant or follow a vegan diet.</p>
                        <button class="learn-more" onclick="showDescription('Beverages', 'A nutritious, protein-rich product containing essential amino acids and fortified with vitamins B12 and D. It supports overall health and can be enjoyed on its own, in smoothies, or as a dairy substitute in cooking and baking.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/089ff25ff2c6046fb05e5e36d6aa9a753896e05b0e347f27b4e4a8aa1898ad50?w=138&h=166&pmaid=339829140" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">A popular choice for a quick snack or meal addition.</p>
                        <button class="learn-more" onclick="showDescription('Cooking ingredientts', 'The product is sweet and creamy, making it popular for desserts and drinks. It can be used in coffee, tea, desserts, and various recipes to enhance flavor and texture. Additionally, it provides energy, making it a preferred option for quick snacks or meal additions.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/7a365c10dcac757ca56800cd0bd516146c5c7485a0af83b706c28b948f96dd19?w=78&h=276&pmaid=339832885" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">Ideal for everyday hydration, whether at home, work, or during physical activities.</p>
                        <button class="learn-more" onclick="showDescription('Drinking Water', 'Sourced from natural springs, providing pure and refreshing water, Sourced from natural springs, providing pure and refreshing water, Available in a 1-liter bottle, making it easy to carry and drink on the go.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/03622d3855a4f17f8447eeffa758651f4312ac2bdd684ef6514fa63045519c57?w=217&h=187&pmaid=339844985" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">Suitable for daily menstrual protection, providing comfort and confidence.</p>
                        <button class="learn-more" onclick="showDescription('Feminine Hygiene', 'Typically features a thin profile for discreet wear while maintaining absorbency,  Engineered to provide reliable protection against leaks, suitable for various flow levels.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/74ea91ca3c672cee823978bbd4960d29243fa2229f93855bf9a707bbd17c8686?w=154&h=154&pmaid=339846928" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">Suitable for washing dishes, pots, pans, and even surfaces in the kitchen.</p>
                        <button class="learn-more" onclick="showDescription('House Hold Hygiene', 'Formulated to effectively cut through grease and food residues, making dishwashing easier, with a lemon or lime fragrance, leaving dishes smelling fresh,Suitable for washing dishes, pots, pans, and even surfaces in the kitchen.')">See more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://pfst.cf2.poecdn.net/base/image/614918d19ba25a4c73343dbf9478b5c131483322c0e05f4ff01fcd1ac326d308?w=69&h=236&pmaid=339849784" class="card-img-top" alt="Hydrating Moisturizer">
                    <div class="card-body">
                        <p class="card-text">Formulated to help prevent cavities and promote overall dental health.</p>
                        <button class="learn-more" onclick="showDescription('Oral Health', 'Many variants include ingredients that help remove surface stains for a brighter smile, contains mint flavors that provide long-lasting freshness, helps fight tooth decay.')">See more</button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="description-modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="modal-description"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showDescription(title, description) {
                    document.getElementById('modal-title').innerText = title;
                    document.getElementById('modal-description').innerText = description;
                    $('#description-modal').modal('show');
                    document.querySelector('.close').addEventListener('click', function() {
                        $('#description-modal').modal('hide');
                    });
                }
            </script>

            <!-- Information Section -->
            <div class="info-section">
                <div class="container">
                    <h2>About Our Products</h2>
                    <p>At DAILY NEEDS, we are committed to providing you with products that are not only effective, but also safe and sustainable.</p>
                    <a href="#" class="cta-button">See More About Us</a>
                </div>
            </div>

            <script>
                // Simple script for the discount section
                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const productName = this.closest('.discount-card').querySelector('h3').textContent;
                        alert(`Added ${productName} to your cart!`);
                    });
                });
            </script>

            <script>
                // Select the container with class 'cards'
                const container = document.querySelector('.cards');

                // Hide the scroll bar to keep the UI clean
                container.style.overflowX = 'hidden';

                // Get the width of the original set of cards
                const originalScrollWidth = container.scrollWidth;

                // Clone all existing cards and append them for seamless looping
                const cards = Array.from(container.querySelectorAll('.card'));
                cards.forEach(card => {
                    const clone = card.cloneNode(true);
                    container.appendChild(clone);
                });

                // Set the initial scroll position
                container.scrollLeft = originalScrollWidth;

                // Define the speed of the animation (pixels per second)
                const speed = 100;
                let lastTime = performance.now();

                // Animation function for continuous movement
                function animate(currentTime) {
                    const deltaTime = (currentTime - lastTime) / 1000;
                    container.scrollLeft -= speed * deltaTime;
                    if (container.scrollLeft <= 0) {
                        container.scrollLeft += originalScrollWidth;
                    }
                    lastTime = currentTime;
                    requestAnimationFrame(animate);
                }

                // Start the animation
                requestAnimationFrame(animate);

                // Ensure images have no animations
                const images = document.querySelectorAll('.card img');
                images.forEach(img => {
                    img.style.animation = 'none';
                });
            </script>

            <!-- Inline CSS -->
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    overflow-x: hidden;
                }
            </style>

            <!-- JavaScript -->
            <!-- JavaScript -->
            <script src="Views/E-commerce-user/assets/js/jquery-3.3.1.min.js"></script>
            <script src="Views/E-commerce-user/assets/js/main.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const cartPanel = document.querySelector('.cart-panel');
                    const closeCart = document.querySelector('.close-cart');
                    const addToCartButtons = document.querySelectorAll('.add-to-cart');
                    const cartItemsContainer = document.querySelector('.cart-items');
                    const cartItemCount = document.querySelector('#cart-item-count');
                    const subtotalAmount = document.querySelector('#subtotal-amount');
                    const imageZoomModal = document.querySelector('.image-zoom-modal');
                    const zoomedImage = document.querySelector('#zoomed-image');
                    const backBtn = document.querySelector('.back-btn');
                    const zoomButtons = document.querySelectorAll('.image-zoom');
                    let cartItems = [];

                    // Load cart from localStorage on page load
                    try {
                        cartItems = JSON.parse(localStorage.getItem('cart')) || [];
                    } catch (e) {
                        console.error("Error parsing cart from localStorage:", e);
                        cartItems = [];
                    }

                    // Render cart items on page load
                    cartItems.forEach(item => addCartItem(item));
                    updateCartSummary();

                    // Cart Functionality
                    function toggleCart() {
                        cartPanel.classList.toggle('active');
                    }

                    closeCart.addEventListener('click', toggleCart);

                    addToCartButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            const productName = this.getAttribute('data-product-name');
                            const productPrice = parseFloat(this.getAttribute('data-product-price'));
                            const productImage = this.getAttribute('data-product-image');

                            const existingItem = cartItems.find(item => item.name === productName);
                            if (existingItem) {
                                existingItem.quantity += 1;
                                updateCartItem(existingItem);
                            } else {
                                const newItem = {
                                    name: productName,
                                    price: productPrice,
                                    image: productImage,
                                    quantity: 1
                                };
                                cartItems.push(newItem);
                                addCartItem(newItem);
                            }

                            // Save to localStorage
                            localStorage.setItem('cart', JSON.stringify(cartItems));
                            console.log("Cart after adding item:", cartItems);

                            if (!cartPanel.classList.contains('active')) {
                                toggleCart();
                            }
                            updateCartSummary();
                        });
                    });

                    function addCartItem(item) {
                        const cartItem = document.createElement('div');
                        cartItem.classList.add('cart-item');
                        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="cart-item-details">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn decrease-btn">-</button>
                    <input type="number" class="quantity-input" value="${item.quantity}" min="1">
                    <button class="quantity-btn increase-btn">+</button>
                </div>
            </div>
            <div class="cart-item-total">$${(item.price * item.quantity).toFixed(2)}</div>
            <div class="delete-btn"><i class="fa fa-trash"></i></div>
        `;
                        cartItemsContainer.appendChild(cartItem);

                        attachItemListeners(cartItem, item);
                    }

                    function updateCartItem(item) {
                        const cartItem = Array.from(cartItemsContainer.querySelectorAll('.cart-item')).find(
                            el => el.querySelector('.cart-item-name').textContent === item.name
                        );
                        const input = cartItem.querySelector('.quantity-input');
                        input.value = item.quantity;
                        cartItem.querySelector('.cart-item-total').textContent = `$${(item.price * item.quantity).toFixed(2)}`;
                        updateCartSummary();
                        // Save to localStorage
                        localStorage.setItem('cart', JSON.stringify(cartItems));
                    }

                    function attachItemListeners(cartItem, item) {
                        const decreaseBtn = cartItem.querySelector('.decrease-btn');
                        const increaseBtn = cartItem.querySelector('.increase-btn');
                        const quantityInput = cartItem.querySelector('.quantity-input');
                        const deleteBtn = cartItem.querySelector('.delete-btn');

                        decreaseBtn.addEventListener('click', () => {
                            if (item.quantity > 1) {
                                item.quantity--;
                                updateCartItem(item);
                            }
                        });

                        increaseBtn.addEventListener('click', () => {
                            item.quantity++;
                            updateCartItem(item);
                        });

                        quantityInput.addEventListener('change', () => {
                            let value = parseInt(quantityInput.value);
                            if (value < 1 || isNaN(value)) value = 1;
                            item.quantity = value;
                            updateCartItem(item);
                        });

                        deleteBtn.addEventListener('click', () => {
                            cartItem.remove();
                            cartItems = cartItems.filter(i => i.name !== item.name);
                            updateCartSummary();
                            // Save to localStorage
                            localStorage.setItem('cart', JSON.stringify(cartItems));
                        });
                    }

                    function updateCartSummary() {
                        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
                        const subtotal = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
                        cartItemCount.textContent = `${totalItems} items`;
                        subtotalAmount.textContent = `$${subtotal.toFixed(2)}`;
                    }

                    // Image Zoom Functionality
                    zoomButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            const imageUrl = this.getAttribute('data-image');
                            zoomedImage.src = imageUrl;
                            imageZoomModal.classList.add('active');
                            document.body.style.overflow = 'hidden'; // Prevent scrolling
                        });
                    });

                    backBtn.addEventListener('click', function() {
                        imageZoomModal.classList.remove('active');
                        document.body.style.overflow = 'auto'; // Restore scrolling
                    });

                    // Close modal when clicking outside the image
                    imageZoomModal.addEventListener('click', function(e) {
                        if (e.target === imageZoomModal) {
                            imageZoomModal.classList.remove('active');
                            document.body.style.overflow = 'auto';
                        }
                    });
                });
            </script>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<style>
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .icon-large {
            font-size: 2.5rem;
        }

        .stats h3 {
            font-size: 1.8rem;
        }
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        max-height: 180px;
        object-fit: contain;
    }

    .card-text {
        font-size: 12px;
        color: #666;
        margin-bottom: 10px;
    }

    .rating .star.filled {
        color: rgb(255, 217, 0);
    }

    .rating .rating-value {
        font-size: 12px;
        color: #666;
        margin-left: 5px;
    }

    .price {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    @media (max-width: 767px) {

        .filter,
        .filter-categories {
            margin: 0 15px 20px;
        }

        .card {
            margin: 0 auto;
            max-width: 300px;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .profile {
            padding: 40px 20px;
            /* Adjust padding for smaller screens */
        }
    }
</style>

</html>