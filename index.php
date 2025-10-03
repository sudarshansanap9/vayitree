<?php include './inc/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vayitree Handcrafted Simplicity</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" href="images/logo.png" type="image/x-icon">

  <style>
    /* --- Testimonial Section Styles --- */
    .testimonial-card {
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
        border-left: 5px solid #d81b60;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .testimonial-text {
        font-style: italic;
        color: #555;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        flex-grow: 1;
    }
    .testimonial-author {
        font-weight: bold;
        color: #333;
        margin-bottom: 1rem;
    }
    .testimonial-rating {
        color: #fdd835;
        font-size: 1.2rem;
    }
    .star-half {
        display: inline-block;
        position: relative;
    }
    .star-half::before {
        content: '⭐';
        position: absolute;
        left: 0;
        top: 0;
        width: 50%;
        overflow: hidden;
    }
    .testimonial-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 3rem auto;
        max-width: 1100px;
        padding: 0 1rem;
    }
    .testimonial-heading {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 2rem;
        margin-top: 3rem; /* Added margin top for spacing */
    }

    /* --- Attractive Product Card Styles (FIXED) --- */
    section.prod-cat-section {
        padding: 5rem 0;
        background-color: #f8f9fa;
        position: relative;
        border-top: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
    }
    
    section.prod-cat-section .container {
        display: block;
        text-align: center;
    }

    h2.prod-cat-heading {
        text-align: center;
        color: #333;
        margin-bottom: 3rem;
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 600;
        position: relative;
        padding-bottom: 1rem;
        display: inline-block; /* Helps center the underline correctly */
    }
    h2.prod-cat-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: #d81b60; /* Using your theme's pink color */
    }
    .prod-cat-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap; 
        gap: 2.5rem; /* Slightly more gap */
        padding: 1rem;
        max-width: 1400px;
        margin: 2rem auto 0; /* Added top margin */
    }
    a.prod-cat-link {
        text-decoration: none;
    }
    .prod-cat-card {
        position: relative;
        width: 300px;
        height: 420px;
        background-color: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        border: 1px solid #e9ecef; /* Added a subtle border */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05); /* Softer initial shadow */
        transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), 
                    box-shadow 0.4s cubic-bezier(0.25, 0.8, 0.25, 1),
                    border-color 0.4s ease;
    }
    .prod-cat-card:hover {
        transform: scale(1.05) translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-color: #d81b60; /* Highlight border on hover */
    }
    .prod-cat-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.5s ease, filter 0.5s ease;
    }
    .prod-cat-card:hover .prod-cat-image {
        transform: scale(1.1);
        filter: brightness(0.9);
    }
    .prod-cat-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding: 1.5rem;
        box-sizing: border-box;
        background: linear-gradient(180deg, rgba(0,0,0,0) 60%, rgba(0,0,0,0.9) 100%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    .prod-cat-card:hover .prod-cat-overlay {
        opacity: 1;
    }
    .prod-cat-title {
        color: #fff;
        font-size: 1.75rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        text-shadow: 0 2px 4px rgba(0,0,0,0.6);
        transform: translateY(20px);
        transition: transform 0.4s ease 0.1s;
    }
    .prod-cat-card:hover .prod-cat-title {
        transform: translateY(0);
    }

    /* --- Hero Carousel Styles (Updated for full image visibility) --- */
    #heroCarousel .carousel-item img {
        width: 100%;
        height: auto; /* Ensures image scales proportionally */
    }
    #heroCarousel {
        background-color: #f8f9fa; /* A light background color */
    }

    /* --- About Us Section --- */
    .about-us-section {
        padding: 5rem 0;
        background-color: #fff;
    }
    .about-us-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3rem;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    .about-us-image {
        flex: 1;
        min-width: 300px;
        max-width: 450px;
    }
    .about-us-image img {
        width: 100%;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .about-us-content {
        flex: 1;
        min-width: 300px;
        max-width: 600px;
    }
    .about-us-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: #a72b29; /* Theme color */
        margin-bottom: 1.5rem;
    }
    .about-us-content p {
        font-family: 'Poppins', sans-serif;
        color: #555;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    @media (max-width: 1024px) { 
         .prod-cat-container {
            flex-direction: column;
            gap: 2rem;
         }
        .prod-cat-card {
            width: 320px;
            height: 400px;
        }
    }
   
    @media (max-width: 768px) {
        .about-us-container {
            text-align: center;
        }
    }

  </style>
</head>

