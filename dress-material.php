<?php
include __DIR__ . '/inc/config.php';
include 'header.php';

$table = 'dress_material'; // 👈 DB Table name
$page_title = "Dress Material";

// Fetch products
$result = $conn->query("SELECT * FROM $table ORDER BY id DESC");
$products = [];
while($row = $result->fetch_assoc()){
    $row['gallery'] = !empty($row['gallery']) ? json_decode($row['gallery'], true) : [];
    $products[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vayitree - <?= $page_title ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/style.css">
<style>
/* Section Titles */

.section-title {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 700;
    text-align: center;
    margin: 50px 0 30px;
    background: linear-gradient(90deg, #d81b60, #3949ab);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
}
.section-title::after {
    content: "";
    display: block;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, #d81b60, #3949ab);
    margin: 10px auto 0;
    border-radius: 2px;
}

/* Hero Section */
.hero-section h1 { font-family: 'Playfair Display', serif; font-weight: 700; }
.zoom-container { overflow: hidden; border-radius: 12px; }
.zoom-effect { transition: transform 0.5s ease; cursor: zoom-in; }
.zoom-effect:hover { transform: scale(1.05); cursor: zoom-out; }

/* --- NEW & IMPROVED PRODUCT CARD STYLES --- */

.product-card {
    display: flex; /* Key Change: Use Flexbox for layout */
    flex-direction: column; /* Stack image and body vertically */
    height: 100%; /* Ensure card fills the column height */
    border: 1px solid #eee;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: #fff;
    overflow: hidden; /* Important for border-radius on images */
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.1);
}

.product-image {
    position: relative; /* For the badge */
    overflow: hidden; /* For the image zoom effect */
}

.product-card img {
    width: 100%;
    aspect-ratio: 1 / 1; /* Creates a perfect square image box */
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover img {
    transform: scale(1.08); /* A nice zoom on hover */
}

.card-body {
    display: flex; /* Key Change: Use Flexbox for internal layout */
    flex-direction: column; /* Stack content vertically */
    flex-grow: 1; /* Allows body to expand, making cards equal height */
    padding: 1rem 1.25rem;
    text-align: left; /* Changed from center for a cleaner look */
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.card-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: rgb(128, 0, 0);
    margin-bottom: 0.5rem;
}

.stars {
    color: #ffa500;
    font-size: 14px;
    margin-bottom: 1rem;
}

.card-footer-action {
    margin-top: auto; /* Pushes this block to the bottom */
    padding-top: 1rem; /* Space above the button */
    border-top: 1px solid #f0f0f0; /* Subtle separator */
}

.btn-primary {
    width: 100%; /* Make button full-width */
    background-color: rgb(165, 42, 42);
    border-color: rgb(165, 42, 42);
    transition: background-color 0.2s, color 0.2s;
    font-weight: 600;
    padding: 0.6rem;
}
.btn-primary:hover {
    background-color: #fff;
    color: rgb(165, 42, 42);
    border-color: rgb(165, 42, 42);
}

.badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #28a745; /* Green for "In Stock" */
    color: #fff;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 50px;
    font-weight: bold;
    text-transform: uppercase;
}

/* Modal styles */
.modal-lg { max-width: 900px; }
#productModal .modal-content { border-radius: 12px; }
#productImageCarousel img { max-height: 500px; object-fit: contain; }
.modal-thumbs { display: flex; gap: 10px; justify-content: center; flex-wrap: nowrap; overflow-x: auto; }
.modal-thumbs img {
    width: 80px; height: 80px; object-fit: cover;
    border: 2px solid transparent; border-radius: 8px;
    cursor: pointer;
}
.modal-thumbs img.active { border-color: #3949ab; }

.navbar .nav-link {
    display: flex;
    align-items: center;
    height: 100%;
}
.navbar .dropdown-toggle::after {
    display: none !important;
}

</style>
</head>
<body>

<section class="hero-section py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 order-md-2 text-center zoom-container">
        <div class="zoom-effect">
          <img src="images/model.jpeg" class="img-fluid rounded" alt="Fashion Model">
        </div>
      </div>
      <div class="col-md-6 order-md-1">
        <h1>Explore Our <span><?= $page_title ?></span></h1>
        <p>Fresh ethnic trends curated just for you.</p>
        <a href="customizable.php" class="btn btn-primary">Shop Now</a>
      </div>
    </div>
  </div>
</section>

<h2 class="section-title">💖 <?= $page_title ?></h2>
<div class="container">
  <div class="row g-4"> <?php if(count($products) > 0): ?>
      <?php foreach($products as $p):
        $gallery_json = htmlspecialchars(json_encode($p['gallery']), ENT_QUOTES, 'UTF-8');
      ?>
      <div class="col-lg-3 col-md-6 col-12"> <div class="product-card" 
             data-id="<?= $p['id'] ?>"
             data-name="<?= htmlspecialchars($p['name']) ?>"
             data-price="<?= $p['price'] ?>"
             data-gallery='<?= $gallery_json ?>'
             data-image="<?= $p['main_image'] ?>">

            <div class="product-image">
                <img src="<?= 'uploads/' . htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                <span class="badge">In Stock</span>
            </div>
            
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
                <p class="card-price">₹<?= number_format($p['price']) ?></p>
                <div class="stars">★★★★★</div>
                
                <div class="card-footer-action">
                    <button class="btn btn-primary quick-view-btn">View Details</button>
                </div>
            </div>
            
        </div>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center">No products found in this category.</p>
    <?php endif; ?>
  </div>
</div>

<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" id="modal-carousel-inner"></div>
          <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
        <div id="modalThumbs" class="modal-thumbs mt-3"></div>

        <a href="https://docs.google.com/forms/d/e/1FAIpQLSdEkvm6pU_6FmLkIkva5a608p4xJAWpuu7SwXaNIqbVRUar3g/viewform?usp=sharing&ouid=111185153019778635477 " id="payNowBtn" class="btn btn-primary mt-4">Pay Now</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Modal setup
const productModal = new bootstrap.Modal(document.getElementById('productModal'));
const modalTitle = document.getElementById('modalTitle');
const modalCarouselInner = document.getElementById('modal-carousel-inner');
const modalThumbs = document.getElementById('modalThumbs');
const payNowBtn = document.getElementById('payNowBtn');

document.querySelectorAll('.quick-view-btn').forEach(button => {
  button.addEventListener('click', () => {
    const card = button.closest('.product-card');
    const productId = card.dataset.id;
    const productName = card.dataset.name;
    const productPrice = card.dataset.price;

    modalTitle.textContent = productName + " - ₹" + new Intl.NumberFormat('en-IN').format(productPrice);
    const gallery = JSON.parse(card.dataset.gallery || '[]');
    const mainImage = card.dataset.image;
    const allImages = [mainImage, ...gallery.filter(img => img !== mainImage)];

    modalCarouselInner.innerHTML = '';
    modalThumbs.innerHTML = '';

    allImages.forEach((src, index) => {
      const item = document.createElement('div');
      item.classList.add('carousel-item');
      if (index === 0) item.classList.add('active');
      item.innerHTML = `<img src="uploads/${src}" class="d-block w-100 zoomable" alt="Product Image">`;
      modalCarouselInner.appendChild(item);

      const thumb = document.createElement('img');
      thumb.src = `uploads/${src}`;
      thumb.setAttribute('data-bs-target', '#productImageCarousel');
      thumb.setAttribute('data-bs-slide-to', index);
      if (index === 0) thumb.classList.add('active');
      modalThumbs.appendChild(thumb);
    });

    // Set Pay Now button link (using product id for reliability)
    // payNowBtn.href = "payment.php?id=" + encodeURIComponent(productId);

    productModal.show();
  });
});
</script>

<?php include 'footer.php'; ?>

</body>
</html>