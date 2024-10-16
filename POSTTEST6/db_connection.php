<?php
$servername = "127.0.0.1"; // Change if your database server is different
$username = "root"; // Your MySQL username
$password = "111105"; // Your MySQL password
$dbname = "Reviewsz"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
