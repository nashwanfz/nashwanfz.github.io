<?php
include 'db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the action from the POST request
    $action = $_POST['action'];

    // Prepare and bind based on action
    if ($action === 'add') {
        // Get the data for adding a review
        $game = $_POST['game'];
        $user = $_POST['user'];
        $review = $_POST['review'];
        $rating = $_POST['rating'];

        // Prepare the insert statement
        $stmt = $conn->prepare("INSERT INTO reviews (game, user, review, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $game, $user, $review, $rating);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New review added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    } elseif ($action === 'edit') {
        // Get the data for editing a review
        $id = $_POST['id']; // Assuming you have an ID column in your database for the reviews
        $game = $_POST['game'];
        $user = $_POST['user'];
        $review = $_POST['review'];
        $rating = $_POST['rating'];

        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE reviews SET game=?, user=?, review=?, rating=? WHERE id=?");
        $stmt->bind_param("ssdsi", $game, $user, $review, $rating, $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Review updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    } elseif ($action === 'delete') {
        // Get the ID for the review to delete
        $id = $_POST['id'];

        // Prepare the delete statement
        $stmt = $conn->prepare("DELETE FROM reviews WHERE id=?");
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Review deleted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Game Reviews</title>
    <link rel="stylesheet" href="style.css">
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            text-align: center;
        }

        .header {
            padding: 20px;
            background-color: #333;
        }

        h1, h2 {
            margin: 0;
            padding: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #333;
        }

        table, th, td {
            border: 1px solid #fff;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #444;
        }

        tbody tr:nth-child(even) {
            background-color: #222;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #444;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #555;
        }

        /* Popup Overlay */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        /* Register Popup */
        .popup {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: left;
        }

        .popup h2 {
            margin-top: 0;
        }

        .popup input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        .popup button {
            background-color: #555;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #666;
        }

        /* Review Form */
        #reviewForm {
            display: none;
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            max-width: 400px;
        }

        #reviewForm input, #reviewForm textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        #reviewForm button {
            background-color: #555;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        #reviewForm button:hover {
            background-color: #666;
        }
    </style>
</head>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Gaming Community</h1>
    </div>

    <!-- Main Content -->
    <div class="section">
        <h2>All User Reviews</h2>

        <!-- Add Review Button -->
        <button class="button" onclick="showReviewForm()">Add Review</button> <!-- New Button to Show Review Form -->

        <table>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>User</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Actions</th> <!-- Added Actions Column -->
                </tr>
            </thead>
            <tbody id="reviewTableBody">
                <!-- Example Static Data: This can be replaced with dynamic data fetched from the database -->
                <tr data-id="1">
                    <td>Valorant</td>
                    <td>Gamer123</td>
                    <td>Amazing tactical shooter with great mechanics and teamplay.</td>
                    <td>9/10</td>
                    <td>
                        <button class="button" onclick="editReview(this)">Edit</button>
                        <button class="button" onclick="deleteReview(this)">Delete</button>
                    </td>
                </tr>
                <!-- Add more static rows as needed -->
            </tbody>
        </table>
    </div>

    <div class="section">
        <a href="index.php" class="button">Back to Home</a>
    </div>

    <!-- Review Form -->
    <div id="reviewForm">
        <h2>Submit Your Review</h2>
        <input type="hidden" id="reviewId"> <!-- Hidden input for review ID -->
        <input type="text" id="reviewerName" placeholder="Your Name" required>
        <input type="text" id="gameName" placeholder="Game Name" required>
        <textarea id="reviewText" placeholder="Your Review" rows="4" required></textarea>
        <input type="number" id="reviewRating" placeholder="Rating (1-10)" min="1" max="10" required>
        <button onclick="submitReview()">Submit Review</button>
        <button onclick="closeReviewForm()">Cancel</button>
    </div>

    <script>
        let editMode = false; // Track if we are in edit mode

        function showReviewForm() {
            document.getElementById('reviewForm').style.display = 'block';
            editMode = false; // Reset edit mode
            clearForm(); // Clear the form fields
        }

        function closeReviewForm() {
            document.getElementById('reviewForm').style.display = 'none';
        }

        function clearForm() {
            document.getElementById('reviewId').value = ''; // Clear the ID
            document.getElementById('reviewerName').value = '';
            document.getElementById('gameName').value = '';
            document.getElementById('reviewText').value = '';
            document.getElementById('reviewRating').value = '';
        }

        function submitReview() {
            const reviewerName = document.getElementById('reviewerName').value;
            const gameName = document.getElementById('gameName').value;
            const reviewText = document.getElementById('reviewText').value;
            const reviewRating = document.getElementById('reviewRating').value;
            const reviewId = document.getElementById('reviewId').value; // Get the review ID

            // Determine action (add or edit)
            const action = editMode ? 'edit' : 'add';

            // Create a new XMLHttpRequest object
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "submit_review.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Define what happens on successful data submission
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    closeReviewForm();

                    if (action === 'add') {
                        // Append the new review to the table
                        const newRow = document.createElement('tr');
                        newRow.setAttribute('data-id', Math.random()); // Generate a random ID for now (or retrieve the actual ID from the DB)
                        newRow.innerHTML = `
                            <td>${gameName}</td>
                            <td>${reviewerName}</td>
                            <td>${reviewText}</td>
                            <td>${reviewRating}/10</td>
                            <td>
                                <button class="button" onclick="editReview(this)">Edit</button>
                                <button class="button" onclick="deleteReview(this)">Delete</button>
                            </td>
                        `;
                        document.getElementById('reviewTableBody').appendChild(newRow);
                    } else {
                        // Update the existing review in the table
                        const row = document.querySelector(`tr[data-id='${reviewId}']`);
                        if (row) {
                            row.children[0].innerText = gameName;
                            row.children[1].innerText = reviewerName;
                            row.children[2].innerText = reviewText;
                            row.children[3].innerText = `${reviewRating}/10`;
                        }
                    }
                } else {
                    alert("An error occurred. Please try again.");
                }
            };

            // Send the request with data
            xhr.send(`action=${action}&id=${encodeURIComponent(reviewId)}&game=${encodeURIComponent(gameName)}&user=${encodeURIComponent(reviewerName)}&review=${encodeURIComponent(reviewText)}&rating=${encodeURIComponent(reviewRating)}`);
        }

        function editReview(button) {
            const row = button.closest('tr');
            const game = row.cells[0].innerText;
            const user = row.cells[1].innerText;
            const review = row.cells[2].innerText;
            const rating = row.cells[3].innerText.split('/')[0]; // Extract the rating

            document.getElementById('reviewId').value = row.getAttribute('data-id'); // Get the ID of the review
            document.getElementById('reviewerName').value = user;
            document.getElementById('gameName').value = game;
            document.getElementById('reviewText').value = review;
            document.getElementById('reviewRating').value = rating;

            editMode = true; // Set edit mode
            showReviewForm(); // Show the form
        }

        function deleteReview(button) {
            if (confirm("Are you sure you want to delete this review?")) {
                const row = button.closest('tr');
                const reviewId = row.getAttribute('data-id');

                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "submit_review.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                // Define what happens on successful data submission
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        // Remove the row from the table
                        row.remove();
                    } else {
                        alert("An error occurred. Please try again.");
                    }
                };

                // Send the request with data
                xhr.send(`action=delete&id=${encodeURIComponent(reviewId)}`);
            }
        }
    </script>
</body>
</html>