   <style>
  

     .hygiene-section .card {
       height: 95%;
       display: flex;
       flex-direction: column;
       border-radius: 12px;
       transition: background-color 0.3s ease;
     }

     .hygiene-section .btn-success {

       border-radius: 50px;

     }

     .hygiene-section .card img {
       max-height: 110px;
       width: auto;
       object-fit: contain;
       margin: 0 auto;
       transition: transform 0.3s ease;
     }

     .hygiene-section .card:hover img {
       transform: scale(1.05);
     }

     /* Star rating */
     .star-rating .star-icon {
       font-size: 1.5rem;
       color: #bbb;
       cursor: pointer;
       transition: color 0.3s ease;
     }

     .star-rating .star-icon.active {
       color: gold;
     }

     .star-rating .star-icon:hover {
       color: gold;
     }

     .product-img-container {
       height: 180px;
       background-color: #f8f9fa;
       display: flex;
       justify-content: center;
       align-items: center;
       position: relative;
     }

     .product-img-container img {
       max-height: 100%;
       object-fit: contain;
     }

     .view-details-btn {
       position: absolute;
       top: 50%;
       left: 50%;
       transform: translate(-50%, -50%);
       font-size: 0.7rem;
       background-color: rgba(0, 0, 0, 0.6);
       color: white;
       padding: 6px 8px;
       border: none;
       border-radius: 4px;
       z-index: 10;
     }

     .btn-purple {
       background-color: #6f42c1;
       border: none;
       padding: 0.4rem 0.8rem;
       font-size: 0.9rem;
       min-width: 85px;
       border-radius: 12px;
     }

     .btn-purple:hover {
       background-color: #5936a0;
     }

     .btn-green {
       background-color: #28a745;
       border: none;
       padding: 0.4rem 0.8rem;
       font-size: 0.9rem;
       min-width: 85px;
       border-radius: 12px;
     }

     .btn-green:hover {
       background-color: #218838;
     }

     .star {
       font-size: 1rem;
       color: #ccc;
       cursor: pointer;
       transition: color 0.2s;
     }

     .star:hover,
     .star.hovered {
       color: #ffcc00;
     }

     .star.filled {
       color: gold;
     }

     /* Heart icon styles */
     .bi-heart {
       cursor: pointer;
       font-size: 1.2rem;
       color: #ccc;
       transition: color 0.2s;
     }

     .bi-heart.filled {
       color: #ff0000;
     }

     .bi-heart:hover {
       color: #ff0000;
     }
   </style>
   <section class="hero-section">
     <div class="container">
       <div class="row align-items-center">
         <!-- Large Product Image -->
         <div class="col-md-6 text-center p-0">
           <img src="views/assets/images/Feminine Hygiene (10)/ACNES.png"
             alt="Ranger Scout Low Smoke Coil"
             class="img-fluid w-100"
             style="max-height: 400px; object-fit: contain;">
         </div>
         <!-- Product Info -->
         <div class="col-md-6">
           <div class="hero-content">
             <h4>Best Quality Products</h4>
             <h1>ACNES </h1>
             <p>
               ACNES provides high-quality skincare solutions specially formulated to fight acne, reduce inflammation, and restore your skin's natural glow. Trusted by millions, our products are dermatologically tested and safe for everyday use.</p>
             <a href="/product" class="shop-btn"><i class="bi bi-cart"></i> Shop Now</a>
           </div>
         </div>
       </div>
     </div>
     <div class="background-pattern"></div>
   </section>
   <section class="benefits-section">
     <div class="container">
       <div class="row g-3">
         <div class="col-6 col-md-3">
           <div class="benefit-card">
             <i class="bi bi-truck benefit-icon"></i>
             <h5>Free Shipping</h5>
             <p>Above $5 Only</p>
           </div>
         </div>
         <div class="col-6 col-md-3">
           <div class="benefit-card">
             <i class="bi bi-patch-check-fill benefit-icon"></i>
             <h5>Certified Organic</h5>
             <p>100% Guarantee</p>
           </div>
         </div>
         <div class="col-6 col-md-3">
           <div class="benefit-card">
             <i class="bi bi-cash-coin benefit-icon"></i>
             <h5>Huge Serving</h5>
             <p>At Lowest Price</p>
           </div>
         </div>
         <div class="col-6 col-md-3">
           <div class="benefit-card">
             <i class="bi bi-arrow-repeat benefit-icon"></i>
             <h5>Easy Returns</h5>
             <p>No Questions Asked</p>
           </div>
         </div>
       </div>
     </div>
   </section>
   </head>

   <body>
     <div class="container py-4">
       <div class="row" id="productList">
         <!-- Product Card 1 -->
         <div class="col-md-3 col-sm-6 mb-3" data-product-id="1">
           <div class="card text-start shadow-sm d-flex flex-column small-product-card">
             <div class="product-img-container">
               <img src="views/assets/about-images/Pocari Sweat.png" alt="Pocari Sweat" class="img-fluid">
               <button class="view-details-btn" onclick="viewDetails(1)">Pocari Sweat</button>
             </div>
             <div class="card-body d-flex flex-column p-2">
               <div class="d-flex justify-content-between align-items-center mb-1">
                 <h6 class="card-title mb-0">Pocari Sweat</h6>
                 <i class="bi bi-heart" data-heart-id="1" onclick="toggleFavorite(this, 1)"></i>
               </div>
               <div class="rating mb-1" data-product-id="1">
                 <span class="star" onclick="setRating(1, 1)" onmouseover="highlightStars(1, 1)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 2)" onmouseover="highlightStars(1, 2)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 3)" onmouseover="highlightStars(1, 3)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 4)" onmouseover="highlightStars(1, 4)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 5)" onmouseover="highlightStars(1, 5)" onmouseout="resetStars(1)">★</span>
                 <span class="rating-value" id="rating-value-1">(0)</span>
               </div>
               <p class="card-text small">Product description goes here.</p>
               <div class="price mt-auto fw-bold">Price: $1</div>
               <div class="d-flex justify-content-between mt-2">
                 <button class="btn btn-purple text-white" onclick="addToCart(1)">
                   <i class="bi bi-cart"></i> Add​ to card
                 </button>
                 <button class="btn btn-green text-white" onclick="buyNow(1)">
                   <i class="bi bi-check-circle"></i> Buy Now
                 </button>
               </div>
             </div>
           </div>
         </div>

         <!-- Product Card 1 -->
         <div class="col-md-3 col-sm-6 mb-3" data-product-id="1">
           <div class="card text-start shadow-sm d-flex flex-column small-product-card">
             <div class="product-img-container">
               <img src="views/assets/about-images/Pao Pink Detergent.png" alt="Pao Pink" class="img-fluid">
               <button class="view-details-btn" onclick="viewDetails(1)">View Details</button>
             </div>
             <div class="card-body d-flex flex-column p-2">
               <div class="d-flex justify-content-between align-items-center mb-1">
                 <h6 class="card-title mb-0">Pao Pink</h6>
                 <i class="bi bi-heart" data-heart-id="1" onclick="toggleFavorite(this, 1)"></i>
               </div>
               <div class="rating mb-1" data-product-id="1">
                 <span class="star" onclick="setRating(1, 1)" onmouseover="highlightStars(1, 1)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 2)" onmouseover="highlightStars(1, 2)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 3)" onmouseover="highlightStars(1, 3)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 4)" onmouseover="highlightStars(1, 4)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 5)" onmouseover="highlightStars(1, 5)" onmouseout="resetStars(1)">★</span>
                 <span class="rating-value" id="rating-value-1">(0)</span>
               </div>
               <p class="card-text small">Pao Pink 4300g Powder .</p>
               <div class="price mt-auto fw-bold">Price: $7.00</div>
               <div class="d-flex justify-content-between mt-2">
                 <button class="btn btn-purple text-white" onclick="addToCart(1)">
                   <i class="bi bi-cart"></i> Add to card
                 </button>
                 <button class="btn btn-green text-white" onclick="buyNow(1)">
                   <i class="bi bi-check-circle"></i> Buy Now
                 </button>
               </div>
             </div>
           </div>
         </div>

         <!-- Product Card 1 -->
         <div class="col-md-3 col-sm-6 mb-3" data-product-id="1">
           <div class="card text-start shadow-sm d-flex flex-column small-product-card">
             <div class="product-img-container">
               <img src="views/assets/about-images/ACNES.png" alt="ACNES" class="img-fluid">
               <button class="view-details-btn" onclick="viewDetails(1)">View Details</button>
             </div>
             <div class="card-body d-flex flex-column p-2">
               <div class="d-flex justify-content-between align-items-center mb-1">
                 <h6 class="card-title mb-0">ACNES</h6>
                 <i class="bi bi-heart" data-heart-id="1" onclick="toggleFavorite(this, 1)"></i>
               </div>
               <div class="rating mb-1" data-product-id="1">
                 <span class="star" onclick="setRating(1, 1)" onmouseover="highlightStars(1, 1)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 2)" onmouseover="highlightStars(1, 2)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 3)" onmouseover="highlightStars(1, 3)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 4)" onmouseover="highlightStars(1, 4)" onmouseout="resetStars(1)">★</span>
                 <span class="star" onclick="setRating(1, 5)" onmouseover="highlightStars(1, 5)" onmouseout="resetStars(1)">★</span>
                 <span class="rating-value" id="rating-value-1">(0)</span>
               </div>
               <p class="card-text small">Product description goes here.</p>
               <div class="price mt-auto fw-bold">Price: $1.5</div>
               <div class="d-flex justify-content-between mt-2">
                 <button class="btn btn-purple text-white" onclick="addToCart(1)">
                   <i class="bi bi-cart"></i> Add to card
                 </button>
                 <button class="btn btn-green text-white" onclick="buyNow(1)">
                   <i class="bi bi-check-circle"></i> Buy Now
                 </button>
               </div>
             </div>
           </div>
         </div>

         <!-- Product Card 2 -->
         <div class="col-md-3 col-sm-6 mb-3" data-product-id="2">
           <div class="card text-start shadow-sm d-flex flex-column small-product-card">
             <div class="product-img-container">
               <img src="views/assets/images/Snacks (7)/Buldak hot.png" alt="Buldak hot" class="img-fluid">
               <button class="view-details-btn" onclick="viewDetails(2)">View Details</button>
             </div>
             <div class="card-body d-flex flex-column p-2">
               <div class="d-flex justify-content-between align-items-center mb-1">
                 <h6 class="card-title mb-0">Buldak hot</h6>
                 <i class="bi bi-heart" data-heart-id="2" onclick="toggleFavorite(this, 2)"></i>
               </div>
               <div class="rating mb-1" data-product-id="2">
                 <span class="star" onclick="setRating(2, 1)" onmouseover="highlightStars(2, 1)" onmouseout="resetStars(2)">★</span>
                 <span class="star" onclick="setRating(2, 2)" onmouseover="highlightStars(2, 2)" onmouseout="resetStars(2)">★</span>
                 <span class="star" onclick="setRating(2, 3)" onmouseover="highlightStars(2, 3)" onmouseout="resetStars(2)">★</span>
                 <span class="star" onclick="setRating(2, 4)" onmouseover="highlightStars(2, 4)" onmouseout="resetStars(2)">★</span>
                 <span class="star" onclick="setRating(2, 5)" onmouseover="highlightStars(2, 5)" onmouseout="resetStars(2)">★</span>
                 <span class="rating-value" id="rating-value-2">(0)</span>
               </div>
               <p class="card-text small">Another product description.</p>
               <div class="price mt-auto fw-bold">Price: $1.5</div>
               <div class="d-flex justify-content-between mt-2">
                 <button class="btn btn-purple text-white" onclick="addToCart(2)">
                   <i class="bi bi-cart"></i> Add to card
                 </button>
                 <button class="btn btn-green text-white" onclick="buyNow(2)">
                   <i class="bi bi-check-circle"></i> Buy Now
                 </button>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     </div>

     </head>

     <body>

       <section class="hygiene-section py-5">
         <div class="container">
           <h2 class="text-center text-dark mb-5">Hygiene Categories</h2>
           <div class="row justify-content-center g-4">
             <!-- Card 1 -->
             <div class="col-md-4 d-flex align-items-stretch">
               <div class="card text-center p-4 shadow-sm w-100">
                 <div class="card-body">
                   <h3 class="card-title">Oral Health</h3>
                   <p class="card-text">Take care of your oral hygiene with top-rated products.</p>
                   <div class="star-rating mb-2" id="rating-1">
                     <span class="star-icon" data-star="1" onclick="setRating(1, 1)" title="1 Star">★</span>
                     <span class="star-icon" data-star="2" onclick="setRating(1, 2)" title="2 Stars">★</span>
                     <span class="star-icon" data-star="3" onclick="setRating(1, 3)" title="3 Stars">★</span>
                     <span class="star-icon" data-star="4" onclick="setRating(1, 4)" title="4 Stars">★</span>
                     <span class="star-icon" data-star="5" onclick="setRating(1, 5)" title="5 Stars">★</span>
                     <span class="rating-value" data-rating-id="1">(0)</span>
                   </div>
                   <button class="btn btn-success">
                     <i class="fas fa-heart"></i> Shop Now
                   </button>
                 </div>
                 <img src="views/assets/images/Oral Health (10)/Colgate salt.png" alt="Oral Health Product" class="img-fluid">
               </div>
             </div>

             <!-- Card 2 -->
             <div class="col-md-4 d-flex align-items-stretch">
               <div class="card text-center p-4 shadow-sm w-100">
                 <div class="card-body">
                   <h3 class="card-title">Household Hygiene</h3>
                   <p class="card-text">Keep your home fresh and germ-free with our hygiene essentials.</p>
                   <div class="star-rating mb-2" id="rating-2">
                     <span class="star-icon" data-star="1" onclick="setRating(2, 1)" title="1 Star">★</span>
                     <span class="star-icon" data-star="2" onclick="setRating(2, 2)" title="2 Stars">★</span>
                     <span class="star-icon" data-star="3" onclick="setRating(2, 3)" title="3 Stars">★</span>
                     <span class="star-icon" data-star="4" onclick="setRating(2, 4)" title="4 Stars">★</span>
                     <span class="star-icon" data-star="5" onclick="setRating(2, 5)" title="5 Stars">★</span>
                     <span class="rating-value" data-rating-id="2">(0)</span>
                   </div>
                   <button class="btn btn-success">
                     <i class="fas fa-heart"></i> Shop Now
                   </button>
                 </div>
                 <img src="views/assets/images/House Hold Hygiene (11)/Raid.png" alt="Household Hygiene Product" class="img-fluid">
               </div>
             </div>

             <!-- Card 3 -->
             <div class="col-md-4 d-flex align-items-stretch">
               <div class="card text-center p-4 shadow-sm w-100">
                 <div class="card-body">
                   <h3 class="card-title">Feminine Hygiene</h3>
                   <p class="card-text">Personal care products designed for your comfort and health.</p>
                   <div class="star-rating mb-2" id="rating-3">
                     <span class="star-icon" data-star="1" onclick="setRating(3, 1)" title="1 Star">★</span>
                     <span class="star-icon" data-star="2" onclick="setRating(3, 2)" title="2 Stars">★</span>
                     <span class="star-icon" data-star="3" onclick="setRating(3, 3)" title="3 Stars">★</span>
                     <span class="star-icon" data-star="4" onclick="setRating(3, 4)" title="4 Stars">★</span>
                     <span class="star-icon" data-star="5" onclick="setRating(3, 5)" title="5 Stars">★</span>
                     <span class="rating-value" data-rating-id="3">(0)</span>
                   </div>
                   <button class="btn btn-success">
                     <i class="fas fa-heart"></i> Shop Now
                   </button>
                 </div>
                 <img src="views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Feminine Hygiene Product" class="img-fluid">
               </div>
             </div>
           </div>
         </div>
       </section>
       <div class="trending-container container text-center my-5">
         <h1 class="trending-section-title">Trending Product</h1>
         <div class="trending-row row">
           <!-- Product 1 - Vaseline -->
           <div class="trending-col col-md-3 mb-4" data-product-id="2">
             <div class="trending-card card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
               <div class="trending-img-container bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                 <img src="views/assets/images/Cooking ingredients (20)/KK Ketchup.png" alt="Vaseline" class="trending-img img-fluid" style="max-height: 100%; object-fit: contain;">
                 <button class="trending-view-btn view-details-btn" onclick="viewDetails(2)">View Details</button>
               </div>
               <div class="trending-card-body card-body d-flex flex-column">
                 <div class="trending-header d-flex justify-content-between align-items-center mb-2">
                   <h6 class="trending-title card-title">KK Ketchup</h6>
                   <i class="trending-favorite bi bi-heart" data-heart-id="2" onclick="toggleFavorite(2)"></i>
                 </div>
                 <div class="trending-rating rating mb-2">
                   <span class="trending-star star" data-star="1" onclick="setRating(2, 1)">★</span>
                   <span class="trending-star star" data-star="2" onclick="setRating(2, 2)">★</span>
                   <span class="trending-star star" data-star="3" onclick="setRating(2, 3)">★</span>
                   <span class="trending-star star" data-star="4" onclick="setRating(2, 4)">★</span>
                   <span class="trending-star star" data-star="5" onclick="setRating(2, 5)">☆</span>
                   <span class="trending-rating-value rating-value" data-rating-id="2">(0)</span>
                 </div>
                 <div class="trending-price price mt-auto">Price: $1</div>
                 <div class="trending-actions d-flex justify-content-between mt-2">
                   <button class="trending-cart-btn btn btn-purple text-white" onclick="addToCart(2)"><i class="bi bi-cart"></i> Add to Cart</button>
                   <button class="trending-buy-btn btn btn-green text-white" style="border-radius: 8px;"><i class="bi bi-check-circle"></i> Buy Now</button>
                 </div>
               </div>
             </div>
           </div>

           <!-- Product 2 - Vaseline -->
           <div class="trending-col col-md-3 mb-4" data-product-id="3">
             <div class="trending-card card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
               <div class="trending-img-container bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                 <img src="views/assets/images/Tissue (6)/Keepo pink.png" alt="Vaseline" class="trending-img img-fluid" style="max-height: 100%; object-fit: contain;">
                 <button class="trending-view-btn view-details-btn" onclick="viewDetails(3)">View Details</button>
               </div>
               <div class="trending-card-body card-body d-flex flex-column">
                 <div class="trending-header d-flex justify-content-between align-items-center mb-2">
                   <h6 class="trending-title card-title">Keepo pink</h6>
                   <i class="trending-favorite bi bi-heart" data-heart-id="3" onclick="toggleFavorite(3)"></i>
                 </div>
                 <div class="trending-rating rating mb-2">
                   <span class="trending-star star" data-star="1" onclick="setRating(3, 1)">★</span>
                   <span class="trending-star star" data-star="2" onclick="setRating(3, 2)">★</span>
                   <span class="trending-star star" data-star="3" onclick="setRating(3, 3)">★</span>
                   <span class="trending-star star" data-star="4" onclick="setRating(3, 4)">★</span>
                   <span class="trending-star star" data-star="5" onclick="setRating(3, 5)">☆</span>
                   <span class="trending-rating-value rating-value" data-rating-id="3">(0)</span>
                 </div>
                 <div class="trending-price price mt-auto">Price: $3.2</div>
                 <div class="trending-actions d-flex justify-content-between mt-2">
                   <button class="trending-cart-btn btn btn-purple text-white" onclick="addToCart(3)"><i class="bi bi-cart"></i> Add to Cart</button>
                   <button class="trending-buy-btn btn btn-green text-white" style="border-radius: 8px;"><i class="bi bi-check-circle"></i> Buy Now</button>
                 </div>
               </div>
             </div>
           </div>

           <!-- Product 3 - Vaseline -->
           <div class="trending-col col-md-3 mb-4" data-product-id="4">
             <div class="trending-card card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
               <div class="trending-img-container bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                 <img src="views/assets/images/Snacks (7)/Buldak hot.png" alt="Vaseline" class="trending-img img-fluid" style="max-height: 100%; object-fit: contain;">
                 <button class="trending-view-btn view-details-btn" onclick="viewDetails(4)">View Details</button>
               </div>
               <div class="trending-card-body card-body d-flex flex-column">
                 <div class="trending-header d-flex justify-content-between align-items-center mb-2">
                   <h6 class="trending-title card-title">Buldak hot</h6>
                   <i class="trending-favorite bi bi-heart" data-heart-id="4" onclick="toggleFavorite(4)"></i>
                 </div>
                 <div class="trending-rating rating mb-2">
                   <span class="trending-star star" data-star="1" onclick="setRating(4, 1)">★</span>
                   <span class="trending-star star" data-star="2" onclick="setRating(4, 2)">★</span>
                   <span class="trending-star star" data-star="3" onclick="setRating(4, 3)">★</span>
                   <span class="trending-star star" data-star="4" onclick="setRating(4, 4)">★</span>
                   <span class="trending-star star" data-star="5" onclick="setRating(4, 5)">☆</span>
                   <span class="trending-rating-value rating-value" data-rating-id="4">(0)</span>
                 </div>
                 <div class="trending-price price mt-auto">Price: $1.5</div>
                 <div class="trending-actions d-flex justify-content-between mt-2">
                   <button class="trending-cart-btn btn btn-purple text-white" onclick="addToCart(4)"><i class="bi bi-cart"></i> Add to Cart</button>
                   <button class="trending-buy-btn btn btn-green text-white" style="border-radius: 8px;"><i class="bi bi-check-circle"></i> Buy Now</button>
                 </div>
               </div>
             </div>
           </div>

           <!-- Product 4 - Water -->
           <div class="trending-col col-md-3 mb-4" data-product-id="5">
             <div class="trending-card card text-start shadow-sm d-flex flex-column" style="border-radius: 12px; overflow: hidden; height: 100%;">
               <div class="trending-img-container bg-light d-flex justify-content-center align-items-center" style="height: 180px; border-top-left-radius: 12px; border-top-right-radius: 12px; position: relative;">
                 <img src="views/assets/images/Clothing(7)/Fineline Liquid Detergent.png" alt="Water" class="trending-img img-fluid" style="max-height: 100%; object-fit: contain;">
                 <button class="trending-view-btn view-details-btn" onclick="viewDetails(5)">View Details</button>
               </div>
               <div class="trending-card-body card-body d-flex flex-column">
                 <div class="trending-header d-flex justify-content-between align-items-center mb-2">
                   <h6 class="trending-title card-title">Liquid Detergent</h6>
                   <i class="trending-favorite bi bi-heart" data-heart-id="5" onclick="toggleFavorite(5)"></i>
                 </div>
                 <div class="trending-rating rating mb-2">
                   <span class="trending-star star" data-star="1" onclick="setRating(5, 1)">★</span>
                   <span class="trending-star star" data-star="2" onclick="setRating(5, 2)">★</span>
                   <span class="trending-star star" data-star="3" onclick="setRating(5, 3)">★</span>
                   <span class="trending-star star" data-star="4" onclick="setRating(5, 4)">★</span>
                   <span class="trending-star star" data-star="5" onclick="setRating(5, 5)">☆</span>
                   <span class="trending-rating-value rating-value" data-rating-id="5">(0)</span>
                 </div>
                 <div class="trending-price price mt-auto">Price: $7.1</div>
                 <div class="trending-actions d-flex justify-content-between mt-2">
                   <button class="btn btn-purple text-white" onclick="addToCart(5)">
                     <i class="bi bi-check-circle"></i> Add to Cart
                   </button>

                   <button class="btn btn-green text-white" style="border-radius: 8px;">
                     <i class="bi bi-check-circle"></i> Buy Now
                   </button>
                 </div>
               </div>
             </div>​
           </div>
         </div>
       </div>
       <div class="deal-section">
         <!-- Testimonial Card 1 -->
         <div class="testimonial-card">
           <div class="stars">★★★★★</div>

           <p>Experience exceptional cleaning power that removes tough stains while protecting your fabrics
             Choose from our biodegradable formulas designed for eco-conscious households
             Enjoy premium quality results at prices that fit every budget</p>
           <img src="https://i.imgur.com/8Km9tLL.png" alt="User" class="user-avatar">
           <h6>Mila Kunis</h6>
         </div>

         <!-- Deal of The Day -->
         <div class="deal-card">
           <img src="views/assets/images/Feminine Hygiene (10)/ACNES.png" alt="Deal Image">
           <!-- <div class="deal-text text-light">Deal Of The Day <br> 15% Off On All Vegetables!</div> -->
         </div>

         <!-- Testimonial Card 2 -->
         <div class="testimonial-card">
           <div class="stars">★★★★★</div>
           <p> Unmatched stain removal that preserves fabric quality
             Environmentally responsible biodegradable options
             Premium performance at budget-friendly prices you can paragrap</p>
           <img src="https://i.imgur.com/8Km9tLL.png" alt="User" class="user-avatar">
           <h6>Mila Kunis</h6>
         </div>
       </div>
       <!-- Rating Script -->
       <script>
         function setRating(cardId, rating) {
           const stars = document.querySelectorAll(`#rating-${cardId} .star-icon`);
           const ratingValue = document.querySelector(`[data-rating-id="${cardId}"]`);
           stars.forEach((star, index) => {
             star.classList.toggle('active', index < rating);
           });
           ratingValue.textContent = `(${rating})`;
         }
       </script>
       <script>
         // Function to handle the star rating click
         function setRating(ratingId, star) {
           let stars = document.querySelectorAll(`#rating-${ratingId} .star-icon`);
           let ratingValue = document.querySelector(`.rating-value[data-rating-id="${ratingId}"]`);

           // Reset all stars
           stars.forEach(star => {
             star.classList.remove('active');
           });

           for (let i = 0; i < star; i++) {
             stars[i].classList.add('active');
           }
           ratingValue.textContent = `(${star})`;
         }
       </script>