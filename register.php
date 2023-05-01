<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Check for duplicate username or email
    $stmt = mysqli_prepare($conn, "SELECT * FROM signup WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        echo "Error: Duplicate username or email.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO signup (username, password, email) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "Registration successful!";
        header("Location: login.html");
        exit();
    }
}

mysqli_close($conn);
?>
