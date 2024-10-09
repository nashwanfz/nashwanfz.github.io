<?php
// Database configuration
$host = 'localhost';  // Your database host
$dbName = 'reviews';  // Database name
$username = 'root';   // Database username (default is usually 'root')
$password = '';       // Database password (default is usually empty)

// Create a connection
$conn = new mysqli($host, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
