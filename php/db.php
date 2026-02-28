<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'attendance_db';

$conn = new mysqli($host, $user, $pass, $db);
/*the connect metod if the connection problem then throw the error */

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>