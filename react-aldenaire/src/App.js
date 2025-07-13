import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Header from './components/Header';
import Footer from './components/Footer';
import Home from './pages/Home';
import Menu from './pages/Menu';
import About from './pages/About';
import Contact from './pages/Contact';
import Reviews from './pages/Reviews';
import Cart from './pages/Cart';
import './App.css';

function App() {
  // Load cart from localStorage on mount
  const getInitialCart = () => {
    try {
      const items = JSON.parse(localStorage.getItem('cartItems')) || [];
      return items;
    } catch {
      return [];
    }
  };
  const getInitialCartCount = () => {
    try {
      return parseInt(localStorage.getItem('cartCount'), 10) || 0;
    } catch {
      return 0;
    }
  };

  const [cartItems, setCartItems] = useState(getInitialCart);
  const [cartCount, setCartCount] = useState(getInitialCartCount);

  const addToCart = (item) => {
    setCartItems(prevItems => {
      const existingItem = prevItems.find(cartItem => cartItem.item_id === item.item_id);
      
      if (existingItem) {
        // Item already exists, increase quantity
        return prevItems.map(cartItem => 
          cartItem.item_id === item.item_id 
            ? { ...cartItem, quantity: cartItem.quantity + 1 }
            : cartItem
        );
      } else {
        // Add new item
        return [...prevItems, { ...item, quantity: 1 }];
      }
    });
    
    // Update cart count
    setCartCount(prevCount => prevCount + 1);
  };

  const updateCartItemQuantity = (itemId, newQuantity) => {
    if (newQuantity < 1) {
      removeFromCart(itemId);
      return;
    }

    setCartItems(prevItems => {
      return prevItems.map(cartItem => 
        cartItem.item_id === itemId 
          ? { ...cartItem, quantity: newQuantity }
          : cartItem
      );
    });

    // Update cart count based on total items
    const newTotalItems = cartItems.reduce((total, item) => {
      if (item.item_id === itemId) {
        return total + newQuantity;
      }
      return total + item.quantity;
    }, 0);
    setCartCount(newTotalItems);
  };

  const removeFromCart = (itemId) => {
    setCartItems(prevItems => {
      const item = prevItems.find(cartItem => cartItem.item_id === itemId);
      if (item && item.quantity > 1) {
        // Decrease quantity
        return prevItems.map(cartItem => 
          cartItem.item_id === itemId 
            ? { ...cartItem, quantity: cartItem.quantity - 1 }
            : cartItem
        );
      } else {
        // Remove item completely
        return prevItems.filter(cartItem => cartItem.item_id !== itemId);
      }
    });
    
    // Update cart count
    setCartCount(prevCount => Math.max(0, prevCount - 1));
  };

  const clearCart = () => {
    setCartItems([]);
    setCartCount(0);
  };

  // Save cart to localStorage whenever cartItems or cartCount changes
  useEffect(() => {
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    localStorage.setItem('cartCount', cartCount.toString());
  }, [cartItems, cartCount]);

  return (
    <Router>
      <div className="App">
        <Header cartCount={cartCount} />
        <main>
          <Routes>
            <Route path="/" element={<Home cartCount={cartCount} addToCart={addToCart} />} />
            <Route path="/menu" element={<Menu cartCount={cartCount} addToCart={addToCart} />} />
            <Route path="/about" element={<About />} />
            <Route path="/contact" element={<Contact />} />
            <Route path="/reviews" element={<Reviews />} />
            <Route path="/cart" element={<Cart cartItems={cartItems} removeFromCart={removeFromCart} updateCartItemQuantity={updateCartItemQuantity} clearCart={clearCart} />} />
          </Routes>
        </main>
        <Footer />
      </div>
    </Router>
  );
}

export default App;
