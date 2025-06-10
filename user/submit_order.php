<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $payment = $_POST['payment'] ?? '';
    $total = $_POST['total'] ?? '0.00';


    error_log("Received: name=$name, address=$address, payment=$payment, total=$total");

    $stmt = $conn->prepare("INSERT INTO orders (full_name, address, payment_method, total) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $address, $payment, $total);

    if ($stmt->execute()) {
        echo "<script>alert('شكراً! تم تسجيل الطلب بنجاح.'); window.location.href = 'index.php';</script>";
    } else {
        echo "❌ DB Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>