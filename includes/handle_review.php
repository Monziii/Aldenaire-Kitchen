<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['rating', 'comment'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error'] = "Please fill all required fields";
            header("Location: ../public/reviews.php");
            exit();
        }
    }

    $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
    $item_id = !empty($_POST['item_id']) ? (int)$_POST['item_id'] : null;
    $rating = (int)$_POST['rating'];
    $comment = trim($_POST['comment']);
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;

    $query = "INSERT INTO reviews (user_id, item_id, rating, comment, name, review_date) 
              VALUES (:user_id, :item_id, :rating, :comment, :name, NOW())";

    $stmt = $conn->prepare($query);

    $stmt->bindValue(':user_id', $user_id, $user_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':item_id', $item_id, $item_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, $name === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

    try {
        $stmt->execute();
        $_SESSION['success'] = "Thank you for your review!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "There was an error submitting your review. Please try again.";
    }

    header("Location: ../public/reviews.php");
    exit();
}
