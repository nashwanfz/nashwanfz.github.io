<?php
// Database connection
$host = 'localhost'; // Change if needed
$db = 'Reviewsz'; // Your database name
$user = 'your_username'; // Your database username
$pass = 'your_password'; // Your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add' || $action === 'edit') {
        // Get review details
        $user = $conn->real_escape_string($_POST['user']);
        $game = $conn->real_escape_string($_POST['game']);
        $review = $conn->real_escape_string($_POST['review']);
        $rating = (int)$_POST['rating'];
        $logoPath = ''; // Initialize logo path

        // Handle file upload
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $logoTmpPath = $_FILES['logo']['tmp_name'];
            $logoName = basename($_FILES['logo']['name']);
            $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
            $logoPath = $uploadDir . $logoName;

            // Move the uploaded file to the designated folder
            if (!move_uploaded_file($logoTmpPath, $logoPath)) {
                echo "Error uploading logo.";
                exit;
            }
        }

        if ($action === 'add') {
            // Insert new review
            $sql = "INSERT INTO reviewsz (User, Game, Review, Rating, logo_game) VALUES ('$user', '$game', '$review', '$rating', '$logoPath')";

            if ($conn->query($sql) === TRUE) {
                echo "New review added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($action === 'edit') {
            $id = (int)$_POST['id']; // Get the ID for editing
            // Update existing review
            $sql = "UPDATE reviewsz SET User='$user', Game='$game', Review='$review', Rating='$rating', logo_game='$logoPath' WHERE ID_User='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Review updated successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } elseif ($action === 'delete') {
        $id = (int)$_POST['id']; // Get the ID for deletion
        // Delete review
        $sql = "DELETE FROM reviewsz WHERE ID_User='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Review deleted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
}
?>
