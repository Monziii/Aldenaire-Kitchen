<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Aldenaire Kitchen</title>
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="css/Cart.css">
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

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
            text-align: center;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
            text-align: center;
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
                    <a href="contact.php">Contact</a>
                </li>
                <li>
                    <a href="cart.php" class="active">My Orders 🛒 
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
        <div class="cart-page">
            <section class="cart-section">
                <h1>My Orders</h1>

                <div id="emptyCart" class="empty-cart" style="display: none;">
                    <h2>Your cart is empty</h2>
                    <p>Add some delicious items to your cart to get started!</p>
                    <a href="menu.php" class="view-menu-btn">View Menu</a>
                </div>

                <div id="cartContent" class="cart-content" style="display: none;">
                    <div class="cart-items">
                        <h2>Cart Items (<span id="cartItemCount">0</span>)</h2>
                        <div id="cartItemsList"></div>
                    </div>

                    <div class="cart-summary">
                        <h2>Order Summary</h2>
                        <div class="summary-item">
                            <span>Subtotal:</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="summary-item">
                            <span>Tax:</span>
                            <span id="tax">$0.00</span>
                        </div>
                        <div class="summary-item total">
                            <span>Total:</span>
                            <span id="total">$0.00</span>
                        </div>

                        <button 
                            onclick="handleCheckout()"
                            class="checkout-btn"
                            id="checkoutBtn"
                        >
                            Proceed to Checkout
                        </button>
                    </div>
                </div>

                <div id="paymentForm" class="payment-form" style="display: none;">
                    <h2>Payment Information</h2>
                    
                    <div class="form-group">
                        <label>Your Name *</label>
                        <input
                            type="text"
                            placeholder="Enter your full name"
                            id="customerName"
                            required
                        />
                    </div>

                    <div class="payment-method">
                        <label>
                            <input
                                type="radio"
                                name="paymentMethod"
                                value="cash"
                                checked
                                onchange="setPaymentMethod(this.value)"
                            />
                            Cash on Delivery
                        </label>
                        <label>
                            <input
                                type="radio"
                                name="paymentMethod"
                                value="card"
                                onchange="setPaymentMethod(this.value)"
                            />
                            Credit/Debit Card
                        </label>
                    </div>

                    <div id="cardDetails" class="card-details" style="display: none;">
                        <div class="form-group">
                            <label>Card Number:</label>
                            <input
                                type="text"
                                placeholder="1234 5678 9012 3456"
                                id="cardNumber"
                                maxlength="19"
                            />
                        </div>
                        <div class="form-group">
                            <label>Card Holder Name:</label>
                            <input
                                type="text"
                                placeholder="John Doe"
                                id="cardHolder"
                            />
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Expiry Date:</label>
                                <input
                                    type="text"
                                    placeholder="MM/YY"
                                    id="expiryDate"
                                    maxlength="5"
                                />
                            </div>
                            <div class="form-group">
                                <label>CVV:</label>
                                <input
                                    type="text"
                                    placeholder="123"
                                    id="cvv"
                                    maxlength="4"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="payment-actions">
                        <button 
                            onclick="cancelPayment()"
                            class="cancel-btn"
                        >
                            Cancel
                        </button>
                        <button 
                            onclick="handlePayment()"
                            class="pay-btn"
                            id="payBtn"
                        >
                            Pay Now
                        </button>
                    </div>
                </div>

                <div id="successMessage" class="success-message" style="display: none;">
                    <h2>Payment Successful!</h2>
                    <p>Your order has been placed successfully. Thank you for your order!</p>
                    <p>Order Total: <span id="orderTotal">$0.00</span></p>
                </div>

                <div id="errorMessage" class="error-message" style="display: none;">
                    <h2>Payment Failed</h2>
                    <p>There was an error processing your payment. Please try again.</p>
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
        let isCheckingOut = false;
        let checkoutStatus = null;
        let showPaymentForm = false;
        let paymentMethod = 'cash';
        let customerName = '';
        let paymentData = {
            cardNumber: '',
            cardHolder: '',
            expiryDate: '',
            cvv: ''
        };

        // Update quantity
        const updateQuantity = (itemId, newQuantity) => {
            if (newQuantity < 1) {
                removeFromCart(itemId);
                return;
            }

            cartItems = cartItems.map(cartItem => 
                cartItem.item_id === itemId 
                    ? { ...cartItem, quantity: newQuantity }
                    : cartItem
            );

            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartCount();
            renderCart();
        };

        // Remove from cart
        const removeFromCart = (itemId) => {
            cartItems = cartItems.filter(cartItem => cartItem.item_id !== itemId);
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartCount();
            renderCart();
        };

        // Clear cart
        const clearCart = () => {
            cartItems = [];
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartCount();
            renderCart();
        };

        // Calculate total
        const calculateTotal = () => {
            return cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
        };

        // Render cart
        const renderCart = () => {
            const emptyCart = document.getElementById('emptyCart');
            const cartContent = document.getElementById('cartContent');
            const cartItemsList = document.getElementById('cartItemsList');
            const cartItemCount = document.getElementById('cartItemCount');

            if (cartItems.length === 0) {
                emptyCart.style.display = 'block';
                cartContent.style.display = 'none';
                return;
            }

            emptyCart.style.display = 'none';
            cartContent.style.display = 'block';
            cartItemCount.textContent = cartItems.length;

            cartItemsList.innerHTML = cartItems.map(item => `
                <div class="cart-item">
                    <div class="item-image">
                        <img src="assets/images/${item.image_path}" alt="${item.item_name}" />
                    </div>
                    <div class="item-details">
                        <h3>${item.item_name}</h3>
                        <p class="item-price">$${item.price.toFixed(2)}</p>
                    </div>
                    <div class="item-quantity">
                        <button 
                            onclick="updateQuantity(${item.item_id}, ${item.quantity - 1})"
                            class="quantity-btn"
                        >
                            -
                        </button>
                        <span class="quantity">${item.quantity}</span>
                        <button 
                            onclick="updateQuantity(${item.item_id}, ${item.quantity + 1})"
                            class="quantity-btn"
                        >
                            +
                        </button>
                    </div>
                    <div class="item-total">
                        <p>$${(item.price * item.quantity).toFixed(2)}</p>
                    </div>
                    <button 
                        onclick="removeFromCart(${item.item_id})"
                        class="remove-btn"
                    >
                        ×
                    </button>
                </div>
            `).join('');

            // Update summary
            const subtotal = calculateTotal();
            const tax = subtotal * 0.08;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        };

        // Handle checkout
        const handleCheckout = () => {
            showPaymentForm = true;
            document.getElementById('paymentForm').style.display = 'block';
            document.getElementById('cartContent').style.display = 'none';
        };

        // Set payment method
        const setPaymentMethod = (method) => {
            paymentMethod = method;
            const cardDetails = document.getElementById('cardDetails');
            cardDetails.style.display = method === 'card' ? 'block' : 'none';
        };

        // Cancel payment
        const cancelPayment = () => {
            showPaymentForm = false;
            document.getElementById('paymentForm').style.display = 'none';
            document.getElementById('cartContent').style.display = 'block';
        };

        // Handle payment
        const handlePayment = async () => {
            customerName = document.getElementById('customerName').value.trim();
            
            if (!customerName) {
                alert('Please enter your name');
                return;
            }

            isCheckingOut = true;
            const payBtn = document.getElementById('payBtn');
            payBtn.textContent = 'Processing Payment...';
            payBtn.disabled = true;

            try {
                const orderData = {
                    customer_name: customerName,
                    items: cartItems.map(item => ({
                        item_id: item.item_id,
                        item_name: item.item_name,
                        quantity: item.quantity,
                        price: item.price
                    })),
                    total_amount: calculateTotal() * 1.08,
                    payment_method: paymentMethod
                };

                // Try to save to database first
                try {
                    const response = await fetch('api/orders.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(orderData)
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.error || 'Failed to place order');
                    }

                    const data = await response.json();
                    console.log('Order saved to database:', data);
                } catch (apiError) {
                    console.error('API Error:', apiError);
                    // Continue with mock payment if API fails
                    console.log('Continuing with mock payment...');
                }

                // Simulate payment process
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                checkoutStatus = 'success';
                clearCart();
                showPaymentForm = false;
                customerName = '';
                
                document.getElementById('paymentForm').style.display = 'none';
                document.getElementById('successMessage').style.display = 'block';
                document.getElementById('orderTotal').textContent = `$${(calculateTotal() * 1.08).toFixed(2)}`;
            } catch (error) {
                console.error('Error during payment:', error);
                checkoutStatus = 'error';
                document.getElementById('errorMessage').style.display = 'block';
            } finally {
                isCheckingOut = false;
                payBtn.textContent = 'Pay Now';
                payBtn.disabled = false;
            }
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
            renderCart();
        });
    </script>
</body>
</html> 