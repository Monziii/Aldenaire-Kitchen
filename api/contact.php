<?php
/**
 * Contact API Endpoint
 * 
 * Handles contact form submissions
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle contact form submission
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            throw new Exception('Invalid JSON input');
        }
        
        // Validate required fields
        $required_fields = ['name', 'email', 'subject', 'message'];
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }
        
        // Sanitize input
        $name = sanitize_input($input['name']);
        $email = sanitize_input($input['email']);
        $subject = sanitize_input($input['subject']);
        $message = sanitize_input($input['message']);
        
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address');
        }
        
        // Validate message length (reduced to 5 characters minimum)
        if (strlen($message) < 5) {
            throw new Exception('Message must be at least 5 characters long');
        }
        
        // Insert contact message
        $sql = "
            INSERT INTO contact_messages (name, email, subject, message)
            VALUES (?, ?, ?, ?)
        ";
        
        $message_id = insert_data($sql, [$name, $email, $subject, $message]);
        
        // Get the newly created message
        $new_message = fetch_one("SELECT * FROM contact_messages WHERE id = ?", [$message_id]);
        
        $response = [
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you soon.',
            'contact_id' => $message_id
        ];
        
        send_json_response($response, 201);
        
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Get contact messages (admin functionality)
        $sql = "
            SELECT 
                id,
                name,
                email,
                subject,
                message,
                created_at,
                is_read
            FROM contact_messages
            ORDER BY created_at DESC
        ";
        
        $messages = fetch_all($sql);
        
        $response = [
            'success' => true,
            'message' => 'Contact messages retrieved successfully',
            'messages' => $messages,
            'total_messages' => count($messages)
        ];
        
        send_json_response($response);
        
    } else {
        throw new Exception('Method not allowed');
    }
    
} catch (Exception $e) {
    log_error('Contact API Error: ' . $e->getMessage());
    
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
    
    send_json_response($response, 400);
}
?> 