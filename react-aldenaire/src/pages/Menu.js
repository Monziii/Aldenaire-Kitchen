import React, { useState, useEffect } from 'react';
import MenuCard from '../components/MenuCard';
import Toast from '../components/Toast';
import './Menu.css';

const Menu = ({ cartCount, addToCart }) => {
  const [menuItems, setMenuItems] = useState([]);
  const [isProcessing, setIsProcessing] = useState(false);
  const [toast, setToast] = useState({ show: false, message: '' });

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

  const fetchAllMenuItems = async () => {
    try {
      const response = await fetch('/api/menu.php');
      if (!response.ok) {
        throw new Error('Failed to fetch menu items');
      }
      const data = await response.json();
      setMenuItems(data.menu_items || []);
    } catch (error) {
      console.error('Error fetching menu items:', error);
      // Fallback to mock data if API fails
      setMenuItems(getMockMenuItems());
    }
  };

  useEffect(() => {
    fetchAllMenuItems();
  }, []); // eslint-disable-line react-hooks/exhaustive-deps

  const handleAddToCart = async (itemId) => {
    setIsProcessing(true);
    try {
      const item = menuItems.find(menuItem => menuItem.item_id === itemId);
      if (item) {
        // Make sure to pass all required properties
        addToCart({
          item_id: item.item_id,
          item_name: item.item_name,
          image_path: item.image_path,
          price: parseFloat(item.price),
          quantity: 1
        });
        setToast({ show: true, message: '✅ Item added to cart!' });
      }
    } catch (error) {
      console.error('Error adding to cart:', error);
      setToast({ show: true, message: '❌ Error adding item. Please try again.' });
    } finally {
      setIsProcessing(false);
    }
  };

  return (
    <div className="menu-page">
      <section className="menu-section">
        <h1>Our Menu</h1>
        
        {menuItems.length > 0 ? (
          <div className="menu-container">
            {menuItems.map(item => (
              <MenuCard 
                key={item.item_id} 
                item={item} 
                onAddToCart={handleAddToCart}
                isProcessing={isProcessing}
              />
            ))}
          </div>
        ) : (
          <p>No menu items found.</p>
        )}
      </section>

      <Toast 
        show={toast.show} 
        message={toast.message} 
        onClose={() => setToast({ show: false, message: '' })} 
      />
    </div>
  );
};

export default Menu; 