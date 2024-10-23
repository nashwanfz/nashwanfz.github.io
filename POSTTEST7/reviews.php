<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in'])) {
    // If not, redirect to login page
    header('Location: login.php');
    exit;
}
?>

<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<p>This is a restricted page that only logged-in users can access.</p>
<a href="logout.php">Logout</a>

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
            background-color: #333; /* Background color for the entire table */
        }

        table, th, td {
            border: 1px solid #fff; /* White borders for table cells */
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #444; /* Darker background for header */
            color: #fff; /* White text for header */
        }

        tbody tr:nth-child(even) {
            background-color: #222; /* Darker color for even rows */
        }

        tbody tr:hover {
            background-color: #555; /* Highlight row on hover */
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #444;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer; /* Change cursor to pointer */
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
<body>
    <!-- Header -->
    <div class="header">
        <h1>Gaming Community</h1>
    </div>

    <!-- Main Content -->
    <div class="section">
        <h2>All User Reviews</h2>

        <!-- Add Review Button -->
        <button class="button" onclick="showReviewForm()">Add Review</button>

        <table>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>User</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reviewTableBody">
                <tr data-id="1">
                    <td>Valorant</td>
                    <td>Gamer123</td>
                    <td>Amazing tactical shooter with great mechanics and teamplay.</td>
                    <td>9/10</td>
                    <td><img src="path/to/logo1.png" alt="Game Logo" width="50"></td>
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
        <input type="hidden" id="reviewId">
        <input type="text" id="reviewerName" placeholder="Your Name" required>
        <input type="text" id="gameName" placeholder="Game Name" required>
        <textarea id="reviewText" placeholder="Your Review" rows="4" required></textarea>
        <input type="number" id="reviewRating" placeholder="Rating (1-10)" min="1" max="10" required>
        
        <!-- Change here: Replace logo URL input with file upload -->
        <input type="file" id="reviewLogo" accept="image/*" required>

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
            document.getElementById('reviewId').value = ''; // Clear ID
            document.getElementById('reviewerName').value = '';
            document.getElementById('gameName').value = '';
            document.getElementById('reviewText').value = '';
            document.getElementById('reviewRating').value = '';
            document.getElementById('reviewLogo').value = '';
        }

        function editReview(button) {
            const row = button.parentElement.parentElement;
            const game = row.children[0].innerText;
            const user = row.children[1].innerText;
            const review = row.children[2].innerText;
            const rating = row.children[3].innerText.split('/')[0]; // Get numeric rating
            const logo = row.children[4].children[0].src; // Get logo source

            // Set values in the form
            document.getElementById('reviewId').value = row.getAttribute('data-id'); // Use data-id as the ID
            document.getElementById('reviewerName').value = user;
            document.getElementById('gameName').value = game;
            document.getElementById('reviewText').value = review;
            document.getElementById('reviewRating').value = rating;
            document.getElementById('reviewLogo').value = logo;

            editMode = true; // Set edit mode
            showReviewForm(); // Show the form
        }

        function deleteReview(button) {
            const row = button.parentElement.parentElement;
            const id = row.getAttribute('data-id'); // Use data-id as the ID

            if (confirm("Are you sure you want to delete this review?")) {
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "submit_review.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                // Define what happens on successful data submission
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        row.remove(); // Remove the row from the table
                    } else {
                        alert("An error occurred. Please try again.");
                    }
                };

                // Send the request with the delete action
                xhr.send(`action=delete&id=${encodeURIComponent(id)}`);
            }
        }

        function submitReview() {
            const reviewerName = document.getElementById('reviewerName').value;
            const gameName = document.getElementById('gameName').value;
            const reviewText = document.getElementById('reviewText').value;
            const reviewRating = document.getElementById('reviewRating').value;
            const reviewLogo = document.getElementById('reviewLogo').files[0]; // Get the file from input
            const reviewId = document.getElementById('reviewId').value; // Get ID from the hidden input

            const formData = new FormData(); // Create FormData object
            formData.append('action', editMode ? 'edit' : 'add'); // Append action type
            formData.append('id', reviewId);
            formData.append('user', reviewerName);
            formData.append('game', gameName);
            formData.append('review', reviewText);
            formData.append('rating', reviewRating);
            if (reviewLogo) {
                formData.append('logo', reviewLogo); // Append file to FormData
            }

            // Create a new XMLHttpRequest object
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "submit_review.php", true);

            // Define what happens on successful data submission
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    if (editMode) {
                        updateTableRow(reviewId, reviewerName, gameName, reviewText, reviewRating, reviewLogo.name); // Update existing row
                    } else {
                        addTableRow(reviewerName, gameName, reviewText, reviewRating, reviewLogo.name); // Add new row
                    }
                    closeReviewForm(); // Close the form after submission
                } else {
                    alert("An error occurred. Please try again.");
                }
            };

            // Send the request with the form data
            xhr.send(formData); // Send FormData
        }

        function addTableRow(user, game, review, rating, logo) {
            const tableBody = document.getElementById('reviewTableBody');
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-id', 'new'); // Placeholder for new ID
            newRow.innerHTML = `<td>${game}</td>
                                <td>${user}</td>
                                <td>${review}</td>
                                <td>${rating}/10</td>
                                <td><img src="${logo}" alt="Game Logo" width="50"></td>
                                <td>
                                    <button class="button" onclick="editReview(this)">Edit</button>
                                    <button class="button" onclick="deleteReview(this)">Delete</button>
                                </td>`;
            tableBody.appendChild(newRow);
        }

        function updateTableRow(id, user, game, review, rating, logo) {
            const row = document.querySelector(`tr[data-id="${id}"]`);
            row.children[0].innerText = game;
            row.children[1].innerText = user;
            row.children[2].innerText = review;
            row.children[3].innerText = `${rating}/10`;
            row.children[4].children[0].src = logo;
        }
    </script>
</body>
</html>
