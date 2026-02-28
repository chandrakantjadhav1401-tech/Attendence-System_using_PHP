<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
}


include 'db.php';

/* DELETE LOGIC (same file) */
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM attendance WHERE id = $delete_id AND teacher_id = ".$_SESSION['teacher_id']);
}

/* FETCH DATA */
$result = $conn->query("
    SELECT a.id, s.name, s.roll_number, a.date, a.status
    FROM attendance a
    JOIN students s ON a.student_id = s.id
    WHERE a.teacher_id = ".$_SESSION['teacher_id']
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Attendance Records</h1>

    <table>
        <tr>
            <th>Student Name</th>
            <th>Roll Number</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['roll_number']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="?delete_id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Are you sure you want to remove this record?');">
                   <button>Remove</button>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>
