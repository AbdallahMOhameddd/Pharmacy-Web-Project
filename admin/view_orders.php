<?php
include '../db.php';


$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Receipt</title>
  <a href="admin_zone.php">
  <button style="margin-top: 20px; padding: 10px 20px; background-color: #009688; color: white; border: none; border-radius: 5px; cursor: pointer;">
    ⬅️ Back to Admin Zone
  </button>
</a>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: url('../user/images/pharmacy bg.jpg');
      padding: 2rem;
      color: #333;
    }

    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #00796b;
    }

    table {
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th {
      background-color: #00796b;
      color: white;
      padding: 12px;
      font-size: 1rem;
      border: 1px solid #e0e0e0;
    }

    td {
      padding: 12px;
      border: 1px solid #e0e0e0;
      text-align: center;
      font-size: 0.95rem;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #e0f2f1;
    }

    .no-orders {
      text-align: center;
      margin-top: 2rem;
      font-style: italic;
      color: #999;
    }
  </style>
</head>
<body>

<h2>🧾 Customer Order Receipts</h2>

<?php
if ($result->num_rows > 0) {
  echo "<table>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Payment</th>
            <th>Total</th>
            <th>Date</th>
          </tr>";

  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['id']}</td>
      <td>" . htmlspecialchars($row['full_name']) . "</td>
      <td>" . nl2br(htmlspecialchars($row['address'])) . "</td>
      <td>{$row['payment_method']}</td>
      <td>$" . number_format($row['total'], 2) . "</td>
      <td>{$row['created_at']}</td>
    </tr>";
  }

  echo "</table>";
} else {
  echo "<p class='no-orders'>No orders found.</p>";
}
$conn->close();
?>


</body>
</html>
