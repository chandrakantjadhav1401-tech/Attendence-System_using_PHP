<?php
//session a gobal variable..


session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
}

//database connection 
include 'db.php';

/* server is supergobal variable  useful information about the web server as described as in the next section */  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
$name = $_POST['name'];
$roll_number = $_POST['roll_number'];
$class = $_POST['class'];

/*the prepare statement is use to get the data from the user */

$stmt = $conn->prepare("INSERT INTO students (name, roll_number, class) VALUES (?, ?, ?)");

/*send the data actual values to the server */

$stmt->bind_param("sss", $name, $roll_number, $class);
    if ($stmt->execute()) {
        echo "<h3> Student added successfully  </h3>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="../css/style.css"  href="..css/bootstrap.css">

<style>
h3{
border:1px solid red;
 matgin-buttom:20px;
color:red;
}

</style>
</head>
<body>
	<!-- bootstrap class in container -->

    <div class="container">
        <h1>Add Student</h1>


        <form method="POST" action="add_student.php">
        
	    <input type="text"  name="name"        placeholder="Student Name"  required>
            <input type="text"  name="roll_number" placeholder="Roll Number"   required>
            <input type="text"  name="class"       placeholder="Class"         required>
            
	<!--button -->

	
	<button type="submit">Add Student</button>
        </form>

        <a href="dashboard.php">Back to Dashboard</a>

    </div>


    <script src="../js/script.js"></script>

</body>
</html>