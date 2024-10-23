<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Community</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1><a href="#home" style="color: #fff; text-decoration: none;">Gaming Community</a></h1>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About Me</a>
        <a href="reviews.php">Reviews</a> <!-- Updated this line -->
        <a href="Games.php">Games</a>
        <a href="#contact">Contact</a>
    </div>

    <!-- Mobile Menu Button (Hamburger Menu) -->
    <div class="menu-button" onclick="toggleMenu()">☰ Menu</div>

    <!-- Main Content -->
    <div id="home" class="section">
        <h2><a href="game-reviews.php" style="color: #fff; text-decoration: none;">Welcome to the Gaming Community</a></h2>
        <p>Find the latest game reviews, news, and tips!</p>
    </div>

    <!-- About Section with Pop-up -->
    <div id="about" class="section">
        <h2><a href="biodata.php" style="color: #fff; text-decoration: none;">About Me</a></h2>
        <p>This is where you add your personal details, background, and experiences related to gaming.</p>
        <button onclick="showPopup()">Show Details</button>
    </div>

    <!-- Pop-up -->
    <div id="popup" class="popup">
        <p>Here are more detailed personal information about you, like your experience, achievements, and more!</p>
        <button onclick="closePopup()">Close</button>
    </div>

    <div id="overlay" class="overlay"></div>

    <!-- Reviews Section -->
    <div id="reviews" class="section">
        <h2>Game Reviews</h2>
        <p>Detailed game reviews coming soon!</p>
    </div>

    <!-- Gaming News Section -->
    <div id="news" class="section">
        <h2>Latest Gaming News</h2>
        <p>Stay updated with the latest news in the gaming industry.</p>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="section">
        <h2>Contact Us</h2>
        <p>Feel free to reach out for collaborations or inquiries.</p>
    </div>

    <!-- Game Carousel Section -->
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

    <!-- Toggle Dark Mode Button -->
    <div class="dark-mode-toggle" onclick="toggleDarkMode()">🌙 Dark Mode</div>

    <script>
        // Toggle Mobile Menu (Hamburger Menu)
        function toggleMenu() {
            var menu = document.querySelector('.navbar');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }

        // Pop-up Functions
        function showPopup() {
            document.getElementById('popup').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        }

        function closePopup() {
            document.getElementById('popup').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }

        // Toggle Dark and Light Mode
        function toggleDarkMode() {
            var body = document.body;
            body.classList.toggle('dark-mode');
            body.classList.toggle('light-mode');
            if (body.classList.contains('dark-mode')) {
                document.querySelector('.dark-mode-toggle').innerText = "☀️ Light Mode";
            } else if (body.classList.contains('light-mode')) {
                document.querySelector('.dark-mode-toggle').innerText = "🌙 Dark Mode";
            } else {
                document.querySelector('.dark-mode-toggle').innerText = "🌙 Dark Mode";
            }
        }
    </script>
</body>
</html>