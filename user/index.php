<?php
include '../db.php';

$products = [];
$result = mysqli_query($conn, "SELECT * FROM products");
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pharmacy E-Commerce</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .cart ul li button {
      margin-left: 10px;
      background-color: red;
      color: white;
      border: none;
      padding: 4px 8px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-brand">PharmaStore</div>
    <ul class="nav-links">
      <li><a href="#">Home</a></li>
      <li><a href="#products">Products</a></li>
      <li><a href="#cart">Cart</a></li>
      <li><a href="#checkout">Contact</a></li>
    </ul>
  </nav>

  <header>
    <h3>Welcome to Eru Online Pharmacy</h3>
  </header>

  <main>
    <!-- Search -->
    <section style="padding: 1rem 2rem;">
      <input type="text" id="search" placeholder="Search products..." oninput="filterProducts()" style="width:100%; padding:0.5rem;">
    </section>

    <!-- Products -->
    <section class="products" id="products">
      <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
          <div class="product">
            <img src="/Pharmacy/<?= htmlspecialchars(str_replace('../../', '', $product['image'])) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p><?= htmlspecialchars($product['description']) ?></p>
            <span>$<?= number_format($product['price'], 2) ?></span>
            <button onclick="addToCart('<?= addslashes($product['name']) ?>', <?= $product['price'] ?>)">Add to Cart</button>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No products available right now.</p>
      <?php endif; ?>
    </section>

    <p id="no-result" style="display:none; text-align:center; color:#999; margin-top:1rem;">
      ❌ No matching products found.
    </p>

    <!-- Cart -->
    <section class="cart" id="cart">
      <h2>Cart</h2>
      <ul id="cart-items"></ul>
      <strong>Total: $<span id="total">0.00</span></strong>
    </section>
  </main>

  <!-- Checkout -->
  <section class="checkout" id="checkout">
   <h2>Checkout</h2>
<form id="checkoutForm" action="submit_order.php" method="POST">

  <label>name:</label>
  <input type="text" name="name" /><br><br>

  <label>address:</label>
  <textarea name="address"></textarea><br><br>

  <label>الدفع:</label>
  <select name="payment">
    <option value="cash">cash</option>
    <option value="credit">credit</option>
  </select><br><br>

 <input type="hidden" name="total" id="totalInput"  />


  <button type="submit">Place Order</button>
</form>



  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Eru PharmaStore. All rights reserved.</p>
  </footer>

  <!-- ✅ JavaScript file linked -->
  <script src="script.js"></script>


</body>

</html>
