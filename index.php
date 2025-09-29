<?php
session_start();
require 'db.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Brussels Brewery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f7ede2; color: #2d2d2d; }
    header { background-color: #f7ede2; padding: 1rem 0; }
    .hero { padding: 4rem 0; }
    .hero h1 { font-size: 2.5rem; font-weight: 600; }
    .hero p { font-size: 1.1rem; margin-bottom: 2rem; }
    .dark-section { background-color: #1e1e1e; color: #eee; padding: 4rem 0; }
    .social-section { background-color: #5c4033; color: #fff; padding: 2rem 0; text-align: center; }
    .gallery img { width: 100%; height: 300px; object-fit: cover; }
    footer { background-color: #1e1e1e; color: #ccc; padding: 3rem 0; }
    footer a { color: #ccc; text-decoration: none; }
    footer a:hover { text-decoration: underline; }
  </style>
</head>
<body>

<header>
  <div class="container d-flex justify-content-between align-items-center">
    <h4 class="m-0">☕ Brussels Brewery</h4>
    <nav>
      <ul class="nav">
        <li class="nav-item"><a href="#" class="nav-link text-dark">Shop</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-dark">About</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-dark">Blog</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-dark">Locations</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-dark">Contact</a></li>
      </ul>
    </nav>

    <?php if (!isset($_SESSION['user'])): ?>
      <button class="btn btn-outline-dark btn-sm me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</button>
      <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
    <?php else: ?>
      <span class="me-2">Welcome, <?=htmlspecialchars($_SESSION['user'])?></span>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    <?php endif; ?>
  </div>
</header>


<section class="hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h1>Brewed To Perfection, Served With Love</h1>
        <p>Indulge in handcrafted coffee, freshly baked pastries, and a welcoming atmosphere designed to inspire and unwind.</p>
        <a href="#" class="btn btn-dark me-2">Order Online</a>
        <a href="#" class="btn btn-outline-dark">Find a Location</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="imgs\01.jpg" alt="Coffee Cup" class="img-fluid">
      </div>
    </div>
  </div>
</section>

<section class="dark-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="imgs\02.jpg" alt="" class="img-fluid rounded">
      </div>
      <div class="col-md-6">
        <h2>Handmade Just For You</h2>
        <p>Our organically grown coffee beans are roasted over an open flame in a one-of-a-kind, brick roaster. There’s nothing quite like a cup of Brussels Brewery coffee.</p>
        <a href="#" class="btn btn-outline-light">View our menu</a>
      </div>
    </div>
  </div>
</section>

<section class="dark-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 order-md-2 mb-4 mb-md-0">
        <img src="imgs\03.jpg" alt="" class="img-fluid rounded">
      </div>
      <div class="col-md-6 order-md-1">
        <h2>Made In Brussels</h2>
        <p>Welcome to Brussels Brewery, where the charm of Brussels meets the aroma of freshly brewed coffee. Our café is a cozy haven where friends gather, ideas spark, and every sip tells a story.</p>
        <p>Come and experience the soul of Brussels in every cup and bite—we can’t wait to welcome you!</p>
        <a href="#" class="btn btn-outline-light">Learn more</a>
      </div>
    </div>
  </div>
</section>

<div class="social-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">#Brusselscoffee @Brusselsbrewery</div>
      <div class="col-md-6">Follow Us on Facebook</div>
    </div>
  </div>
</div>

<section class="gallery">
  <div class="container-fluid">
    <div class="row g-0">
      <div class="col-6 col-md-3"><img src="imgs\04.jpg" alt=""></div>
      <div class="col-6 col-md-3"><img src="imgs\05.jpg" alt=""></div>
      <div class="col-6 col-md-3"><img src="imgs\06.jpg" alt=""></div>
      <div class="col-6 col-md-3"><img src="imgs\07.jpg" alt=""></div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-4">
        <h5>Brussels</h5>
        <p>Rue du Mi 45, 1000<br>Bruxelles, Belgium</p>
      </div>
      <div class="col-md-4">
        <h5>Anderlecht</h5>
        <p>Pl. De Linde 27, 1070<br>Anderlecht, Belgium</p>
      </div>
      <div class="col-md-4">
        <h5>Machelen</h5>
        <p>Dorpplein 3, 1830<br>Machelen, Belgium</p>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-md-6">
        <p class="mb-0">☕ Brussels Brewery — Brewed To Perfection, Served With Love</p>
      </div>
      <div class="col-md-6">
        <form action="subscribe.php" method="POST" class="d-flex">
          <input type="email" name="email" class="form-control me-2" placeholder="Enter Your Email" required>
          <button class="btn btn-outline-light">Subscribe</button>
        </form>
      </div>
    </div>
    <div class="mt-3 text-center">
      <small>©2025 Brussels Brewery. All Rights Reserved. | Privacy | Terms | Cookies</small>
    </div>
  </div>
</footer>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="register.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Create Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-dark">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="signin.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Sign In</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-dark">Sign In</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
