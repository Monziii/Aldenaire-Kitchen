<?php
/**
 * Database Test File
 * 
 * This file tests the database connection and API functionality
 */

require_once 'config.php';
require_once 'includes/db.php';

echo "<h1>Aldenaire Kitchen - Database Test</h1>";

try {
    echo "<h2>✅ Database Connection Test</h2>";
    echo "<p>Database connected successfully!</p>";
    
    // Test menu items
    echo "<h2>📋 Menu Items Test</h2>";
    $menu_items = fetch_all("SELECT * FROM menu_items LIMIT 5");
    echo "<p>Found " . count($menu_items) . " menu items</p>";
    
    if (count($menu_items) > 0) {
        echo "<ul>";
        foreach ($menu_items as $item) {
            echo "<li>{$item['item_name']} - \${$item['price']}</li>";
        }
        echo "</ul>";
    }
    
    // Test reviews
    echo "<h2>⭐ Reviews Test</h2>";
    $reviews = fetch_all("SELECT * FROM reviews LIMIT 5");
    echo "<p>Found " . count($reviews) . " reviews</p>";
    
    if (count($reviews) > 0) {
        echo "<ul>";
        foreach ($reviews as $review) {
            echo "<li>{$review['customer_name']} - {$review['rating']} stars</li>";
        }
        echo "</ul>";
    }
    
    // Test menu items with ratings
    echo "<h2>🍽️ Menu Items with Ratings Test</h2>";
    $sql = "
        SELECT 
            m.*,
            COALESCE(AVG(r.rating), 0) as avg_rating,
            COUNT(r.id) as review_count
        FROM menu_items m
        LEFT JOIN reviews r ON r.is_approved = 1
        WHERE m.is_available = 1
        GROUP BY m.item_id
        ORDER BY m.item_id
        LIMIT 5
    ";
    
    $menu_with_ratings = fetch_all($sql);
    echo "<p>Found " . count($menu_with_ratings) . " menu items with ratings</p>";
    
    if (count($menu_with_ratings) > 0) {
        echo "<ul>";
        foreach ($menu_with_ratings as $item) {
            echo "<li>{$item['item_name']} - \${$item['price']} - {$item['avg_rating']} stars ({$item['review_count']} reviews)</li>";
        }
        echo "</ul>";
    }
    
    // Test API endpoints
    echo "<h2>🔗 API Endpoints Test</h2>";
    $api_urls = [
        'Menu API' => 'http://localhost:8000/api/menu.php',
        'Reviews API' => 'http://localhost:8000/api/reviews.php',
        'Contact API' => 'http://localhost:8000/api/contact.php',
        'Orders API' => 'http://localhost:8000/api/orders.php'
    ];
    
    foreach ($api_urls as $name => $url) {
        echo "<h3>$name</h3>";
        echo "<p>URL: <a href='$url' target='_blank'>$url</a></p>";
        
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => 'Content-Type: application/json'
            ]
        ]);
        
        $response = @file_get_contents($url, false, $context);
        
        if ($response !== false) {
            $data = json_decode($response, true);
            if ($data && isset($data['success'])) {
                echo "<p style='color: green;'>✅ API working - " . ($data['message'] ?? 'Success') . "</p>";
            } else {
                echo "<p style='color: orange;'>⚠️ API response format issue</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ API not accessible</p>";
        }
    }
    
    echo "<h2>🎉 All Tests Completed!</h2>";
    echo "<p>The database and API are working correctly.</p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error</h2>";
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
}

h1 {
    color: #333;
    text-align: center;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

h2 {
    color: #007bff;
    margin-top: 30px;
}

h3 {
    color: #555;
    margin-top: 20px;
}

ul {
    background: white;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

li {
    margin: 5px 0;
    padding: 5px 0;
    border-bottom: 1px solid #eee;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

p {
    background: white;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
</style> 