<?php
include 'db_connect.php'; 

// Recover values from Submitted Form
$username = $_POST["username"];
$password = $_POST["password"];

// Write Select query
$sql = "SELECT username, password FROM ClientUsers";
// Run Select query
$result = $conn->query($sql);
// Get row
$row = $result->fetch_assoc()

if ($row["username"] == $username && $row["password"] == $password) {
    // Start Session and set the Session variables we need
    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["user_Id"] = $row["Id"];

    // add if Employee or if Client

    // Redirect to HomePage.html 
    header("Location: HomePage.html");
    die();
}
?>