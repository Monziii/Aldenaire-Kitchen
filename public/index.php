<?php
require '../includes/db.php';
require '../view/header.php';

$searchQuery = '';
$menu_items = [];

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $searchQuery = trim($_GET['search']);
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_name LIKE ? AND item_id IN (1,2,3,4,5,6,7,8,9,10,11,12)");
    $stmt->execute(["%$searchQuery%"]);
    $menu_items = $stmt->fetchAll();
} else {
    $stmt = $conn->query("SELECT * FROM menu_items WHERE item_id IN (1,2,3,4,5,6,7,8,9,10,11,12,13)");
    $menu_items = $stmt->fetchAll();
}
?>

<section class="hero">
  <div class="hero-text">
    <h2>Discover Food Taste<br>Our <span class="highlight">Best</span> Healthy & Tasty.</h2>
    <p>Our restaurant offers a wide range of healthy, flavourful dishes crafted from the freshest ingredients. We focus on providing nutritious meals that cater to various dietary preferences, ensuring every guest enjoys a delicious, guilt-free experience.</p>
    <div class="action-buttons">
      <button class="view-menu" onclick="location.href='menu.php'">View Menu</button>

      <form method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($searchQuery) ?>">
        <button type="submit">Search</button>
      </form>
    </div>
  </div>
  <div class="hero-image">
    <img src="../assets/images/3.png" alt="Salad Image">
  </div>
</section>

<section class="popular-menu">
  <h3><?= empty($searchQuery) ? 'Our Popular Menu' : 'Search Results' ?></h3>

  <?php if(!empty($searchQuery)): ?>
    <p>Showing results for: "<?= htmlspecialchars($searchQuery) ?>"</p>
  <?php endif; ?>

  <div class="menu-nav">
    <button class="left-arrow">&#8592;</button>
    <button class="right-arrow" onclick="location.href='menu.php'">&#8594;</button>
  </div>
  <br>

  <div class="menu-items">
    <?php if(empty($menu_items)): ?>
      <p>No items found matching your search.</p>
    <?php else: ?>
      <?php foreach($menu_items as $item): ?>
        <div class="menu-card">
          <img src="../assets/images/<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>">
          <h4><?= htmlspecialchars($item['item_name']) ?></h4>
          <div class="stars">
            <?php 
              $stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM reviews WHERE item_id = ?");
              $stmt->execute([$item['item_id']]);
              $rating = $stmt->fetch()['avg_rating'];
              $roundedRating = $rating ? round($rating) : 4;
            ?>
            <?= str_repeat('⭐', $roundedRating) ?>
            <?= str_repeat('☆', 5 - $roundedRating) ?>
          </div>
          <p>$<?= htmlspecialchars($item['price']) ?></p>
          <button class="add-to-cart-button" data-item-id="<?= $item['item_id'] ?>">Add To Cart</button>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<div id="toast" class="toast"></div>

<style>
  .toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #333;
    color: #fff;
    padding: 14px 22px;
    border-radius: 8px;
    opacity: 0;
    pointer-events: none;
    font-size: 1rem;
    transition: opacity 0.5s ease, transform 0.5s ease;
    z-index: 9999;
    transform: translateY(20px);
  }
  .toast.show {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.add-to-cart-button').forEach(button => {
    button.addEventListener('click', function(event) {
      event.preventDefault();

      if (this.disabled) return;

      const itemId = this.getAttribute('data-item-id');

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
        .catch(err => {
          alert('Error adding item. Please try again.');
          this.disabled = false;
          this.classList.remove('added');
          this.textContent = 'Add To Cart';
        });
    });
  });
});

function updateCartCount(count) {
  const cartCountElem = document.getElementById('cart-count');
  if (cartCountElem) {
    cartCountElem.textContent = count;
    cartCountElem.style.transform = 'scale(1.3)';
    setTimeout(() => {
      cartCountElem.style.transform = 'scale(1)';
    }, 300);
  }
}

function showToast(message = 'Item added to cart!') {
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

<?php
require '../view/footer.php';
?>
