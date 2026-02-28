<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, password FROM teachers WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {

  $row = $result->fetch_assoc();

  if (password_verify($password, $row['password'])) {
      $_SESSION['teacher_id'] = $row['id'];
      header("Location: dashboard.php");
       }

 
else {
      echo "Invalid password.";
     }
  } 
    
	else {
        echo "User not found.";
    }

}
?>




<!DOCTYPE html>
<html>
<head>

    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css"     href="..css/bootstrap.css">

</head>
<body>
    <div class="container">
        <h1>Teacher Login</h1>

<form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
</form>

<a href="register.php">Register</a>

    </div>

    <script src="../js/script.js"></script>
</body>
</html>