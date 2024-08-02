<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #FAF3E0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: transparent;
            position: fixed;
            top: 0;
            left: 0;
            width: 90%;
            z-index: 1000;
        }

        header .logo {
            height: 50px;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        header nav ul li {
            margin-left: 20px;
        }

        header nav ul li a {
            color: #000;
            text-decoration: none;
            font-size: 16px;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }

        .container button {
            background-color: #FF6F61;
            color: white;
            border: none;
            padding: 30px 60px;
            font-size: 1.5em;
            cursor: pointer;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            margin: 20px 0;
            width: 300px; /* Ширина кнопки */
        }

        .container button:hover {
            background-color: #E5564E;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Logo1.1.png" alt="HRMS Logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="about_us.php">ABOUT</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contacts">CONTACTS</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-container">
        <div class="container">
            <button onclick="location.href='add_user.php'">Add USER</button><br>
            <button onclick="location.href='user_list.php'">USERS LIST</button>
        </div>
    </div>
</body>
</html>
