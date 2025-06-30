<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
$cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Aldenaire Kitchen</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <div class="logo">
      <img src="../assets/images/logo.png" alt="Logo" />
    </div>
    <nav class="main-nav">
      <ul>
        <li><a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a></li>
        <li><a href="about.php" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
        <li><a href="menu.php" class="<?= $currentPage == 'menu.php' ? 'active' : '' ?>">Menu</a></li>
        <li><a href="reviews.php" class="<?= $currentPage == 'reviews.php' ? 'active' : '' ?>">Reviews</a></li>
        <li><a href="contact.php" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
        <li>
          <a href="../cart-logic/cart.php" id="myOrdersLink">My Orders 🛒 <span id="cart-count" style="background:orange; color:#fff; padding:2px 8px; border-radius:50%; font-size:0.8rem;">
          <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?>
          </span>
          </a>
        </li>
      </ul>
    </nav>
  </header>
</body>
</html>
