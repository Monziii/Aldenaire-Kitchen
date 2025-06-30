<?php
session_start();
require '../includes/db.php';

header('Content-Type: text/plain');

if (!isset($_GET['item_id'])) {
    http_response_code(400);
    echo "0";
    exit;
}

$item_id = (int)$_GET['item_id'];

$stmt = $conn->prepare("SELECT item_id, item_name, price FROM menu_items WHERE item_id = ?");
$stmt->execute([$item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    http_response_code(404);
    echo "0";
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$item_id])) {
    $_SESSION['cart'][$item_id]['quantity']++;
} else {
    $_SESSION['cart'][$item_id] = [
        'item_id' => $item['item_id'],
        'item_name' => $item['item_name'],
        'price' => (float)$item['price'],
        'quantity' => 1
    ];
}

$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
echo $cartCount;
exit;
