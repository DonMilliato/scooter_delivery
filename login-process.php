<?php
include 'config.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Fetch user
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();

  if (password_verify($password, $user['password'])) {
    // Login success
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['fullname'] = $user['fullname'];

    echo "<script>alert('Login successful!'); window.location='index.html';</script>";
  } else {
    echo "<script>alert('Invalid password.'); window.location='login.html';</script>";
  }
} else {
  echo "<script>alert('User not found.'); window.location='login.html';</script>";
}

$stmt->close();
$conn->close();
?>
