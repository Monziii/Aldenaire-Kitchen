# Aldenaire Kitchen

A modern, responsive restaurant website built with PHP, MySQL, and React.

## Features

- Dynamic menu with images and categories
- Customer reviews and ratings
- Shopping cart and order management
- Contact form
- Responsive design for all devices
- RESTful API (PHP backend)
- Modern React frontend

## Getting Started

### Prerequisites

- Node.js (v14+)
- npm
- PHP (v7.4+)
- MySQL
- XAMPP or MAMP (recommended for local development)

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/aldenaire/kitchen.git
   cd kitchen
   ```

````
2. **Install React dependencies:**
   ```sh
cd react-aldenaire
npm install
cd ..
````

3. **Set up the database:**

   - Import `aldenaire_db.sql` into your MySQL server (via phpMyAdmin or command line):
     ```sh
     mysql -u root < aldenaire_db.sql
     ```
   - Ensure your database credentials in `config.php` are correct.

4. **Start the servers:**

   - **PHP Backend:**
     ```sh
     php -S localhost:8000
     ```
   - **React Frontend:**
     ```sh
     cd react-aldenaire
     npm start
     ```

5. **Access the app:**
   - React Frontend: [http://localhost:3000](http://localhost:3000)
   - PHP Backend/API: [http://localhost:8000](http://localhost:8000)

## API Endpoints

- `/api/menu.php` - Get menu items
- `/api/reviews.php` - Get/add reviews
- `/api/contact.php` - Contact form
- `/api/orders.php` - Place orders

## Folder Structure

```
Final_project/
  ├── api/
  ├── assets/
  ├── css/
  ├── includes/
  ├── react-aldenaire/
  ├── ...
```

## Security

See [SECURITY.md](SECURITY.md) for security policy and best practices.

## License

MIT

## Contact

- Email: info@aldenairekitchen.com
- GitHub: https://github.com/aldenaire/kitchen
