<?php
/**
 * Menu API Endpoint
 * 
 * Handles menu items retrieval
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
        // Get all menu items
        $sql = "
            SELECT 
                m.item_id,
                m.item_name,
                m.description,
                m.price,
                m.category,
                m.image_path,
                m.is_available,
                m.created_at,
                0 as avg_rating,
                0 as review_count
            FROM menu_items m
            WHERE m.is_available = 1
            ORDER BY m.item_id
        ";
        
        $menu_items = fetch_all($sql);
        
        // Format the response
        $formatted_items = array_map(function($item) {
            return [
                'item_id' => $item['item_id'],
                'item_name' => $item['item_name'],
                'description' => $item['description'],
                'price' => floatval($item['price']),
                'category' => $item['category'],
                'image_path' => $item['image_path'],
                'is_available' => (bool)$item['is_available'],
                'avg_rating' => floatval($item['avg_rating']),
                'review_count' => intval($item['review_count'])
            ];
        }, $menu_items);
        
        $response = [
            'success' => true,
            'message' => 'Menu items retrieved successfully',
            'menu_items' => $formatted_items,
            'total_items' => count($formatted_items)
        ];
        
        send_json_response($response);
        
    } else {
        throw new Exception('Method not allowed');
    }
    
} catch (Exception $e) {
    log_error('Menu API Error: ' . $e->getMessage());
    
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
    
    send_json_response($response, 400);
}
?> 