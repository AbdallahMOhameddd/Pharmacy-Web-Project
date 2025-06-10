<?php
include '../db.php';
$message = "";

// DELETE
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM products WHERE id = $id");
  $message = "✅ Product deleted.";
}

// Update
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];

  mysqli_query($conn, "UPDATE products SET name='$name', price='$price' WHERE id=$id");
  $message = "✅ Product updated.";
}

//Select All
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Admin Table</title>
  <a href="admin_zone.php">
  <button style="margin-top: 20px; padding: 10px 20px; background-color: #009688; color: white; border: none; border-radius: 5px; cursor: pointer;">
    ⬅️ Back to Admin Zone
  </button>
</a>

  <style>
    body {
        
      font-family: Arial, sans-serif;
background: url('../user/images/pharmacy bg.jpg');
      padding: 2rem;
    }

    h2 {
      text-align: center;
      color: #004d40;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1.5rem;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 0.8rem;
      text-align: center;
    }

    th {
      background-color: #009688;
      color: white;
    }

    img {
      width: 60px;
      height: 60px;
      object-fit: cover;
    }

    form input[type="text"], form input[type="number"] {
      width: 100px;
      padding: 5px;
    }

    .btn {
      padding: 6px 10px;
      border: none;
      border-radius: 4px;
      color: white;
      cursor: pointer;
    }

    .btn-update {
      background: #1976d2;
    }

    .btn-delete {
      background: #d32f2f;
    }

    .message {
      text-align: center;
      font-weight: bold;
      margin-bottom: 1rem;
      color: green;
    }
  </style>
</head>
<body>

<h2>📦 Product Admin Table</h2>

<?php if ($message): ?>
  <div class="message"><?= $message ?></div>
<?php endif; ?>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Image</th>
    <th>Delete</th>
    <th>Update</th>
  </tr>

  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <form method="POST">
        <td><?= $row['id'] ?><input type="hidden" name="id" value="<?= $row['id'] ?>"></td>
        <td><input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>"></td>
        <td><input type="number" name="price" step="0.01" value="<?= $row['price'] ?>"></td>
        <td><img src="/Pharmacy/<?= htmlspecialchars(str_replace('../../', '', $row['image'])) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
</td>
        <td>
          <a class="btn btn-delete" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
        </td>
        <td>
          <button type="submit" name="update" class="btn btn-update">Update</button>
        </td>
      </form>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
