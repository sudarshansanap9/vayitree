<!-- Footer -->
<footer class="site-footer">
  <style>
    .site-footer {
      background-color: #faf8f9;
      color: #333;
      padding: 30px 15px 15px;
      border-top: 1px solid #ded4d5;
      font-family: 'Poppins', sans-serif;
      position: relative;
    }

    .footer-container {
      max-width: 1200px;
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 20px;
    }

    .footer-section {
      flex: 1 1 250px;
    }

    .footer-section h3,
    .footer-section h4 {
      color: #a72b29;
      font-size: 18px;
      margin-bottom: 10px;
    }

    .footer-section p,
    .footer-section a {
      font-size: 14px;
      color: #555;
      text-decoration: none;
    }

    .footer-section ul {
      list-style: none;
      padding-left: 0;
      margin: 0;
    }

    .footer-section ul li {
      margin-bottom: 8px;
    }

    .footer-section ul li a:hover {
      color: #a72b29;
      text-decoration: underline;
    }

    .footer-socials {
      margin-top: 10px;
    }

    .footer-socials a {
      display: inline-block;
      margin-right: 10px;
      font-size: 16px;
      color: #a72b29;
      transition: color 0.3s;
    }

    .footer-socials a:hover {
      color: #c97c7c;
    }

    .footer-bottom {
      text-align: center;
      font-size: 13px;
      padding-top: 15px;
      color: #666;
      border-top: 1px solid #ded4d5;
      margin-top: 20px;
    }

    /* Sticky Action Buttons */
    .floating-buttons {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 999;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .floating-buttons a {
      width: 45px;
      height: 45px;
      background-color: #a72b29;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      font-size: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      transition: background 0.3s;
      text-decoration: none;
    }

    .floating-buttons a:hover {
      background-color: #c97c7c;
    }

    @media (max-width: 480px) {
      .floating-buttons a {
        width: 40px;
        height: 40px;
        font-size: 18px;
      }
    }

    @media (max-width: 768px) {
      .footer-container {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .footer-section {
        flex: 1 1 100%;
        margin-bottom: 15px;
      }

      .footer-socials a {
        margin: 0 8px;
      }
    }
  </style>

  <div class="footer-container">
    <!-- Column 1 -->
    <div class="footer-section">
      <h3>Vayitree</h3>
      <p>Elegance woven into every thread. Ethnic wear reimagined for the modern you.</p>
      <div class="footer-socials">
        <a href="https://facebook.com/profile.php?id=100063918199444" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://instagram.com/house_of_vayitree/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/+919767734369" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>

    <!-- Column 2 -->
    <div class="footer-section">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="sarees.html">Sarees</a></li>
        <li><a href="dress-material.html">Dress Material</a></li>
        <li><a href="ready-mades.html">Ready Mades</a></li>
        <li><a href="customizable.html">Customizable</a></li>
      </ul>
    </div>

    <!-- Column 3 -->
    <div class="footer-section">
      <h4>Contact</h4>
      <p><i class="fas fa-envelope"></i> contact@sareestore.com</p>
      <p><i class="fas fa-phone-alt"></i> +91-9767734369</p>
      <p><i class="fas fa-map-marker-alt"></i> Nashik, Maharashtra, India</p>
    </div>
  </div>

  <!-- Floating Buttons -->
  <div class="floating-buttons">
    <a href="tel:+919767734369" title="Call Us"><i class="fas fa-phone"></i></a>
    <a href="https://wa.me/+919767734369" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
  </div>

  <div class="footer-bottom">
    <p>&copy; <?php echo date("Y"); ?> Vayitree. All rights reserved.</p>
  </div>
</footer>
