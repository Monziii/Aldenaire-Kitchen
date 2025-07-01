<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Aldenaire_Kitchen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['question'] ?? '', FILTER_SANITIZE_STRING);

    if (empty($email) || empty($message)) {
        echo '<p style="color:red; font-weight:bold;">Please fill in all required fields.</p>';
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO contact_messages (email, message) VALUES (?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $email, $message);

    if ($stmt->execute()) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1" />
          <title>Thank You</title>
          <style>
            body {
              background-color: #fff8f0;
              font-family: 'Arial', sans-serif;
              color: #333;
              display: flex;
              align-items: center;
              justify-content: center;
              height: 100vh;
              margin: 0;
              padding: 20px;
            }
            .thank-you-container {
              background: #fff;
              padding: 40px 60px;
              border-radius: 15px;
              box-shadow: 0 6px 18px rgba(255, 165, 0, 0.3);
              text-align: center;
              max-width: 500px;
              width: 100%;
              animation: fadeIn 0.6s ease-in-out;
            }
            h1 {
              color: #FF8C00;
              font-size: 2.5rem;
              margin-bottom: 15px;
              text-transform: uppercase;
              letter-spacing: 2px;
            }
            p {
              font-size: 1.2rem;
              color: #555;
              margin-bottom: 30px;
              line-height: 1.6;
            }
            a.button {
              display: inline-block;
              padding: 12px 28px;
              background-color: #FFA500;
              color: white;
              border-radius: 8px;
              font-weight: 700;
              text-decoration: none;
              transition: background-color 0.3s ease;
              letter-spacing: 1px;
              text-transform: uppercase;
            }
            a.button:hover {
              background-color: #e69500;
            }
            @keyframes fadeIn {
              from {opacity: 0; transform: translateY(20px);}
              to {opacity: 1; transform: translateY(0);}
            }
            @media (max-width: 480px) {
              .thank-you-container {
                padding: 30px 20px;
              }
              h1 {
                font-size: 2rem;
              }
              p {
                font-size: 1rem;
              }
            }
          </style>
        </head>
        <body>
          <div class="thank-you-container">
            <h1>Thank You!</h1>
            <p>We received your message successfully. Our team will get back to you shortly.</p>
            <a href="/Final_project/contact.php" class="button">Back to Contact Page</a>
          </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p style='color:red; font-weight:bold;'>Error: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
} else {
    echo "<p style='color:red; font-weight:bold;'>Invalid request method.</p>";
}

$conn->close();