<body>

  <!-- Top Header -->
  <div class="top-header">
    <div class="container">
      <div class="contact-info">
        <a href="mailto:contact@sareestore.com"><i class="fa fa-envelope"></i> contact@sareestore.com</a>
        <a href="tel:+919767734369"><i class="fa fa-phone"></i> +91-9767734369</a>
      </div>
      <div class="social-icons">
        <a href="https://facebook.com/profile.php?id=100063918199444" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://instagram.com/house_of_vayitree/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/+919767734369" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>

  <!-- Logo + Search -->
  <div class="logo-search-bar">
    <div class="container">
      <div class="logo">
        <img src="images/logo.png" alt="Vayitree Logo" />
      </div>
      <div class="search-box">
        <form action="index.php" method="GET">
          <input type="text" name="search" placeholder="Search for sarees..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Navigation Bar -->
  <nav class="navbar">
    <div class="container">
      <input type="checkbox" id="menu-toggle" />
      <label for="menu-toggle" class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
      </label>

      <ul class="nav-links">
        <li><a href="new-arrival.php">New Arrival</a></li>
        <li class="dropdown">
          <a href="sarees.php">Sarees <i class="fas fa-caret-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="pure-cotton.php">Dakshinayann</a></li>
            <li><a href="pure-silk.php">Parampara (Tradition of Bengal)</a></li>
            <li><a href="pure-cotton-silk.php">Garima (Pride of Maharashtra)</a></li>
            <li><a href="pure-cotton.php">Kausheya (Essence of Chhattisgarh)</a></li>
            <li><a href="pure-silk.php">Marusthali (Colours of Rajasthan)</a></li>
            <li><a href="pure-cotton-silk.php">विשদाम्बर (Elegance of Sheerness)</a></li>
            <li><a href="pure-cotton.php">Tulavastram (Cotton)</a></li>
            <li><a href="pure-silk.php">Saunsparsh (Handcrafts)</a></li>
          </ul>
        </li>
        <li><a href="dress-material.php">Dress Material</a></li>
        <li><a href="ready-mades.php">Ready Mades</a></li>
        <li><a href="customizable.php">Customizable</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero Carousel Section -->
  <section id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/Front-page/Dress_Material_banner.png" class="d-block w-100" alt="Fashion Model 1">
      </div>
      <div class="carousel-item">
        <img src="images/Front-page/Home_banner.png" class="d-block w-100" alt="Fashion Model 2">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </section>

  <!-- NEW Attractive Product Cards Section -->
  <section class="prod-cat-section">
    <div class="container">
        <h2 class="prod-cat-heading">Shop Our Categories</h2>
        <div class="prod-cat-container">
            <!-- Card 1: New Arrivals -->
            <a href="new-arrival.php" class="prod-cat-link">
                <div class="prod-cat-card">
                    <div class="prod-cat-image" style="background-image: url('images/front-page/saree.png');"></div>
                    <div class="prod-cat-overlay">
                        <h3 class="prod-cat-title">New Arrivals</h3>
                    </div>
                </div>
            </a>
            <!-- Card 2: Dress Material -->
            <a href="dress-material.php" class="prod-cat-link">
                <div class="prod-cat-card">
                    <div class="prod-cat-image" style="background-image: url('images/front-page/dress_Material.png');"></div>
                    <div class="prod-cat-overlay">
                        <h3 class="prod-cat-title">Dress Material</h3>
                    </div>
                </div>
            </a>
            <!-- Card 3: Ready Mades -->
            <a href="ready-mades.php" class="prod-cat-link">
                <div class="prod-cat-card">
                    <div class="prod-cat-image" style="background-image: url('images/front-page/ready_mades.png');"></div>
                    <div class="prod-cat-overlay">
                        <h3 class="prod-cat-title">Ready Mades</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="about-us-section">
    <div class="about-us-container">
        <div class="about-us-image">
            <img src="https://images.pexels.com/photos/5868272/pexels-photo-5868272.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Handcrafted Sarees">
        </div>
        <div class="about-us-content">
            <h2>About Vayitree</h2>
            <p>Welcome to Vayitree, your destination for exquisite, handcrafted fashion. We believe in the beauty of simplicity and the elegance of tradition. Since our founding, we've crafted customized and unique pieces for homes and wardrobes across the country.</p>
            <p>Our commitment? Quality, innovation, and timeless style. With a team of skilled artisans and designers, we create pieces that are not just beautiful but also tell a story. Experience the perfect blend of high-class materials and cutting-edge craftsmanship. Your search for the finest apparel ends here!</p>
        </div>
    </div>
  </section>


  <!-- Testimonials Section -->
  <section class="testimonials">
    <h2 class="testimonial-heading">Customer Testimonials</h2>
    <div class="testimonial-grid">
      <div class="testimonial-card">
        <div>
          <p class="testimonial-text">"So beautiful & affordable sarees."</p>
          <p class="testimonial-author">- Sonali Bhansali</p>
        </div>
        <div class="testimonial-rating">
          <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
        </div>
      </div>
      <div class="testimonial-card">
        <div>
          <p class="testimonial-text">"Maheshwari Saree is so elegant. I found the color of the saree is the same as I ordered. Aesthetically a very, very nice saree."</p>
          <p class="testimonial-author">- Mrs Bobde</p>
        </div>
        <div class="testimonial-rating">
          <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
        </div>
      </div>
      <div class="testimonial-card">
        <div>
          <p class="testimonial-text">"When I first started purchasing sarees from Vayitree, I never went anywhere else. The sarees are very unique & too good."</p>
          <p class="testimonial-author">- Mrs Sarika</p>
        </div>
        <div class="testimonial-rating">
          <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span class="star-half">⭐</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <section class="footer">
    <?php include 'footer.php'; ?>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

