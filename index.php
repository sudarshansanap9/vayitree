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
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Playfair+Display&display=swap" rel="stylesheet">

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
            <li><a href="pure-cotton-silk.php">विशदाम्बर (Elegance of Sheerness)</a></li>
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

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-container">
      <div class="hero-text">
        <h1>Elevate your <span>Style!</span></h1>
        <p>Shop the latest trends in ethnic fashion</p>
        <a href="sarees.php" class="btn">Shop Sarees</a>
      </div>
      <div class="hero-image">
        <img src="images/model.jpeg" alt="Fashion Model">
      </div>
    </div>
  </section>

  <!-- Sarees Section (Dynamic) -->
  <section class="saree-section">
    <h2>Latest Sarees</h2>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $sql = "SELECT * FROM sarees";
        if ($search !== '') {
            $safe = $conn->real_escape_string($search);
            $sql .= " WHERE name LIKE '%$safe%'";
        }
        $sql .= " ORDER BY id DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
        ?>
          <div class="col">
            <div class="saree-card">
              <img src="images/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
              <span class="badge"><?= $row['stock'] > 0 ? 'In Stock' : 'Sold Out' ?></span>
              <h3><?= $row['name'] ?></h3>
              <div class="price">₹<?= $row['price'] ?></div>
              <div class="stars">★★★★★</div>
            </div>
          </div>
        <?php
          endwhile;
        else:
        ?>
          <p style="text-align:center;">No sarees found for "<strong><?= htmlspecialchars($search) ?></strong>".</p>
        <?php endif; ?>
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
