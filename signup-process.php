<?php
include 'config.php'; // connect to database

// Get form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// Check password match
if ($password !== $confirm) {
  die("Passwords do not match.");
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$sql = "INSERT INTO users (fullname, email, phone, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $email, $phone, $hashedPassword);

if ($stmt->execute()) {
  echo "<script>alert('Signup successful! You can now login.'); window.location='login.html';</script>";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
