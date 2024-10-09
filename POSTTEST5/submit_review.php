<?php
include 'db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request
    $game = $_POST['game'];
    $user = $_POST['user'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO reviews (game, user, review, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $game, $user, $review, $rating);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New review added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?>
