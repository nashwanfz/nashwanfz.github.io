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
    <title>Games - Gaming Community</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <style>
        /* Additional Styles for the Games Page */

        .games-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .game-item {
            margin: 20px;
            text-align: center;
            width: 200px;
        }

        .game-item img {
            width: 100%;
            height: 150px; /* Ensures uniform height */
            object-fit: cover; /* Ensures the image scales nicely */
            border-radius: 10px;
        }

        .game-item h3 {
            margin-top: 10px;
            font-size: 1.2em;
        }

        .game-item p {
            margin-top: 5px;
            font-size: 1em;
        }

        /* Search Bar Styles */
        .search-container {
            margin: 20px;
            text-align: left;
        }

        .search-container input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1><a href="index.php" style="color: #fff; text-decoration: none;">Gaming Community</a></h1>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">About Me</a>
        <a href="reviews.php">Reviews</a>
        <a href="games.php" class="active">Games</a>
        <a href="contact.php">Contact</a>
    </div>

    <!-- Mobile Menu Button (Hamburger Menu) -->
    <div class="menu-button" onclick="toggleMenu()">☰ Menu</div>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="search-bar" placeholder="Search for games..." onkeyup="searchGames()">
    </div>

    <!-- Games Section -->
    <div id="games" class="section">
        <h2>Popular Games</h2>
        <div class="games-list" id="games-list">
            <div class="game-item" data-name="Valorant">
                <img src="Valorant.jpg" alt="Valorant">
                <h3>Valorant</h3>
                <p>A tactical shooter game developed by Riot Games.</p>
            </div>

            <div class="game-item" data-name="Mobile Legends">
                <img src="ML.jpg" alt="Mobile Legends">
                <h3>Mobile Legends</h3>
                <p>A popular multiplayer online battle arena (MOBA) game.</p>
            </div>

            <div class="game-item" data-name="Call of Duty">
                <img src="COD.jpg" alt="Call of Duty">
                <h3>Call of Duty</h3>
                <p>A first-person shooter series known for intense multiplayer action.</p>
            </div>

            <div class="game-item" data-name="League of Legends">
                <img src="LOL.jpeg" alt="League of Legends">
                <h3>League of Legends</h3>
                <p>A popular MOBA game developed by Riot Games.</p>
            </div>

            <div class="game-item" data-name="Fortnite">
                <img src="FR.jpg" alt="Fortnite">
                <h3>Fortnite</h3>
                <p>A battle royale game developed by Epic Games.</p>
            </div>

            <div class="game-item" data-name="Minecraft">
                <img src="MC.jpeg" alt="Minecraft">
                <h3>Minecraft</h3>
                <p>A sandbox game where players can build and explore virtual worlds.</p>
            </div>

            <div class="game-item" data-name="Tomb Raider">
                <img src="TR.jpg" alt="Tomb Raider">
                <h3>Tomb Raider</h3>
                <p>An action-adventure game that follows the adventures of Lara Croft.</p>
            </div>

            <div class="game-item" data-name="Apex Legends">
                <img src="Apex.jpg" alt="Apex Legends">
                <h3>Apex Legends</h3>
                <p>A free-to-play battle royale game developed by Respawn Entertainment.</p>
            </div>

            <div class="game-item" data-name="Assassin's Creed Valhalla">
                <img src="AssasinsCreed.jpg" alt="Assassin's Creed">
                <h3>Assassin's Creed Valhalla</h3>
                <p>A historical fiction action-adventure game series developed by Ubisoft.</p>
            </div>

            <div class="game-item" data-name="Genshin Impact">
                <img src="Genshin.jpg" alt="Genshin Impact">
                <h3>Genshin Impact</h3>
                <p>An open-world action RPG game developed by miHoYo.</p>
            </div>

            <div class="game-item" data-name="Cyberpunk 2077">
                <img src="Cyberpunk.jpg" alt="Cyberpunk 2077">
                <h3>Cyberpunk 2077</h3>
                <p>A dystopian action RPG game developed by CD Projekt Red.</p>
            </div>

            <div class="game-item" data-name="The Witcher 3">
                <img src="Witvher.jpg" alt="The Witcher 3">
                <h3>The Witcher 3</h3>
                <p>An action RPG set in a fantasy world, developed by CD Projekt Red.</p>
            </div>

            <div class="game-item" data-name="Overwatch">
                <img src="Overwatch.jpg" alt="Overwatch">
                <h3>Overwatch</h3>
                <p>A team-based multiplayer first-person shooter developed by Blizzard Entertainment.</p>
            </div>

            <div class="game-item" data-name="Destiny 2">
                <img src="Destiny.jpg" alt="Destiny 2">
                <h3>Destiny 2</h3>
                <p>A multiplayer first-person shooter with RPG elements developed by Bungie.</p>
            </div>
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

        // Search Functionality
        function searchGames() {
            const searchInput = document.getElementById('search-bar').value.toLowerCase();
            const games = document.querySelectorAll('.game-item');

            games.forEach(game => {
                const gameName = game.getAttribute('data-name').toLowerCase();
                if (gameName.includes(searchInput)) {
                    game.style.display = "block";
                } else {
                    game.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>
