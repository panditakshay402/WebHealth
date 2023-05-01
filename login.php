<?php
// Start a session
session_start();

// Connect to the MySQL database
$conn = mysqli_connect("localhost", "root", "", "users");

// Check the connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the form data
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);

// Retrieve the matching user data from the database
$sql = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

// Check if the user credentials are valid
if (mysqli_num_rows($result) == 1) {
// Set the session variable
$_SESSION["email"] = $email;


// Redirect the user to the index.html page
header("Location: index.html");
} else {
// Display an error message
echo "Invalid username or password";
}

// Close the database connection
mysqli_close($conn);
?>
