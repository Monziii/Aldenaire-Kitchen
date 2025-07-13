<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Aldenaire Kitchen</title>
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/MenuCard.css">
    <link rel="stylesheet" href="css/Toast.css">
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
                    <a href="menu.php" class="active">Menu</a>
                </li>
                <li>
                    <a href="reviews.php">Reviews</a>
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
        <div class="menu-page">
            <section class="menu-section">
                <h1>Our Menu</h1>
                
                <div class="menu-container" id="menuContainer">
                    <div class="loading">Loading menu items...</div>
                </div>
            </section>
        </div>
    </div>

    <!-- Toast Component -->
    <div class="toast" id="toast"></div>

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
        let menuItems = [];
        let isProcessing = false;
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        // Mock menu items (same as React)
        const getMockMenuItems = () => {
            return [
                {
                    item_id: 1,
                    item_name: "Grilled Chicken Salad",
                    description: "Fresh mixed greens with grilled chicken breast, cherry tomatoes, and balsamic vinaigrette",
                    price: 12.99,
                    image_path: "grilled-chicken-skinless.png",
                    avg_rating: 4.5
                },
                {
                    item_id: 2,
                    item_name: "Fresh Fish with Lemon",
                    description: "Grilled white fish served with fresh vegetables and lemon herb sauce",
                    price: 18.99,
                    image_path: "grilled-fish-fresh-salad-lemon.png",
                    avg_rating: 4.8
                },
                {
                    item_id: 3,
                    item_name: "Calamari Delight",
                    description: "Crispy fried calamari rings served with marinara sauce",
                    price: 15.99,
                    image_path: "calamari.png",
                    avg_rating: 4.3
                },
                {
                    item_id: 4,
                    item_name: "Chicken Burger",
                    description: "Grilled chicken breast burger with lettuce, tomato, and special sauce",
                    price: 11.99,
                    image_path: "hd-sapid-chicken-burger-with-french-fries-on-wood-plate-png-701751710858563bp8ufljnki-removebg-preview.png",
                    avg_rating: 4.6
                },
                {
                    item_id: 5,
                    item_name: "Grilled Shrimp",
                    description: "Jumbo shrimp grilled to perfection with garlic butter sauce",
                    price: 22.99,
                    image_path: "sherimp.png",
                    avg_rating: 4.7
                },
                {
                    item_id: 6,
                    item_name: "Pasta Primavera",
                    description: "Fresh vegetables and al dente pasta in a light cream sauce",
                    price: 14.99,
                    image_path: "pngtree-deliciously-vibrant-pasta-dish-with-vegetables-png-image_15824694-removebg-preview.png",
                    avg_rating: 4.4
                },
                {
                    item_id: 7,
                    item_name: "Rice with Fried Meat",
                    description: "Fragrant rice served with tender fried meat and vegetables",
                    price: 13.99,
                    image_path: "11.top-view-plate-rice-fried-meat-top-view-plate-rice-fried-meat-white-background-302886539-removebg-preview.png",
                    avg_rating: 4.2
                },
                {
                    item_id: 8,
                    item_name: "Chicken Salad",
                    description: "Fresh chicken salad with mixed greens and house dressing",
                    price: 10.99,
                    image_path: "chicken-salad-front-view-white-background_842983-25656-removebg-preview.png",
                    avg_rating: 4.1
                },
                {
                    item_id: 9,
                    item_name: "Grilled Chicken with Vegetables",
                    description: "Grilled chicken breast served with seasonal vegetables",
                    price: 16.99,
                    image_path: "plate-grilled-chicken-vegetables-isolated-260nw-767067433-removebg-preview.png",
                    avg_rating: 4.6
                },
                {
                    item_id: 10,
                    item_name: "Fresh Salad",
                    description: "Mixed greens with fresh vegetables and light dressing",
                    price: 8.99,
                    image_path: "images__1_-removebg-preview.png",
                    avg_rating: 4.0
                },
                {
                    item_id: 11,
                    item_name: "Steak with Vegetables",
                    description: "Premium quality steak with rich flavors",
                    price: 14.99,
                    image_path: "14.png",
                    avg_rating: 4.5
                },
                {
                    item_id: 12,
                    item_name: "Chicken & Veggie Rice Bowl",
                    description: "Aromatic rice with mixed vegetables and grilled chicken, topped with special sauce",
                    price: 15.49,
                    image_path: "istockphoto-1056419208-612x612.jpg",
                    avg_rating: 4.3
                }
            ];
        };

        // Fetch all menu items from API
        const fetchAllMenuItems = async () => {
            try {
                const response = await fetch('api/menu.php');
                if (!response.ok) {
                    throw new Error('Failed to fetch menu items');
                }
                const data = await response.json();
                menuItems = data.menu_items || [];
            } catch (error) {
                console.error('Error fetching menu items:', error);
                // Fallback to mock data if API fails
                menuItems = getMockMenuItems();
            }
            renderAllMenuItems();
        };

        // Render all menu items
        const renderAllMenuItems = () => {
            const menuContainer = document.getElementById('menuContainer');

            if (menuItems.length === 0) {
                menuContainer.innerHTML = '<p>No menu items found.</p>';
                return;
            }

            menuContainer.innerHTML = menuItems.map(item => `
                <div class="menu-card">
                    <div class="card-image ${item.image_path === 'calamari.png' ? 'calamari-image' : ''}">
                        <img src="assets/images/${item.image_path}" alt="${item.item_name}" />
                    </div>
                    
                    <div class="card-content">
                        <h4>${item.item_name}</h4>
                        
                        ${item.avg_rating !== undefined ? `
                            <div class="stars">
                                ${renderStars(item.avg_rating)}
                            </div>
                        ` : ''}
                        
                        <p class="price">$${parseFloat(item.price).toFixed(2)}</p>
                    </div>
                    
                    <div class="card-actions">
                        <button 
                            class="add-to-cart-button"
                            onclick="handleAddToCart(${item.item_id})"
                            disabled="${isProcessing}"
                        >
                            Add To Cart
                        </button>
                    </div>
                </div>
            `).join('');
        };

        // Render stars
        const renderStars = (rating) => {
            const roundedRating = rating ? Math.round(rating) : 4;
            const stars = '⭐'.repeat(roundedRating);
            const emptyStars = '☆'.repeat(5 - roundedRating);
            return stars + emptyStars;
        };

        // Add to cart function
        const handleAddToCart = async (itemId) => {
            if (isProcessing) return;

            isProcessing = true;
            try {
                const item = menuItems.find(menuItem => menuItem.item_id === itemId);
                if (item) {
                    addToCart(item);
                    showToast('✅ Item added to cart!');
                }
            } catch (error) {
                console.error('Error adding to cart:', error);
                showToast('❌ Error adding item. Please try again.');
            } finally {
                isProcessing = false;
            }
        };

        // Add to cart helper
        const addToCart = (item) => {
            const existingItem = cartItems.find(cartItem => cartItem.item_id === item.item_id);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cartItems.push({
                    ...item,
                    quantity: 1
                });
            }
            
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartCount();
        };

        // Update cart count
        const updateCartCount = () => {
            const count = cartItems.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
            document.getElementById('mobileCartCount').textContent = count;
        };

        // Show toast
        const showToast = (message) => {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        };

        // Mobile menu toggle
        const toggleMobileMenu = () => {
            const mobileNav = document.getElementById('mobileNav');
            mobileNav.style.display = mobileNav.style.display === 'block' ? 'none' : 'block';
        };

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            fetchAllMenuItems();
            updateCartCount();
        });
    </script>
</body>
</html>
