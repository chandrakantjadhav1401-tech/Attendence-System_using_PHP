<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO teachers (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css"       href="..css/bootstrap.css">
</head>
<body>
    <div class="container">
      <h1>Teacher Registration</h1>
        <form method="POST" action="register.php">
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="email" name="email" placeholder="Email" required>
          <button type="submit">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>