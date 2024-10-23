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
    <title>Biodata</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Biodata</h1>
    </div>

    <div class="section">
        <h2>Personal Information</h2>
        <p>Name: Nashwan Faiz Nandana Astaman</p>
        <p>NIM: 2309106125</p>
        <p>Kelas: C'2023</p>
        <p>Hobbies: Playing video games</p>
        <p>Skills: Sleeping for a very long time</p>
    </div>

    <div class="section">
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>
