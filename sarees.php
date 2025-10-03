
<?php
include __DIR__ . '/inc/config.php';
include 'header.php';

$table = 'sarees';
$page_title = "Sarees";

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
.hero-section h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
}
.zoom-container { overflow: hidden; border-radius: 12px; }
.zoom-effect { transition: transform 0.5s ease; cursor: zoom-in; }
.zoom-effect:hover { transform: scale(1.05); cursor: zoom-out; }

/* Product Card */
.product-card {
    border-radius: 12px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    transition: transform 0.3s, box-shadow 0.3s;
    background: #fff;
    margin-bottom: 30px;
    overflow: hidden;
    height: 100%;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.product-card img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    transition: transform 0.4s;
}
.product-card:hover img { transform: scale(1.05); }
.card-body { text-align: center; padding: 1rem; }
.card-title { font-size: 1.05rem; font-weight: 600; min-height: 48px; }
.card-text.fw-bold { font-size: 1.2rem; color: rgb(128, 0, 0); margin: 0.5rem 0; }
.stars { color: #ffa500; font-size: 14px; }

/* Badge */
.badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgb(165, 42, 42);
    color: #fff;
    font-size: 12px;
    padding: 5px 8px;
    border-radius: 3px;
    font-weight: bold;
    text-transform: uppercase;
}

/* Modal */
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

/* Buttons */
.btn-primary {
    background-color: rgb(165, 42, 42);
    border-color: rgb(165, 42, 42);
}
.btn-primary:hover {
    background-color: #fff;
    color: rgb(165, 42, 42);
    border-color: rgb(165, 42, 42);
}
.navbar .nav-link {
  display: flex;
  align-items: center;
  height: 100%;
}

.navbar .dropdown-toggle::after {
  margin-left: 6px; /* spacing for caret */
  vertical-align: middle; /* keeps arrow inline */
  position: relative;
  top: -1px; /* adjust if still slightly low */
}
.navbar .dropdown-toggle::after {
  display: none !important;
}

</style>
</head>
<body>

<!-- HERO SECTION -->
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

<!-- PRODUCT SECTION -->
<h2 class="section-title">💖 <?= $page_title ?></h2>
<div class="container">
  <div class="row">
    <?php if(count($products) > 0): ?>
      <?php foreach($products as $p):
        $gallery_json = htmlspecialchars(json_encode($p['gallery']), ENT_QUOTES, 'UTF-8');
      ?>
      <div class="col-lg-3 col-md-6 col-12">
        <div class="product-card position-relative"
          data-id="<?= $p['id'] ?>"
          data-name="<?= htmlspecialchars($p['name']) ?>"
          data-price="<?= $p['price'] ?>"
          data-gallery='<?= $gallery_json ?>'
          data-image="<?= $p['main_image'] ?>">
          <img src="<?= 'uploads/' . htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
            <p class="fw-bold">₹<?= number_format($p['price']) ?></p>
            <button class="btn btn-primary mt-2 quick-view-btn">View Details</button>
            <span class="badge">In Stock</span>
            <div class="stars">★★★★★</div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center">No products found in this category.</p>
    <?php endif; ?>
  </div>
</div>

<!-- MODAL -->
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

        <!-- ✅ Pay Now Button -->
        <a href="#" id="payNowBtn" class="btn btn-primary mt-4">Pay Now</a>
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

    modalTitle.textContent = productName + " - ₹" + productPrice;
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

    // ✅ Set Pay Now button link (using product id for reliability)
    payNowBtn.href = "payment.php?id=" + encodeURIComponent(productId);

    productModal.show();
  });
});
</script>

<?php include 'footer.php'; ?>
