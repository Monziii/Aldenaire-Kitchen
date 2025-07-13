<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Aldenaire Kitchen</title>
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="css/Contact.css">
    <link rel="stylesheet" href="css/Footer.css">
    <style>
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', 'Arial', sans-serif;
            background: #fff;
            color: #333;
            line-height: 1.6;
        }
        
        .main-content {
            flex: 1;
        }

        .api-warning {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
            font-size: 14px;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="assets/images/logo.png" alt="Logo" />
            </a>
        </div>
        
        <nav class="main-nav">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="about.php">About</a>
                </li>
                <li>
                    <a href="menu.php">Menu</a>
                </li>
                <li>
                    <a href="reviews.php">Reviews</a>
                </li>
                <li>
                    <a href="contact.php" class="active">Contact</a>
                </li>
                <li>
                    <a href="cart.php">My Orders 🛒 
                        <span class="cart-count" id="cartCount">0</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="menu-icon" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="mobile-nav" id="mobileNav">
            <ul>
                <li>
                    <a href="index.php" onclick="toggleMobileMenu()">Home</a>
                </li>
                <li>
                    <a href="about.php" onclick="toggleMobileMenu()">About</a>
                </li>
                <li>
                    <a href="menu.php" onclick="toggleMobileMenu()">Menu</a>
                </li>
                <li>
                    <a href="reviews.php" onclick="toggleMobileMenu()">Reviews</a>
                </li>
                <li>
                    <a href="contact.php" onclick="toggleMobileMenu()">Contact</a>
                </li>
                <li>
                    <a href="cart.php" onclick="toggleMobileMenu()">
                        My Orders 🛒 
                        <span class="cart-count" id="mobileCartCount">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="contact-page">
            <section class="contact-section">
                <h1>Contact Us</h1>
                <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>

                <div id="apiWarning" class="api-warning" style="display: none;">
                    ⚠️ API is not available. Using demo mode - messages will be simulated locally.
                </div>
                
                <div class="contact-content">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <div class="contact-item">
                            <strong>Address:</strong>
                            <p>123 Restaurant Street<br />Food City, FC 12345</p>
                        </div>
                        <div class="contact-item">
                            <strong>Phone:</strong>
                            <p>+1 (555) 123-4567</p>
                        </div>
                        <div class="contact-item">
                            <strong>Email:</strong>
                            <p>info@aldenairekitchen.com</p>
                        </div>
                        <div class="contact-item">
                            <strong>Hours:</strong>
                            <p>Monday - Friday: 11:00 AM - 10:00 PM<br />
                               Saturday - Sunday: 10:00 AM - 11:00 PM</p>
                        </div>
                    </div>

                    <div class="contact-form">
                        <h3>Send us a Message</h3>
                        <form id="contactForm" onsubmit="handleSubmit(event)">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <input
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="5"
                                    required
                                ></textarea>
                            </div>

                            <button 
                                type="submit" 
                                class="submit-btn"
                                id="submitBtn"
                            >
                                Send Message
                            </button>

                            <div id="successMessage" class="success-message" style="display: none;">
                                Thank you! Your message has been sent successfully.
                            </div>

                            <div id="errorMessage" class="error-message" style="display: none;">
                                Sorry, there was an error sending your message. Please try again.
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-pro">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="assets/images/logo.png" alt="Aldenaire Kitchen Logo" class="footer-logo" />
                <span class="footer-title">Aldenaire Kitchen</span>
                <p class="footer-tagline">Delicious food, exceptional service</p>
            </div>
            <div class="footer-info">
                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <p>📍 123 Restaurant Street, City</p>
                    <p>📞 (555) 123-4567</p>
                    <p>✉️ info@aldenaire.com</p>
                </div>
                <div class="footer-section">
                    <h4>Opening Hours</h4>
                    <p>Monday - Friday: 11:00 AM - 10:00 PM</p>
                    <p>Saturday - Sunday: 12:00 PM - 11:00 PM</p>
                </div>
            </div>
            <div class="footer-social">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="https://facebook.com" class="footer-social-icon" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0" fill="currentColor"/></svg>
                    </a>
                    <a href="https://youtube.com" class="footer-social-icon" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.498 6.186a2.994 2.994 0 0 0-2.108-2.116C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.39.57A2.994 2.994 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a2.994 2.994 0 0 0 2.108 2.116C4.495 20.5 12 20.5 12 20.5s7.505 0 9.39-.57a2.994 2.994 0 0 0 2.108-2.116C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" fill="currentColor"/></svg>
                    </a>
                    <a href="https://twitter.com" class="footer-social-icon" aria-label="Twitter" target="_blank" rel="noopener noreferrer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.564-2.005.974-3.127 1.195A4.916 4.916 0 0 0 16.616 3c-2.72 0-4.924 2.206-4.924 4.924 0 .386.044.763.127 1.124C7.728 8.807 4.1 6.884 1.671 3.965c-.423.724-.666 1.561-.666 2.475 0 1.708.87 3.216 2.188 4.099a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 0 1-2.224.084c.627 1.956 2.444 3.377 4.6 3.417A9.867 9.867 0 0 1 0 21.543a13.94 13.94 0 0 0 7.548 2.212c9.057 0 14.009-7.513 14.009-14.009 0-.213-.005-.425-.014-.636A10.012 10.012 0 0 0 24 4.557z" fill="currentColor"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© <script>document.write(new Date().getFullYear())</script> Aldenaire Kitchen. All rights reserved.</span>
        </div>
    </footer>

    <script>
        // Global variables
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        let isSubmitting = false;
        let apiAvailable = true;

        // Handle form submission
        const handleSubmit = async (e) => {
            e.preventDefault();
            isSubmitting = true;
            
            // Hide previous messages
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';
            
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            try {
                if (!apiAvailable) {
                    // If API is not available, use mock submission
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    
                    showSuccessMessage();
                    resetForm();
                    apiAvailable = false;
                    return;
                }

                const formData = new FormData(e.target);
                const data = {
                    name: formData.get('name'),
                    email: formData.get('email'),
                    subject: formData.get('subject'),
                    message: formData.get('message')
                };

                const response = await fetch('api/contact.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.error || 'Failed to send message');
                }

                showSuccessMessage();
                resetForm();
            } catch (error) {
                console.error('Error submitting form:', error);
                // Fallback to demo mode
                apiAvailable = false;
                document.getElementById('apiWarning').style.display = 'block';
                await new Promise(resolve => setTimeout(resolve, 1000));
                showSuccessMessage();
                resetForm();
            } finally {
                isSubmitting = false;
                submitBtn.textContent = 'Send Message';
                submitBtn.disabled = false;
            }
        };

        // Show success message
        const showSuccessMessage = () => {
            document.getElementById('successMessage').style.display = 'block';
        };

        // Reset form
        const resetForm = () => {
            document.getElementById('contactForm').reset();
        };

        // Update cart count
        const updateCartCount = () => {
            const count = cartItems.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
            document.getElementById('mobileCartCount').textContent = count;
        };

        // Mobile menu toggle
        const toggleMobileMenu = () => {
            const mobileNav = document.getElementById('mobileNav');
            mobileNav.style.display = mobileNav.style.display === 'block' ? 'none' : 'block';
        };

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
        });
    </script>
</body>
</html>
