<?php
session_start();
require 'db_connection_login.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email']; // Optional

    // Check if the username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "Username already exists. Please choose another one.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "Registration successful. You can now <a href='login.php'>login</a>";
        } else {
            echo "Error occurred during registration.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Inline CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            background-color: #3c3c3c;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            font-size: 14px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="register.php" method="POST">
            <h2>Register</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email">
            
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <input type="submit" value="Register">
            
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>

