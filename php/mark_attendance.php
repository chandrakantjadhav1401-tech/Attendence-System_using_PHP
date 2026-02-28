<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
}
include 'db.php';

$students = $conn->query("SELECT * FROM students");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];
    $date = date('Y-m-d');
    $teacher_id = $_SESSION['teacher_id'];

    $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status, teacher_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $student_id, $date, $status, $teacher_id);
    if ($stmt->execute()) {
        echo "<h3>Attendance marked.</h3>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Mark Attendance</h1>
        <form method="POST">
            <select name="student_id" required>
                <option value="">Select Student</option>
                <?php while ($row = $students->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name'] . ' (' . $row['roll_number'] . ')'; ?></option>
                <?php } ?>
            </select>
            <select name="status" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>
            <button type="submit">Mark Attendance</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>