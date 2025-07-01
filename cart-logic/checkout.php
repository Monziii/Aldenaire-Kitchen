<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

if (empty($_SESSION['cart'])) {
    die("Your cart is empty.");
}

$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    if (!isset($item['price'], $item['quantity']) || $item['quantity'] <= 0) {
        die("Invalid cart item detected.");
    }
    $total_price += $item['price'] * $item['quantity'];
}

$delivery_address = trim($_POST['delivery_address'] ?? '');
$payment_method = $_POST['payment_method'] ?? '';

if ($delivery_address === '') {
    die("Delivery address is required.");
}

if (!in_array($payment_method, ['cash', 'credit'])) {
    die("Valid payment method is required.");
}

$card_data = [
    'card_number' => trim($_POST['card_number'] ?? ''),
    'card_name' => trim($_POST['card_name'] ?? ''),
    'expiry_date' => trim($_POST['expiry_date'] ?? ''),
    'cvv' => trim($_POST['cvv'] ?? ''),
];

if ($payment_method === 'credit') {
    if ($card_data['card_number'] === '' || $card_data['card_name'] === '' || $card_data['expiry_date'] === '' || $card_data['cvv'] === '') {
        die("All credit card details are required.");
    }
}

try {
    $conn->beginTransaction();

    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, delivery_address, payment_method, status) 
                           VALUES (?, ?, ?, ?, 'pending')");
    if (!$stmt->execute([$_SESSION['user_id'] ?? 1, $total_price, $delivery_address, $payment_method])) {
        throw new Exception("Failed to create order record");
    }
    $order_id = $conn->lastInsertId();

    $stmt = $conn->prepare("INSERT INTO order_details (order_id, item_id, quantity, unit_price) 
                           VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        if (!$stmt->execute([$order_id, $item['item_id'], $item['quantity'], $item['price']])) {
            throw new Exception("Failed to add item {$item['item_id']} to order");
        }
    }

    if ($payment_method === 'credit') {
        $stmt = $conn->prepare("INSERT INTO payment_details (order_id, card_number, card_name, expiry_date, cvv) 
                               VALUES (?, ?, ?, ?, ?)");
        if (!$stmt->execute([
            $order_id, 
            $card_data['card_number'],
            $card_data['card_name'],
            $card_data['expiry_date'],
            $card_data['cvv']
        ])) {
            throw new Exception("Failed to save payment details");
        }
    }

    $conn->commit();

    unset($_SESSION['cart']);

    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Order Success</title>
      <style>
        body {
             background: #f7f9fc;
             font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
             display: flex;
             justify-content: center;
             align-items: flex-start; 
             padding-top: 60px;       
             height: 100vh;
             margin: 0;
             }
        .success-container {
          background: white;
          padding: 40px 60px;
          border-radius: 15px;
          box-shadow: 0 8px 30px rgba(0,0,0,0.12);
          text-align: center;
          max-width: 400px;
          width: 90%;
        }
        .success-container h2 {
          color: #28a745;
          font-size: 2.5rem;
          margin-bottom: 20px;
        }
        .success-container p {
          font-size: 1.1rem;
          color: #555;
          margin-bottom: 30px;
        }
        .btn-home {
          background-color: #ff6600;
          color: white;
          border: none;
          padding: 14px 32px;
          font-size: 1.1rem;
          border-radius: 8px;
          cursor: pointer;
          text-decoration: none;
          display: inline-block;
          transition: background-color 0.3s ease;
        }
        .btn-home:hover {
          background-color: #ff6600;
        }
      </style>
    </head>
    <body>
      <div class="success-container" role="alert" aria-live="polite">
        <h2>✅ Order placed successfully!</h2>
        <p>Thank you for your purchase. Your order is being processed.</p>
        <a href="../index.php" class="btn-home" role="button">Return to Home</a>
      </div>
    </body>
    </html>
    ';

} catch (Exception $e) {
    $conn->rollBack();

    error_log("Order Processing Error: " . $e->getMessage());

    echo "<div style='text-align:center; padding:40px; max-width:800px; margin:0 auto;'>
            <h2 style='color:red;'>❌ Order Processing Failed</h2>
            <p style='font-size:1.1rem;'>We encountered an error while processing your order:</p>
            <div style='background:#fff5f5; padding:15px; margin:15px 0; border-radius:5px; text-align:left;'>
                <p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
            </div>
            <p style='font-size:1.1rem;'>Please try again or contact support with this information.</p>
            <div style='margin-top:20px;'>
                <a href='cart.php' style='display:inline-block; padding:10px 20px; background:#ff6600; color:white; text-decoration:none; border-radius:5px; margin-right:10px;'>Return to Cart</a>
                <a href='mailto:support@yourdomain.com' style='display:inline-block; padding:10px 20px; background:#333; color:white; text-decoration:none; border-radius:5px;'>Contact Support</a>
            </div>
          </div>";
}
?>
