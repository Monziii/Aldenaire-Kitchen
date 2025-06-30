<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/db.php';  

if (!isset($_GET['item_id'])) {
    die("Item not found.");
}

$item_id = (int)$_GET['item_id'];

$stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_id = ?");
$stmt->execute([$item_id]);
$item = $stmt->fetch();

if (!$item) {
    die("Item does not exist.");
}

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = (int)($_POST['quantity'] ?? 0);
    $delivery_address = trim($_POST['delivery_address'] ?? '');
    $payment_method = trim($_POST['payment_method'] ?? '');

    if ($quantity <= 0) {
        die("Invalid quantity.");
    }
    if (empty($delivery_address)) {
        die("Delivery address is required.");
    }
    if (!in_array($payment_method, ['cash', 'credit'])) {
        die("Invalid payment method.");
    }

    // Additional validation for credit card
    if ($payment_method === 'credit') {
        $card_number = trim($_POST['card_number'] ?? '');
        $card_name = trim($_POST['card_name'] ?? '');
        $expiry_date = trim($_POST['expiry_date'] ?? '');
        $cvv = trim($_POST['cvv'] ?? '');

        if (empty($card_number) || empty($card_name) || empty($expiry_date) || empty($cvv)) {
            die("All credit card fields are required.");
        }
        
        // Basic credit card validation
        if (!preg_match('/^\d{16}$/', $card_number)) {
            die("Invalid card number. Must be 16 digits.");
        }
        if (!preg_match('/^\d{3,4}$/', $cvv)) {
            die("Invalid CVV. Must be 3 or 4 digits.");
        }
    }

    $user_id = 1; 
    $total_price = $item['price'] * $quantity;

    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, delivery_address, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $total_price, $delivery_address, $payment_method]);
        $order_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO order_details (order_id, item_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item_id, $quantity, $item['price']]);

        // If credit card, store the payment details (you should encrypt these in production)
        if ($payment_method === 'credit') {
            $stmt = $conn->prepare("INSERT INTO payment_details (order_id, card_number, card_name, expiry_date, cvv) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$order_id, $card_number, $card_name, $expiry_date, $cvv]);
        }

        $conn->commit();

        $successMessage = "✅ Your order has been placed successfully! Thank you.";
    } } catch (PDOException $e) {
    $conn->rollBack();
    echo "<pre style='color:red; font-size:16px;'>❌ Database Error: " . $e->getMessage() . "</pre>";
    exit;
} catch (Throwable $e) {
    echo "<pre style='color:red; font-size:16px;'>❌ General Error: " . $e->getMessage() . "</pre>";
    exit;
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        .credit-card-fields {
            display: none;
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <?php if ($successMessage): ?>
        <h3 style="color: green;"><?php echo $successMessage; ?></h3>
    <?php endif; ?>

    <h2>Order: <?php echo htmlspecialchars($item['item_name']); ?></h2>
    <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>

    <form method="POST" id="orderForm">
        <label>Quantity:</label>
        <input type="number" name="quantity" min="1" required><br><br>

        <label>Delivery Address:</label><br>
        <textarea name="delivery_address" required></textarea><br><br>

        <label>Payment Method:</label>
        <select name="payment_method" id="paymentMethod" required>
            <option value="cash">Cash</option>
            <option value="credit">Credit Card</option>
        </select><br><br>

        <div id="creditCardFields" class="credit-card-fields">
            <h3>Credit Card Information</h3>
            <label>Card Number:</label>
            <input type="text" name="card_number" maxlength="16" placeholder="1234123412341234"><br><br>
            
            <label>Cardholder Name:</label>
            <input type="text" name="card_name" placeholder="Name on card"><br><br>
            
            <label>Expiry Date:</label>
            <input type="text" name="expiry_date" placeholder="MM/YY"><br><br>
            
            <label>CVV:</label>
            <input type="text" name="cvv" maxlength="4" placeholder="123"><br><br>
        </div>

        <button type="submit">Confirm Order</button>
    </form>

    <script>
        document.getElementById('paymentMethod').addEventListener('change', function() {
            const creditCardFields = document.getElementById('creditCardFields');
            if (this.value === 'credit') {
                creditCardFields.style.display = 'block';
                // Make fields required when visible
                creditCardFields.querySelectorAll('input').forEach(input => {
                    input.required = true;
                });
            } else {
                creditCardFields.style.display = 'none';
                // Remove required when hidden
                creditCardFields.querySelectorAll('input').forEach(input => {
                    input.required = false;
                });
            }
        });
    </script>
</body>
</html>