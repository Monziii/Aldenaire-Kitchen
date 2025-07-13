<?php
/**
 * Reviews API Endpoint
 * 
 * Handles customer reviews CRUD operations
 */

require_once '../config.php';
require_once '../includes/db.php';

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Get all reviews
        $sql = "
            SELECT 
                r.id,
                r.customer_name,
                r.rating,
                r.comment,
                r.created_at,
                r.is_approved
            FROM reviews r
            WHERE r.is_approved = 1
            ORDER BY r.created_at DESC
        ";
        
        $reviews = fetch_all($sql);
        
        // Format the response
        $response = [
            'success' => true,
            'message' => 'Reviews retrieved successfully',
            'reviews' => $reviews,
            'total_reviews' => count($reviews)
        ];
        
        send_json_response($response);
        
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Add new review
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            throw new Exception('Invalid JSON input');
        }
        
        // Validate required fields
        $required_fields = ['customer_name', 'rating', 'comment'];
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }
        
        // Sanitize input
        $customer_name = sanitize_input($input['customer_name']);
        $rating = intval($input['rating']);
        $comment = sanitize_input($input['comment']);
        
        // Validate rating
        if ($rating < 1 || $rating > 5) {
            throw new Exception('Rating must be between 1 and 5');
        }
        
        // Insert new review
        $sql = "
            INSERT INTO reviews (customer_name, rating, comment)
            VALUES (?, ?, ?)
        ";
        
        $review_id = insert_data($sql, [$customer_name, $rating, $comment]);
        
        // Get the newly created review
        $new_review = fetch_one("
            SELECT 
                r.id,
                r.customer_name,
                r.rating,
                r.comment,
                r.created_at,
                r.is_approved
            FROM reviews r
            WHERE r.id = ?
        ", [$review_id]);
        
        $response = [
            'success' => true,
            'message' => 'Review submitted successfully',
            'review' => $new_review
        ];
        
        send_json_response($response, 201);
        
    } else {
        throw new Exception('Method not allowed');
    }
    
} catch (Exception $e) {
    log_error('Reviews API Error: ' . $e->getMessage());
    
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
    
    send_json_response($response, 400);
}
?> 