<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Zone</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    background: url('../user/images/pharmacy bg.jpg');
    }

    .navbar {
      background-color: #009688;
      overflow: hidden;
      display: flex;
      justify-content: center;
      padding: 1rem 0;
    }

    .navbar a {
      color: white;
      padding: 14px 20px;
      text-decoration: none;
      text-align: center;
      font-weight: bold;
      transition: background 0.3s;
    }

    .navbar a:hover {
      background-color: #00796b;
    }

    .content {
      padding: 2rem;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <a href="addProduct.php">➕ Add Product</a>
    <a href="view_orders.php">📦 View Orders</a>
    <a href="viewProduct.php">🛍️ View Products</a>
    <a href="login_admin.php">🔐 Admin Login</a>
  </div>

  <div class="content">
    <h1>Welcome to Admin Zone</h1>
    <p>Please choose a section from the navigation bar above.</p>
  </div>

</body>
</html>
