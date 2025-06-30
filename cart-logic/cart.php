<?php
session_start();

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if (!isset($item['quantity']) || $item['quantity'] <= 0 || 
            !isset($item['price']) || $item['price'] <= 0) {
            unset($_SESSION['cart'][$key]);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {

    if (!empty($_POST['remove'])) {
        foreach ($_POST['remove'] as $remove_id) {
            if (isset($_SESSION['cart'][$remove_id])) {
                unset($_SESSION['cart'][$remove_id]);
            }
        }
    }
    if (!empty($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $id => $qty) {
            $qty = (int)$qty;
            if (isset($_SESSION['cart'][$id])) {
                if ($qty <= 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    $_SESSION['cart'][$id]['quantity'] = $qty;
                }
            }
        }
    }

    header("Location: cart.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff8f6;
      margin: 0;
      padding: 20px;
      color: #444;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 6px 25px rgba(0,0,0,0.12);
    }

    h1 {
      text-align: center;
      color: #333;
      font-weight: 700;
      margin-bottom: 35px;
      font-size: 2.4rem;
      letter-spacing: 1px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
      font-size: 1rem;
    }

    thead tr {
      background-color: #f7f7f7;
      border-bottom: 2px solid #ddd;
    }

    th, td {
      padding: 14px 15px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    th {
      font-weight: 600;
      color: #555;
    }

    tbody tr:hover {
      background-color: #fffbf2;
    }

    input[type="number"] {
      width: 70px;
      padding: 8px 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      text-align: center;
      transition: border-color 0.3s ease;
    }
    input[type="number"]:focus {
      border-color: #ff6600;
      outline: none;
    }

    input[type="checkbox"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
    }

    .total-row td {
      font-weight: 700;
      font-size: 1.1rem;
      color: #ff6600;
    }

    button {
      display: block;
      width: 100%;
      background-color: #ff6600;
      color: white;
      padding: 16px;
      font-size: 1.3rem;
      font-weight: 700;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 15px;
      letter-spacing: 1px;
      box-shadow: 0 5px 15px rgba(255, 102, 0, 0.5);
    }
    button:hover {
      background-color: #e65c00;
    }

    /* Delivery form styles */
    h3 {
      margin-bottom: 18px;
      font-weight: 700;
      color: #333;
      border-bottom: 2px solid #ff6600;
      padding-bottom: 6px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #555;
      font-size: 1rem;
    }

    textarea, select, input[type="text"] {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 22px;
      border-radius: 10px;
      border: 1.5px solid #ccc;
      font-size: 1rem;
      font-family: inherit;
      transition: border-color 0.3s ease;
      resize: vertical;
    }
    textarea:focus, select:focus, input[type="text"]:focus {
      border-color: #ff6600;
      outline: none;
    }

    /* Credit card section */
    #creditCardFields {
      background-color: #fff5e6;
      padding: 20px 25px;
      border-radius: 12px;
      box-shadow: inset 0 0 10px rgba(255, 102, 0, 0.15);
      margin-bottom: 25px;
      display: none;
    }

    #creditCardFields h4 {
      margin-top: 0;
      margin-bottom: 15px;
      font-weight: 700;
      color: #ff6600;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .container {
        padding: 20px 15px;
      }

      input[type="number"] {
        width: 50px;
      }
    }

    /* Empty cart message */
    p.empty-cart {
      font-size: 1.2rem;
      color: #999;
      text-align: center;
      margin-top: 60px;
    }

    p.empty-cart a {
      color: #ff6600;
      text-decoration: none;
      font-weight: 600;
    }
    p.empty-cart a:hover {
      text-decoration: underline;
    }
  </style>

  <section class="container">
    <h1>Your Cart</h1>

    <?php if (empty($cart)): ?>
      <p class="empty-cart">Your cart is empty. <a href="../public/menu.php">Go to Menu</a></p>
    <?php else: ?>

      <form method="POST" action="cart.php" style="margin-bottom: 40px;">
        <table>
          <thead>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart as $id => $item):
              if (!isset($item['quantity']) || $item['quantity'] <= 0) continue;
              
              $subtotal = $item['price'] * $item['quantity'];
              $total += $subtotal;
            ?>
            <tr>
              <td><?php echo htmlspecialchars($item['item_name']); ?></td>
              <td>$<?php echo number_format($item['price'], 2); ?></td>
              <td>
                <input type="number" name="quantities[<?php echo $id; ?>]" 
                       value="<?php echo $item['quantity']; ?>" min="1" 
                       aria-label="Quantity of <?php echo htmlspecialchars($item['item_name']); ?>">
              </td>
              <td>$<?php echo number_format($subtotal, 2); ?></td>
              <td>
                <input type="checkbox" name="remove[]" value="<?php echo $id; ?>" 
                       aria-label="Remove <?php echo htmlspecialchars($item['item_name']); ?>">
              </td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
              <td colspan="3">Total</td>
              <td colspan="2">$<?php echo number_format($total, 2); ?></td>
            </tr>
          </tbody>
        </table>

        <button type="submit" name="update_cart">Update Cart</button>
      </form>

      <form method="POST" action="checkout.php" id="checkoutForm" novalidate>
        <h3>Delivery Information</h3>

        <label for="delivery_address">Address:</label>
        <textarea id="delivery_address" name="delivery_address" required aria-required="true"></textarea>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required aria-required="true">
          <option value="">-- Select Payment Method --</option>
          <option value="cash">Cash</option>
          <option value="credit">Credit Card</option>
        </select>

        <div id="creditCardFields" aria-live="polite" aria-hidden="true">
          <h4>Credit Card Information</h4>
          <label for="card_number">Card Number:</label>
          <input type="text" id="card_number" name="card_number" maxlength="16" placeholder="1234123412341234" />

          <label for="card_name">Cardholder Name:</label>
          <input type="text" id="card_name" name="card_name" placeholder="Name on card" />

          <label for="expiry_date">Expiry Date:</label>
          <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" />

          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" maxlength="4" placeholder="123" />
        </div>

        <button type="submit">Confirm Order</button>
      </form>

    <?php endif; ?>
  </section>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const paymentMethod = document.getElementById('payment_method');
    const creditCardFields = document.getElementById('creditCardFields');

    paymentMethod.addEventListener('change', function () {
      if (this.value === 'credit') {
        creditCardFields.style.display = 'block';
        creditCardFields.setAttribute('aria-hidden', 'false');
      } else {
        creditCardFields.style.display = 'none';
        creditCardFields.setAttribute('aria-hidden', 'true');
      }
    });
  });
</script>

</body>
</html>