<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "", "users");

// Check for errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get values from the HTML form
$name = $_POST['name'];
$email = $_POST['email'];
$department = $_POST['department'];
$time = $_POST['time'];
$appointment_date = $_POST['appointment_date'];

// Insert data into MySQL table
$sql = "INSERT INTO appointments (name, email, department,time,appointment_date) VALUES ('$name', '$email', '$department', 'time','appointment_date')";

if (mysqli_query($conn, $sql)) {
    echo "Appointment Booked successfully!";
} else {
    echo "Failed Becaused of  " . $sql . "<br>" . mysqli_error($conn);
}

// Close MySQL connection
mysqli_close($conn);
?>
