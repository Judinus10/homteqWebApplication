
# homteq - Smart Home Tech Retail Web App

homteq is a database-driven web application developed for server-side web development coursework. It allows customers to browse and purchase smart tech products and lets administrators manage products and orders.

## Features

### For Customers
- Browse available smart tech products
- View product details
- Add items to basket
- Register and log in
- Place orders and view basket

### For Administrators
- Log in as staff
- Add/edit/delete products
- View orders and update status (Placed, Ready to Ship, Shipped)
- Automatic shipping date calculation

## Technologies Used
- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Database**: MySQL (via phpMyAdmin/XAMPP)

## How to Run
1. Clone or download the project into your XAMPP `htdocs` directory.
2. Start Apache and MySQL in XAMPP.
3. Import the `homteq` database using phpMyAdmin.
4. Open `http://localhost/homteq/index.php` in your browser.

## Folder Structure
```

homteq/
├──assets/
├── aboutus.php
├── basket.php
├── bgimg.php
├── checkout.php
├── clearbasket.php
├── db.php
├── detectlogic.php
├── headfile.html
├── footfile.html
├── home.html
├── home.php
├── index.php
├── login_action.php
├── login_process.php
├── login.php
├── logout.php
└── mystylesheet.css
├── order_line.sql
├── orders.sql
├── prodbuy.php
├── product.sql
├── README.md
├── signup_process.php
├── signup.php
├── template.php
├── users.sql

```

