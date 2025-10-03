<?php
// header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vayitree Handcrafted Simplicity</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Playfair+Display&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">

  <link rel="icon" href="images/logo.png" type="image/x-icon">
</head>
<body>

<div class="top-header bg-light py-2">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="contact-info">
      <a href="mailto:houseofvayitree@gmail.com" class="me-3"><i class="fa fa-envelope"></i> houseofvayitree@gmail.com</a>
      <a href="tel:+919767734369"><i class="fa fa-phone"></i> +91-9767734369</a>
    </div>
    <div class="social-icons">
      <a href="https://facebook.com/profile.php?id=100063918199444" target="_blank" class="me-2"><i class="fab fa-facebook"></i></a>
      <a href="https://instagram.com/house_of_vayitree/" target="_blank" class="me-2"><i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/+919767734369" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
      <img src="images/logo.png" alt="Vayitree Logo" width="120" height="41" class="me-2">
      
    </a>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link px-3" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="new-arrival.php">New Arrivals</a>
        </li>
        <!-- <li class="nav-item dropdown">
            
          <a class="nav-link dropdown-toggle px-3" href="#" id="sareesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sarees <i class="fas fa-chevron-down ms-1" style="font-size: 0.7em;"></i>
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3 p-2" aria-labelledby="sareesDropdown">
            <li><a class="dropdown-item rounded-2" href="pure-cotton.php">Dakshinayann</a></li>
            <li><a class="dropdown-item rounded-2" href="pure-silk.php">Parampara</a></li>
            <li><a class="dropdown-item rounded-2" href="pure-cotton-silk.php">Garima</a></li>
            <li><a class="dropdown-item rounded-2" href="kausheya.php">Kausheya</a></li>
            <li><a class="dropdown-item rounded-2" href="marusthali.php">Marusthali</a></li>
            <li><a class="dropdown-item rounded-2" href="vishadambar.php">विशदाम्बर</a></li>
            <li><a class="dropdown-item rounded-2" href="tulavastram.php">Tulavastram</a></li>
            <li><a class="dropdown-item rounded-2" href="saunsparsh.php">Saunsparsh</a></li>
          </ul>
        </li> -->
        <li class="nav-item">
          <a class="nav-link px-3" href="sarees.php">Sarees</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="dress-material.php">Dress Material</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="ready-mades.php">Ready Mades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="customizable.php">Customizable</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="contact.php">Contact Us</a>
        </li>
      </ul>
    </div>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<style>
.navbar .nav-link {
  font-weight: 500;
  color: #333 !important;
  transition: all 0.3s ease;
}
.navbar .nav-link:hover {
  color: #a52a2a !important;
}
.dropdown-menu {
  min-width: 250px;
  border-radius: 10px;
}
.dropdown-menu .dropdown-item {
  font-size: 15px;
  padding: 10px 15px;
}
.dropdown-menu .dropdown-item:hover {
  background: #f7f1f1;
  color: #a52a2a !important;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Enable hover for desktop
  if (window.innerWidth > 992) {
    document.querySelectorAll('.navbar .nav-item.dropdown').forEach(function (dropdown) {
      dropdown.addEventListener('mouseenter', function () {
        const menu = this.querySelector('.dropdown-menu');
        if (menu) {
          new bootstrap.Dropdown(this.querySelector('[data-bs-toggle="dropdown"]')).show();
        }
      });
      dropdown.addEventListener('mouseleave', function () {
        const menu = this.querySelector('.dropdown-menu');
        if (menu) {
          new bootstrap.Dropdown(this.querySelector('[data-bs-toggle="dropdown"]')).hide();
        }
      });
    });
  }

  // Auto close dropdown on mobile after click
  document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
    element.addEventListener('click', function () {
      const navbar = document.querySelector('.navbar-collapse');
      if (navbar.classList.contains('show')) {
        new bootstrap.Collapse(navbar).toggle();
      }
    });
  });
});
</script>