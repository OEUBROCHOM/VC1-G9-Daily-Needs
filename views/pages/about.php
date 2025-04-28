
    <style>
        /* Global Styles */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6{
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
        }

        /* Profile Section Styling */
        .profile {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; 
            background-color:rgb(233, 166, 226);
            padding: 0 20px; 
        }

        .profile .container {
            max-width: 1200px;
            width: 100%;
        }

        .profile-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
        }

        .profile-img {
            transition: transform 0.3s ease, opacity 0.3s ease;
            border-radius: 15px;
            width: 50%;
            height: auto;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .text-success {
            color:orange !important;
        }

        .btn-success {
            background-color:rgb(191, 73, 223);
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-success:hover {
            background-color:rgb(94, 10, 81);
            transform: translateY(-2px);
        }

        .lead {
            font-size: 1.25rem;
            line-height: 1.8;
            font-weight: 400;
            color: #555;
        }

        .text-muted {
            color: #6c757d !important;
        }
        /* card  */
        
        /* Card Icons */
        .icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .icon-large {
            font-size: 2.5rem;
        }

        /* Card Text */
        .card-title {
            font-size: 20px;
            font-weight: bold;
        }

        /* Stats Section */
        .stats h3 {
            font-size: 2rem;
        }

        /* Base styles for cards */
        .small-card {
            border: 2px solid #ccc;
            position: relative;
            overflow: hidden;
            background-color: #fff; 
            color: #333;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        }
        /* Hover State: Color changes and lifts */
        .hover-effect:hover {
            transform: translateY(-5px);  
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);  
            border-color:rgb(27, 155, 96); 
            background-color: #fff; 
            color: #3cdb6e; 
        }
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

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }

        .rating {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .rating .star {
            font-size: 14px;
            cursor: pointer;
            color: #dddd;
            transition: color 0.2s ease;
        }
                .transition-card {
                    transition: transform 0.3s ease, background 0.3s ease;
                }
            
                .transition-card:hover {
                    transform: translateY(-10px);
                    background: #f8f9fa;
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

        .btn-purple,
        .btn-green {
            border-radius: 15px;
            font-size: 12px;
            padding: 8px;
            width: 48%;
            transition: background-color 0.3s ease;
        }

        .btn-purple {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        .btn-purple:hover {
            background-color: #5a2b96;
            border-color: #5a2b96;
        }

        .btn-green {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-green:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .bi-heart,
        .bi-heart-fill {
            font-size: 16px;
            cursor: pointer;
        }

        .bi-heart-fill {
            color: #6f42c1;
        }

        .view-details-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover .view-details-btn {
            opacity: 1;
        }

        .col-md-9 {
        text-align: center;
        margin-top: 30px;
        
            margin-left: 30vh;
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
                padding: 40px 20px; /* Adjust padding for smaller screens */
            }

            .profile-img-wrapper {
                margin-bottom: 20px;
            }

            .lead {
                font-size: 1.1rem;
            }

            .profile .row {
                flex-direction: column-reverse;
                text-align: center;
            }

            .profile-img {
                max-width: 80%; /* Adjust image size for smaller screens */
                margin: 0 auto;
            }
        }
    </style>

    <!-- Profile Section -->
    <section class="profile py-5" style="background-color: Lavender;">
    <div class="container">
        <div class="row align-items-center flex-md-row-reverse">
            <!-- 🖼️ Image Section -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <div class="profile-img-wrapper">
                    <img id="profileImg" src="views/assets/about-images/card.png" alt="Profile Picture" class="profile-img img-fluid">
                </div>
            </div>
            <!-- 📝 Text Section -->
            <div class="col-md-7">
                <h2 id="sectionTitle" class="mb-3 fw-bold text-success">We Are Your Favorite Store</h2>
                <p id="sectionDescription" class="text-muted lead mb-3">Discover high-quality products at great prices, curated for your satisfaction.</p>
                <p id="sectionAdditionalInfo" class="text-muted mb-4">We prioritize trust, innovation, and community to deliver exceptional value.</p>
                <a href="/product" class="btn btn-success btn-lg mt-3 px-4 py-2 rounded-pill shadow-sm">Explore Products</a>
            </div>
        </div>
    </div>
</section>
 <!-- Stats Section -->
 <section class="stats py-5 bg-dark text-white">
         <div class="container">
             <div class="row text-center text-md-start align-items-center">
                 <!-- Title Section -->
                 <div class="col-md-3 mb-3 mb-md-0">
                     <h4 class="fw-bold mb-4 fs-4">Numbers Speak <br>for Themselves!</h4>
                     <p class="text-muted small">Impressive stats about our products and categories!</p>
                 </div>
                 <!-- Stats Item 1 -->
                 <div class="col-md-3 stat text-center mb-3 mb-md-0">
                     <div class="icon-overlay mb-3">
                         <i class="bi bi-boxes text-success icon-large"></i>
                     </div>
                     <h3 class="fw-bold fs-3" id="owned-products">0+</h3>
                     <h6 class="text-light">Owned Products</h6>
                 </div>
                 <!-- Stats Item 2 -->
                 <div class="col-md-3 stat text-center mb-3 mb-md-0">
                     <div class="icon-overlay mb-3">
                         <i class="bi bi-tags text-success icon-large"></i>
                     </div>
                     <h3 class="fw-bold fs-3" id="curated-products">0+</h3>
                     <h6 class="text-light">Curated Products</h6>
                 </div>

                 <!-- Stats Item 3 -->
                 <div class="col-md-3 stat text-center mb-3 mb-md-0">
                     <div class="icon-overlay mb-3">
                         <i class="bi bi-grid text-success icon-large"></i>
                     </div>
                     <h3 class="fw-bold fs-3" id="product-categories">0+</h3>
                     <h6 class="text-light">Product Categories</h6>
                 </div>
             </div>
         </div>
     </section>

    <!-- Product Cards Section -->
    <div class="col-md-9">
        <h2 class="mb-4">Our Category</h2>
                <div class="row px-3 py-4" id="productList">
                    <!-- Product Card 1 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="1">
                        <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                                <img src="/views/assets/images/Snacks (7)/Buldak hot.png" alt="Floral Serum" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                <button class="view-details-btn" onclick="viewDetails(1)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Buldak hot</h6>
                                    <i class="bi bi-heart" data-heart-id="1" onclick="toggleFavorite(1)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(1, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(1, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(1, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(1, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(1, 5)">★</span>
                                    <span class="rating-value" data-rating-id="1">(0)</span>
                                </div>
                                <p class="card-text">Hydrate your skin with this lightweight floral serum.</p>
                                <div class="price mt-auto">Price: $50.99</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-purple text-white" onclick="addToCart(1)"><i class="bi bi-cart"></i> Add to Cart</button> 
                                    <button class="btn btn-green text-white" style="border-radius: 8px;"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- card 2 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="2">
                        <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                                <img src="/views/assets/images/Snacks (7)/Good Noodle.png" alt="Serum 2" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                <button class="view-details-btn" onclick="viewDetails(2)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Good Noodle</h6>
                                    <i class="bi bi-heart" data-heart-id="2" onclick="toggleFavorite(2)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(2, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(2, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(2, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(2, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(2, 5)">★</span>
                                    <span class="rating-value" data-rating-id="2">(0)</span>
                                </div>
                                <p class="card-text">Revitalize your skin with this amazing serum.</p>
                                <div class="price mt-auto">Price: $40.99</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-purple text-white" onclick="addToCart(2)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card 3 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="3">
                        <div class="card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                                <img src="/views/assets/images/Snacks (7)/Mama Pork pack.png" alt="Serum 3" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                <button class="view-details-btn" onclick="viewDetails(3)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Mama Pork pack</h6>
                                    <i class="bi bi-heart" data-heart-id="3" onclick="toggleFavorite(3)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(3, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(3, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(3, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(3, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(3, 5)">★</span>
                                    <span class="rating-value" data-rating-id="3">(0)</span>
                                </div>
                                <p class="card-text">Nourish your skin with this amazing product.</p>
                                <div class="price mt-auto">Price: $45.99</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-purple text-white" onclick="addToCart(3)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 4 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="4">
                        <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Clothing(7)/Comfort Blue.png" alt="Serum 4" class="img-fluid">
                                <button class="view-details-btn" onclick="viewDetails(4)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Comfort Blue</h6>
                                    <i class="bi bi-heart" data-heart-id="4" onclick="toggleFavorite(4)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(4, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(4, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(4, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(4, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(4, 5)">★</span>
                                    <span class="rating-value" data-rating-id="4">(0)</span>
                                </div>
                                <p class="card-text">Replenish your skin with this amazing serum.</p>
                                <div class="price mt-auto">Price: $60.99</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-purple text-white" onclick="addToCart(4)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 5 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="5">
                        <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Serum 5" class="img-fluid">
                                <button class="view-details-btn" onclick="viewDetails(5)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Fineline Liquid Detergent</h6>
                                    <i class="bi bi-heart" data-heart-id="5" onclick="toggleFavorite(5)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(5, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(5, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(5, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(5, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(5, 5)">★</span>
                                    <span class="rating-value" data-rating-id="5">(0)</span>
                                </div>
                                <p class="card-text">Moisturize your skin with this floral serum.</p>
                                <div class="price mt-auto">Price: $55.99</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-purple text-white" onclick="addToCart(5)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 6 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="6">
                        <div class="card text-start d-flex flex-column" style="border-radius: 10px; overflow: hidden; height: 100%;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Clothing(7)/Pao Pink Detergent.png" alt="Serum 6" class="img-fluid">
                                <button class="view-details-btn" onclick="viewDetails(6)">View Details</button>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Pao Pink Detergent</h6>
                                    <i class="bi bi-heart" data-heart-id="6" onclick="toggleFavorite(6)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(6, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(6, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(6, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(6, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(6, 5)">★</span>
                                    <span class="rating-value" data-rating-id="6">(0)</span>
                                </div>
                                <p class="card-text">A refreshing serum for daily use.</p>
                                <div class="price mt-auto">Price: $42.99</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-purple text-white" onclick="addToCart(6)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 7 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="7">
                        <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Tissue (6)/keepo purple.png" alt="Serum 7" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                                <button class="view-details-btn" onclick="viewDetails(7)">View Details</button>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">keepo purple</h6>
                                    <i class="bi bi-heart" data-heart-id="7" onclick="toggleFavorite(7)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(7, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(7, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(7, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(7, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(7, 5)">★</span>
                                    <span class="rating-value" data-rating-id="7">(0)</span>
                                </div>
                                <p class="card-text">Hydrate and nourish with this serum.</p>
                                <div class="price">Price: $48.99</div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-purple text-white" onclick="addToCart(7)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 8 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="8">
                        <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="views/assets/images/Tissue (6)/Keepo Green.png" alt="Serum 8" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                                <button class="view-details-btn" onclick="viewDetails(8)">View Details</button>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">Keepo Green</h6>
                                    <i class="bi bi-heart" data-heart-id="8" onclick="toggleFavorite(8)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(8, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(8, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(8, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(8, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(8, 5)">★</span>
                                    <span class="rating-value" data-rating-id="8">(0)</span>
                                </div>
                                <p class="card-text">A lightweight serum for all skin types.</p>
                                <div class="price">Price: $52.99</div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-purple text-white" onclick="addToCart(8)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Card 9 -->
                    <div class="col-md-4 col-sm-6 mb-4" data-product-id="9">
                        <div class="card text-start" style="border-radius: 10px; overflow: hidden;">
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px; position: relative;">
                                <img src="/views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Serum 9" class="img-fluid" style="border-radius: 10px 10px 0 0;">
                                <button class="view-details-btn" onclick="viewDetails(9)">View Details</button>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="card-title">ACNES</h6>
                                    <i class="bi bi-heart" data-heart-id="9" onclick="toggleFavorite(9)"></i>
                                </div>
                                <div class="rating mb-2">
                                    <span class="star" data-star="1" onclick="setRating(9, 1)">★</span>
                                    <span class="star" data-star="2" onclick="setRating(9, 2)">★</span>
                                    <span class="star" data-star="3" onclick="setRating(9, 3)">★</span>
                                    <span class="star" data-star="4" onclick="setRating(9, 4)">★</span>
                                    <span class="star" data-star="5" onclick="setRating(9, 5)">★</span>
                                    <span class="rating-value" data-rating-id="9">(0)</span>
                                </div>
                                <p class="card-text">Glow up with this floral serum.</p>
                                <div class="price">Price: $49.99</div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-purple text-white" onclick="addToCart(9)"><i class="bi bi-cart"></i> Add to Cart</button>
                                    <button class="btn btn-green text-white"><i class="bi bi-check-circle"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- User Card Section -->
<div class="container mt-5">
    <div class="row text-center justify-content-center">
        <!-- Card 1 -->
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            <div class="small-card shadow-lg p-4 rounded-3 d-flex flex-column align-items-center transition-card" style="height: 270px; background: #fff;">
                <div class="icon mb-3">
                    <i class="fas fa-user-shield text-primary fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark">Secure Transactions</h6>
                <p class="text-muted text-center px-2">Your payments are encrypted and processed with top-tier security.</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            <div class="small-card shadow-lg p-4 rounded-3 d-flex flex-column align-items-center transition-card" style="height: 270px; background: #fff;">
                <div class="icon mb-3">
                    <i class="fas fa-globe text-success fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark">Global Access</h6>
                <p class="text-muted text-center px-2">Connect with clients and services worldwide with ease.</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            <div class="small-card shadow-lg p-4 rounded-3 d-flex flex-column align-items-center transition-card" style="height: 270px; background: #fff;">
                <div class="icon mb-3">
                    <i class="fas fa-headset text-warning fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark">24/7 Support</h6>
                <p class="text-muted text-center px-2">Our team is available anytime to assist you with your needs.</p>
            </div>
        </div>
    </div>
</div>

<script src="/views/assets/js/about.js"></script>
