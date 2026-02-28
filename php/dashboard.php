<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
}

//databse connection 
include 'db.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
<!--bootstrap file connection and css file connection -->

    <link rel="stylesheet" href="../css/style.css"     href="..css/bootstrap.css">
</head>
<body>
 <div class="container">
    <h1>Dashboard</h1>
     <div class="links">
      <a href="add_student.php">Add Student</a>
      <a href="mark_attendance.php">Mark Attendance</a>
      <a href="view_attendance.php">View Attendance</a>
      <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>