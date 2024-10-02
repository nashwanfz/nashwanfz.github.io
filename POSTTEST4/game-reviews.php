<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Reviews</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1><a href="index.php" style="color: #fff; text-decoration: none;">Gaming Community</a></h1>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">About Me</a>
        <a href="game-reviews.php">Reviews</a>
        <a href="index.php#news">Gaming News</a>
        <a href="index.php#contact">Contact</a>
    </div>

    <!-- Main Content -->
    <div id="reviews" class="section">
        <h2>Game Reviews</h2>
        <p>Explore detailed reviews on the latest games!</p>
        
        <!-- Existing Review -->
        <div class="review-item">
            <h3>Review 1: Valorant</h3>
            <img src="Valorant.jpg" alt="Valorant" class="carousel-image" width="150px" height="100px">
            <p></p>
        </div>
        
        <!-- New Reviews will be added here dynamically at the top -->
        <div id="new-reviews"></div>
    </div>

    <!-- Dark Mode Button -->
    <div class="dark-mode-toggle" onclick="toggleDarkMode()">🌙 Dark Mode</div>

    <div id="review-section" style="display:none;">
        <h3>Submit a Game Review</h3>
        <form id="gameReviewForm">
            <label for="username">Your Name:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="game">Game Title:</label>
            <input type="text" id="game" name="game" required><br>

            <label for="rating">Rating (1-10):</label>
            <input type="number" id="rating" name="rating" min="1" max="10" required><br>

            <button type="button" onclick="submitReview()">Submit Review</button>
        </form>
    </div>

    <div id="submittedReview"></div>

    

    <script>
        // Reuse the same JavaScript from the Home page
        function toggleDarkMode() {
            var body = document.body;
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                document.querySelector('.dark-mode-toggle').innerText = "☀️ Light Mode";
            } else {
                document.querySelector('.dark-mode-toggle').innerText = "🌙 Dark Mode";
            }
        }

        function showRegister() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        }

        function showLogin() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
        }

        function register() {
            var username = document.getElementById('register-username').value;
            var password = document.getElementById('register-password').value;

            if (localStorage.getItem(username)) {
                alert("Username already exists. Please choose a different username.");
            } else {
                localStorage.setItem(username, password);
                alert("Registration successful! Please login.");
                showLogin();
            }
        }

        function login() {
            var username = document.getElementById('login-username').value;
            var password = document.getElementById('login-password').value;

            var storedPassword = localStorage.getItem(username);

            if (storedPassword && storedPassword === password) {
                alert("Login successful!");
                document.getElementById('auth-section').style.display = 'none';
                document.getElementById('review-section').style.display = 'block';
                document.getElementById('username').value = username;
            } else {
                alert("Invalid username or password. Please try again.");
            }
        }

        function submitReview() {
            var username = document.getElementById('username').value;
            var game = document.getElementById('game').value;
            var rating = document.getElementById('rating').value;

            if (username === "" || game === "" || rating === "") {
                alert("Please fill in all fields.");
                return;
            }

            var newReview = document.createElement('div');
            newReview.classList.add('review-item');
            newReview.innerHTML = `<h3>Review: ${game}</h3>
                                   <p><strong>Posted by:</strong> ${username}</p>
                                   <p><strong>Rating:</strong> ${rating}/10</p>
                                   <p>This is a user-submitted review of ${game}.</p>`;

            var reviewsSection = document.getElementById('new-reviews');
            reviewsSection.insertBefore(newReview, reviewsSection.firstChild);

            document.getElementById('gameReviewForm').reset();
            alert("Review successfully submitted!");
        }
    </script>

<div class="carousel-container">
        <div class="carousel">
            <img src="Valorant.jpg" alt="Game 1">
            <img src="ML.jpg" alt="Game 2">
            <img src="COD.jpg" alt="Game 3">
            <img src="LOL.jpeg" alt="Game 4">
            <img src="FR.jpg" alt="Game 5">
            <img src="MC.jpeg" alt="Game 6">
            <img src="TR.jpg" alt="Game 7">
        </div>
    </div>
</body>
</html>
