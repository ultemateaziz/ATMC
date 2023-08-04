<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $conn = new mysqli('localhost', 'root', '', 'atmc');

  // Check if the user is a teacher
  $stmt = $conn->prepare('SELECT id FROM users WHERE username = ? AND password = ? AND role = "teacher"');
  $stmt->bind_param('ss', $username, $password);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $_SESSION['role'] = 'teacher';
    $_SESSION['username'] = $username;
    header('Location: ../code/staff.html');
    exit;
  }

}

$error = 'Invalid username or password';
?>