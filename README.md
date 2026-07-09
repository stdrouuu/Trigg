# Trigg - Full-Stack Game Store Web Application

Trigg is a premium game store web application. It features a fully responsive catalog, interactive shopping cart, favorites management, customer complaints section, checkout workflow, and a robust admin dashboard for store managers.

![Screenshot 2026-06-22 094235.png](https://github.com/user-attachments/assets/62ede58e-a361-46aa-a1b5-c615a856de2c)

---

### Public Features (Customer Interface)
1. **Catalog & Search:** Browse the premium game collection based on category/platform, complete with real-time search functionality.
2. **Interactive Shopping Cart:** Add, decrease, and remove items directly via a sidebar drawer cart without page reloads.
3. **Favorites (Wishlist):** Save your favorite games to purchase later.
4. **Checkout System:** A secure purchase flow with instant order summary.
5. **Interactive FAQ:** An interactive accordion Q&A page for quick assistance.
6. **Complaints Form:** Submit complaints or transaction issues directly to the administration team.

### Administrator Features (Admin Panel)
1. **Admin Dashboard:** Summary of product data, incoming orders, and customer complaints.
2. **Product CRUD:** Add, edit, and delete game product data directly with product image uploads.
3. **Order Status Management:** Update customer transaction status (*pending, processing, shipped, delivered*).
4. **Complaint Resolution:** Review customer complaint messages and mark them as resolved.

---

## Testing Credentials

### 1. Public Account (Customer)
* **URL:** `http://localhost/412024022_BRANDON_JEREMIAH/auth`
* **Username:** `brandon`
* **Password:** `1234`

### 2. Administrator Account
* **URL:** `http://localhost/412024022_BRANDON_JEREMIAH/admin`
* **Username:** `admin`
* **Password:** `admin123`

---

## Local Installation Guide

### Prerequisites
1. Local web server environment like **Laragon** (highly recommended).
2. PHP version 7.4 or higher.
3. MySQL Database.

### Setup Steps
1. **Clone/Copy Project:**
   Place the project folder `412024022_BRANDON_JEREMIAH` in your local server root directory:
   * **Laragon:** `C:\laragon\www\`

2. **Import Database:**
   * Open **phpMyAdmin** or your preferred database client (HeidiSQL/DBeaver).
   * Create a new database named `20222_wp2_412024022`.
   * Import the SQL file located inside the project: `config/20222_wp2_412024022.sql`.

3. **Connection Configuration:**
   Open the `config/db_conn.php` file and make sure it matches your local server credentials:
   ```php
   $servername = "127.0.0.1";
   $username = "root";
   $password = "";
   $dbname = "20222_wp2_412024022";
   ```

4. **Run Application:**
   Open your browser and access:
   * Public Web: `http://localhost/412024022_BRANDON_JEREMIAH/`
   * Admin Web: `http://localhost/412024022_BRANDON_JEREMIAH/admin`

---

## Main Directory Structure

```text
├── administrator/          # Administrator-specific files (Dashboard, Login Pages & Admin APIs)
│   ├── api/                # API handlers for admin (auth, orders, products)
│   └── pages/              # Admin page templates (dashboard, login)
├── api/                    # API handlers for public users (auth, cart, orders, etc.)
├── assets/                 # Application assets
│   ├── css/                # CSS Stylesheets (Navbar, Footer, Page modules)
│   ├── img/                # Product images & UI graphics
│   └── js/                 # JavaScript & jQuery AJAX logic
├── components/             # Global UI components (Navbar, Footer, Head)
├── config/                 # Database configuration & SQL migration scripts
├── pages/                  # Public page views (Home, Auth, Cart, Product, FAQ, etc.)
├── .htaccess               # URL rewriting & routing configuration
├── index.php               # Front controller & application router
└── README.md               # Project documentation
```
