<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - Aldenaire Kitchen</title>
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="css/Reviews.css">
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

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 18px;
            color: #666;
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
                    <a href="reviews.php" class="active">Reviews</a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
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
        <div class="reviews-page">
            <section class="reviews-section">
                <h1>Customer Reviews</h1>
                <p>See what our customers are saying about our delicious dishes!</p>

                <div id="apiWarning" class="api-warning" style="display: none;">
                    <p>⚠️ API is not available. Using demo mode - reviews will be saved locally only.</p>
                </div>

                <div class="reviews-content">
                    <div class="reviews-list">
                        <h2>Recent Reviews</h2>
                        <div id="reviewsContainer">
                            <div class="loading">Loading reviews...</div>
                        </div>
                    </div>

                    <div class="review-form-container">
                        <h2>Leave a Review</h2>
                        <form id="reviewForm" onsubmit="handleSubmit(event)" class="review-form">
                            <div class="form-group">
                                <label for="item_id">Select a Dish *</label>
                                <select
                                    id="item_id"
                                    name="item_id"
                                    required
                                >
                                    <option value="">Choose a dish...</option>
                                    <div id="menuOptions"></div>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="customer_name">Your Name *</label>
                                <input
                                    type="text"
                                    id="customer_name"
                                    name="customer_name"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="rating">Rating *</label>
                                <select
                                    id="rating"
                                    name="rating"
                                    required
                                >
                                    <option value="5">⭐⭐⭐⭐⭐ (5 stars)</option>
                                    <option value="4">⭐⭐⭐⭐☆ (4 stars)</option>
                                    <option value="3">⭐⭐⭐☆☆ (3 stars)</option>
                                    <option value="2">⭐⭐☆☆☆ (2 stars)</option>
                                    <option value="1">⭐☆☆☆☆ (1 star)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="comment">Your Review *</label>
                                <textarea
                                    id="comment"
                                    name="comment"
                                    rows="4"
                                    required
                                    placeholder="Tell us about your experience..."
                                ></textarea>
                            </div>

                            <button 
                                type="submit" 
                                class="submit-btn"
                                id="submitBtn"
                            >
                                Submit Review
                            </button>

                            <div id="successMessage" class="success-message" style="display: none;">
                                Thank you! Your review has been submitted successfully.
                                <span id="localSaveNote" style="display: none;"> (Saved locally)</span>
                            </div>

                            <div id="errorMessage" class="error-message" style="display: none;">
                                Sorry, there was an error submitting your review. Please try again.
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
        let reviews = [];
        let menuItems = [];
        let isSubmitting = false;
        let apiAvailable = true;

        // Mock reviews data
        const getMockReviews = () => {
            return [
                {
                    review_id: 1,
                    item_name: "Grilled Chicken Salad",
                    username: "Sarah Johnson",
                    rating: 5,
                    comment: "Absolutely delicious! The chicken was perfectly grilled and the salad was fresh. Highly recommend!",
                    review_date: "2024-01-15"
                },
                {
                    review_id: 2,
                    item_name: "Fresh Fish with Lemon",
                    username: "Michael Chen",
                    rating: 4,
                    comment: "Great flavor and the fish was cooked perfectly. The lemon sauce was a nice touch.",
                    review_date: "2024-01-14"
                },
                {
                    review_id: 3,
                    item_name: "Calamari Delight",
                    username: "Emily Rodriguez",
                    rating: 5,
                    comment: "Best calamari I've ever had! Crispy on the outside, tender on the inside. Amazing!",
                    review_date: "2024-01-13"
                },
                {
                    review_id: 4,
                    item_name: "Chicken Burger",
                    username: "David Wilson",
                    rating: 4,
                    comment: "Solid burger with good quality chicken. The bun was fresh and the toppings were perfect.",
                    review_date: "2024-01-12"
                },
                {
                    review_id: 5,
                    item_name: "Grilled Shrimp",
                    username: "Lisa Thompson",
                    rating: 5,
                    comment: "The shrimp was perfectly grilled and the garlic butter sauce was divine. Will definitely order again!",
                    review_date: "2024-01-11"
                }
            ];
        };

        // Mock menu items for reviews
        const getMockMenuItems = () => {
            return [
                { item_id: 1, item_name: "Grilled Chicken Salad" },
                { item_id: 2, item_name: "Fresh Fish with Lemon" },
                { item_id: 3, item_name: "Calamari Delight" },
                { item_id: 4, item_name: "Chicken Burger" },
                { item_id: 5, item_name: "Grilled Shrimp" },
                { item_id: 6, item_name: "Pasta Primavera" }
            ];
        };

        // Fetch reviews from API
        const fetchReviews = async () => {
            try {
                console.log('Fetching reviews from: api/reviews.php');
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 5000); // 5 second timeout
                
                const response = await fetch('api/reviews.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    signal: controller.signal,
                });
                
                clearTimeout(timeoutId);
                console.log('Response status:', response.status);
                console.log('Response ok:', response.ok);
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Response error text:', errorText);
                    throw new Error(`Failed to fetch reviews: ${response.status} ${response.statusText}`);
                }
                
                const data = await response.json();
                console.log('Reviews data received:', data);
                reviews = data.reviews || [];
                apiAvailable = true;
            } catch (error) {
                console.error('Error fetching reviews:', error);
                // Fallback to mock data if API fails
                reviews = getMockReviews();
                apiAvailable = false;
            }
            renderReviews();
        };

        // Fetch menu items for review form
        const fetchMenuItems = async () => {
            try {
                console.log('Fetching menu items from: api/menu.php');
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 5000); // 5 second timeout
                
                const response = await fetch('api/menu.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    signal: controller.signal,
                });
                
                clearTimeout(timeoutId);
                console.log('Menu response status:', response.status);
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Menu response error text:', errorText);
                    throw new Error(`Failed to fetch menu items: ${response.status} ${response.statusText}`);
                }
                
                const data = await response.json();
                console.log('Menu data received:', data);
                menuItems = data.menu_items || [];
            } catch (error) {
                console.error('Error fetching menu items:', error);
                // Fallback to mock data if API fails
                menuItems = getMockMenuItems();
            }
            renderMenuOptions();
        };

        // Render reviews
        const renderReviews = () => {
            const container = document.getElementById('reviewsContainer');
            
            if (reviews.length === 0) {
                container.innerHTML = '<p>No reviews yet. Be the first to leave a review!</p>';
                return;
            }

            container.innerHTML = `
                <div class="reviews-grid">
                    ${reviews.map(review => `
                        <div class="review-card">
                            <div class="review-header">
                                <h3>${review.item_name}</h3>
                                <div class="stars">${renderStars(review.rating)}</div>
                            </div>
                            <p class="review-comment">${review.comment}</p>
                            <div class="review-footer">
                                <span class="customer-name">- ${review.username}</span>
                                <span class="review-date">${new Date(review.review_date).toLocaleDateString()}</span>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        };

        // Render menu options for review form
        const renderMenuOptions = () => {
            const menuOptions = document.getElementById('menuOptions');
            menuOptions.innerHTML = menuItems.map(item => 
                `<option value="${item.item_id}">${item.item_name}</option>`
            ).join('');
        };

        // Render stars
        const renderStars = (rating) => {
            return '⭐'.repeat(rating) + '☆'.repeat(5 - rating);
        };

        // Handle form submission
        const handleSubmit = async (e) => {
            e.preventDefault();
            isSubmitting = true;
            
            // Hide previous messages
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';
            
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;

            try {
                const formData = new FormData(e.target);
                const newReview = {
                    item_id: formData.get('item_id'),
                    customer_name: formData.get('customer_name'),
                    rating: parseInt(formData.get('rating')),
                    comment: formData.get('comment')
                };

                if (!apiAvailable) {
                    // If API is not available, use mock submission
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    
                    // Get the selected item name
                    const selectedItem = menuItems.find(item => item.item_id === parseInt(newReview.item_id));
                    
                    // Create new review
                    const newReviewData = {
                        review_id: reviews.length + 1,
                        item_name: selectedItem ? selectedItem.item_name : 'Unknown Dish',
                        username: newReview.customer_name,
                        rating: newReview.rating,
                        comment: newReview.comment,
                        review_date: new Date().toISOString().split('T')[0]
                    };

                    // Add to reviews
                    reviews.unshift(newReviewData);
                    renderReviews();

                    // Reset form
                    e.target.reset();
                    showSuccessMessage(true);
                    return;
                }

                const response = await fetch('api/reviews.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(newReview)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.error || 'Failed to submit review');
                }

                const data = await response.json();
                
                // Add new review to the list
                reviews.unshift(data.review);
                renderReviews();

                // Reset form
                e.target.reset();
                showSuccessMessage(false);
            } catch (error) {
                console.error('Error submitting review:', error);
                showErrorMessage();
            } finally {
                isSubmitting = false;
                submitBtn.textContent = 'Submit Review';
                submitBtn.disabled = false;
            }
        };

        // Show success message
        const showSuccessMessage = (isLocal) => {
            const successMessage = document.getElementById('successMessage');
            const localSaveNote = document.getElementById('localSaveNote');
            
            successMessage.style.display = 'block';
            if (isLocal) {
                localSaveNote.style.display = 'inline';
            } else {
                localSaveNote.style.display = 'none';
            }
        };

        // Show error message
        const showErrorMessage = () => {
            document.getElementById('errorMessage').style.display = 'block';
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
        document.addEventListener('DOMContentLoaded', async () => {
            updateCartCount();
            await Promise.all([fetchReviews(), fetchMenuItems()]);
            
            if (!apiAvailable) {
                document.getElementById('apiWarning').style.display = 'block';
            }
        });
    </script>
</body>
</html>
