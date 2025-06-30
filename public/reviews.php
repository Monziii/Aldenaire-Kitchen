<?php 
session_start();
require '../view/header.php'; 
require '../includes/db.php'; 
?>

<style>
  *, *::before, *::after {
    box-sizing: border-box;
  }

  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background: #fff;
    color: #333;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .reviews-section {
    flex: 1;
    padding: 60px 20px;
    max-width: 800px;
    margin: 40px auto;
    background: #fff8f0;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(255, 165, 0, 0.2);
  }

  .reviews-section h1 {
    font-weight: 700;
    font-size: 2.8rem;
    margin-bottom: 30px;
    color: #FF8C00;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    text-align: center;
  }

  .reviews-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
  }

  .review-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border-left: 5px solid #FFA500;
    transition: transform 0.3s ease;
  }

  .review-card:hover {
    transform: translateY(-5px);
  }

  .review-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }

  .review-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #FFA500;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    margin-right: 15px;
  }

  .review-user {
    flex: 1;
  }

  .review-name {
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 3px;
    color: #333;
  }

  .review-date {
    font-size: 0.85rem;
    color: #888;
  }

  .review-rating {
    color: #FFA500;
    font-size: 1.2rem;
    font-weight: bold;
  }

  .review-content {
    line-height: 1.6;
    color: #555;
  }

  .add-review-section {
    margin-top: 50px;
    padding-top: 30px;
    border-top: 1px dashed #FFA500;
  }

  .add-review-section h2 {
    color: #FF8C00;
    margin-bottom: 20px;
    text-align: center;
  }

  .review-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .form-group {
    text-align: left;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #bf6200;
    font-size: 1.1rem;
  }

  .form-group input,
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #FFA500;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    resize: vertical;
    font-family: 'Arial', sans-serif;
  }

  .form-group input:focus,
  .form-group textarea:focus,
  .form-group select:focus {
    outline: none;
    border-color: #FF8C00;
    box-shadow: 0 0 8px rgba(255, 140, 0, 0.4);
  }

  .rating-select {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 5px;
}

.rating-row {
  display: flex;
  align-items: center;
  gap: 10px;
}

.rating-row select {
  width: 600px;
  padding: 5px;
  font-size: 0.9rem;
}

.rating-stars {
  font-size: 1.4rem;
  color: #FFA500;
}


  .submit-btn {
    background-color: #FFA500;
    color: white;
    padding: 16px 0;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1.2rem;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    box-shadow: 0 4px 12px rgba(255, 165, 0, 0.5);
    transition: background-color 0.3s ease, transform 0.3s ease;
  }

  .submit-btn:hover {
    background-color: #e69500;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(230, 149, 0, 0.7);
  }

  .policy-text {
    margin-top: 25px;
    font-size: 0.9rem;
    color: #666;
    font-style: italic;
    text-align: center;
  }

  @media (max-width: 768px) {
    .reviews-section {
      margin: 20px 15px;
      padding: 40px 15px;
    }

    .reviews-section h1 {
      font-size: 2rem;
    }

    .review-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .review-avatar {
      margin-bottom: 10px;
    }

    .submit-btn {
      font-size: 1rem;
      padding: 14px 0;
    }
  }
</style>

<section class="reviews-section">
  <h1>Customer Reviews</h1>
  
  <div class="reviews-container">
    <?php
  
    $query = "SELECT r.*, COALESCE(u.username, r.name, 'Guest') AS username, 
                     COALESCE(m.item_name, 'General Review') AS item_name
              FROM reviews r
              LEFT JOIN users u ON r.user_id = u.user_id
              LEFT JOIN menu_items m ON r.item_id = m.item_id
              ORDER BY r.review_date DESC";

    $stmt = $conn->query($query);
    $reviews = $stmt->fetchAll();

    if (count($reviews) > 0) {
      foreach ($reviews as $row) {
        $username = $row['username'] ?? 'Anonymous';
        $item_name = $row['item_name'] ?? 'Our Restaurant';
        $initials = getInitials($username);
        $rating = (int)$row['rating'];
        $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
        $review_date = date('F j, Y', strtotime($row['review_date']));
    ?>
    <div class="review-card">
      <div class="review-header">
        <div class="review-avatar"><?= $initials ?></div>
        <div class="review-user">
          <div class="review-name"><?= htmlspecialchars($username) ?></div>
          <div class="review-date"><?= $review_date ?> - <?= htmlspecialchars($item_name) ?></div>
        </div>
        <div class="review-rating"><?= $stars ?></div>
      </div>
      <div class="review-content">
        <p><?= nl2br(htmlspecialchars($row['comment'])) ?></p>
      </div>
    </div>
    <?php
      }
    } else {
      echo '<p style="text-align: center; font-style: italic;">No reviews yet. Be the first to review!</p>';
    }
    
    function getInitials($name) {
      $names = explode(' ', $name);
      $initials = '';
      foreach($names as $n) {
        $initials .= strtoupper(substr($n, 0, 1));
      }
      return substr($initials, 0, 2);
    }
    ?>
  </div>
  
  <div class="add-review-section">
    <h2>Share Your Experience</h2>
    <form class="review-form" method="post" action="../includes/handle_review.php">
      <?php if(isset($_SESSION['user_id'])): ?>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
      <?php else: ?>
        <div class="form-group">
          <label for="review-name">Your Name</label>
          <input type="text" id="review-name" name="name" placeholder="Enter your name" required>
        </div>
      <?php endif; ?>
      
      <div class="form-group">
        <label for="review-item">Menu Item</label>
        <select id="review-item" name="item_id">
          <option value="">General Restaurant Review</option>
          <?php
          $items_stmt = $conn->query("SELECT item_id, item_name FROM menu_items");
          $items = $items_stmt->fetchAll();
          foreach($items as $item) {
            echo '<option value="'.$item['item_id'].'">'.htmlspecialchars($item['item_name']).'</option>';
          }
          ?>
        </select>
      </div>
      
     <div class="form-group rating-select">
  <label for="review-rating">Rating</label>
  <div class="rating-row">
    <select id="review-rating" name="rating" required>
      <option value="">Select rating</option>
      <option value="5">★★★★★ - Excellent</option>
      <option value="4">★★★★☆ - Very Good</option>
      <option value="3">★★★☆☆ - Good</option>
      <option value="2">★★☆☆☆ - Fair</option>
      <option value="1">★☆☆☆☆ - Poor</option>
    </select>
    <div class="rating-stars">★★★★★</div>
  </div>
</div>


      <div class="form-group">
        <label for="review-comment">Your Review</label>
        <textarea id="review-comment" name="comment" rows="5" placeholder="Share your experience with us..." required></textarea>
      </div>
      
      <button type="submit" class="submit-btn">Submit Review</button>
      
      <p class="policy-text">Your review will be published after moderation. By submitting, you agree to our Review Guidelines.</p>
    </form>
  </div>
</section>

<?php require '../view/footer.php'; ?>
