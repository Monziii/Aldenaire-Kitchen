<?php
require '../includes/db.php'; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$query = "SELECT item_id, item_name, description, price, image_path FROM menu_items";
$stmt = $conn->query($query);  // PDO statement
$menu_items = $stmt->fetchAll();
?>

<?php require '../view/header.php'; ?>

<section class="menu-section">
  <h1>Our Menu</h1>

  <?php if (count($menu_items) > 0): ?>
    <div class="menu-container">
      <?php foreach ($menu_items as $row): ?>
        <div class="menu-card">
          <img src="../assets/images/<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['item_name']); ?>">
          <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
          <p><?php echo htmlspecialchars($row['description']); ?></p>
          <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
          <button class="add-to-cart-button" data-item-id="<?= $row['item_id'] ?>">Add To Cart</button>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>No menu items found.</p>
  <?php endif; ?>

</section>

<script>
document.addEventListener('DOMContentLoaded', () => {

  document.querySelectorAll('.add-to-cart-button').forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();

      if (this.disabled || this.classList.contains('processing')) return;

      const itemId = this.getAttribute('data-item-id');

      this.classList.add('processing');
      this.disabled = true;
      this.classList.add('added');
      this.textContent = 'Item Added';

      fetch(`../cart-logic/add_to_cart.php?item_id=${itemId}`)
        .then(response => {
          if (!response.ok) throw new Error('Failed to add item');
          return response.text();
        })
        .then(cartCount => {
          updateCartCount(cartCount);
          showToast('✅ Item added to cart!');
        })
        .catch(() => {
          showToast('❌ Error adding item. Please try again.');
          this.disabled = false;
          this.classList.remove('added');
          this.textContent = 'Add To Cart';
        })
        .finally(() => {
          this.classList.remove('processing');
        });
    });
  });

  const menuIcon = document.querySelector('.menu-icon');
  const mobileNav = document.querySelector('.mobile-nav');

  if (menuIcon && mobileNav) {
    menuIcon.addEventListener('click', () => {
      mobileNav.classList.toggle('active');
    });
  }
});

function updateCartCount(count) {
  const allCounters = document.querySelectorAll('#cart-count');

  allCounters.forEach(counter => {
    counter.textContent = count;
    counter.style.transform = 'scale(1.3)';
    setTimeout(() => {
      counter.style.transform = 'scale(1)';
    }, 300);
  });
}

function showToast(message) {
  let toast = document.getElementById('toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toast';
    toast.className = 'toast';
    document.body.appendChild(toast);

    const style = document.createElement('style');
    style.textContent = `
      .toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #333;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.5s ease, transform 0.5s ease;
        transform: translateY(20px);
        z-index: 10000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        font-size: 15px;
      }
      .toast.show {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0);
      }
    `;
    document.head.appendChild(style);
  }

  toast.textContent = message;
  toast.classList.add('show');

  setTimeout(() => {
    toast.classList.remove('show');
  }, 2500);
}
</script>

<?php require '../view/footer.php'; ?>
