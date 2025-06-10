<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require '../db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = $conn->real_escape_string($_POST['username_or_email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$input' OR email='$input'");
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: admin_zone.php");
            exit;
        } else {
            $message = "❌ Incorrect password.";
        }
    } else {
        $message = "❌ User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('../user/images/pharmacy bg.jpg');
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 350px;
    }
    h2 {
      text-align: center;
      color: #004d40;
    }
    label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }
    input {
      width: 100%;
      padding: 0.5rem;
      margin-top: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      width: 100%;
      margin-top: 1.5rem;
      background: #009688;
      color: white;
      border: none;
      padding: 0.7rem;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #00796b;
    }
    .message {
      margin-top: 1rem;
      color: red;
      text-align: center;
    }
    .signup-link {
      text-align: center;
      margin-top: 1.2rem;
    }
    .signup-link a {
      color: #009688;
      text-decoration: none;
      font-weight: bold;
    }
    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Admin Login</h2>
  <form method="POST">
    <label>Username or Email:</label>
    <input type="text" name="username_or_email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>

    <?php if (!empty($message)): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>
  </form>

  <div class="signup-link">
    Don't have an account? <a href="signup_admin.php">Sign up</a>
  </div>
</div>

</body>
</html>
