<?php
include "../db.php";
$message = "";

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];


    $img = str_replace(' ', '_', $_FILES['img']['name']);

    
    $target_dir = "../../user/images/";

    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imgPath = $target_dir . $img;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $imgPath)) {
        $sql = "INSERT INTO products (name, price, description, image)
                VALUES ('$name', '$price', '$description', '$imgPath')";
        $run_insert = mysqli_query($conn, $sql);

        if ($run_insert) {
            $message = "<span style='color:green;'>✅ Product added successfully!</span>";
        } else {
            $message = "<span style='color:red;'>❌ Error saving to database.</span>";
        }
    } else {
        $message = "<span style='color:red;'>❌ Failed to upload image.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    background: url('../user/images/pharmacy bg.jpg');
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 450px;
    }

    h2 {
      text-align: center;
      color: #004d40;
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      margin-bottom: 0.4rem;
      font-weight: bold;
      color: #333;
    }

    input, textarea {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    textarea {
      resize: vertical;
    }

    button {
      width: 100%;
      padding: 0.75rem;
      background: #00796b;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #004d40;
    }

    .message {
      text-align: center;
      margin-top: 1rem;
      font-weight: bold;
    }

    .preview {
      display: block;
      margin: 0 auto 1rem auto;
      max-width: 100%;
      max-height: 200px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Product Name:</label>
      <input type="text" name="name" required>

      <label>Price:</label>
      <input type="number" name="price" step="0.01" required>

      <label>Description:</label>
      <textarea name="description" rows="4" required></textarea>

      <label>Image:</label>
      <input type="file" name="img" id="imgInput" accept="image/*" required>

      <img id="preview" class="preview" src="#" alt="Image preview" style="display:none;"/>

      <button type="submit" name="add">Add Product</button>
    </form>

    <?php if (!empty($message)): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>
  </div>

  <script>
    const imgInput = document.getElementById('imgInput');
    const preview = document.getElementById('preview');

    imgInput.onchange = evt => {
      const [file] = imgInput.files;
      if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
      }
    };
  </script>
</body>
</html>
