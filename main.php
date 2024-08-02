<?php
// main.php
session_start();
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
    <title>Main Page</title>
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
        }

        .grid-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 70%; /* Width of the grid container */
        }

        .grid-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease;
            width: calc(33.33% - 20px); /* Width of each grid item */
            margin-bottom: 20px; /* Space between rows */
        }

        .grid-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .grid-item a {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5); /* Background for better readability */
        }

        .grid-item:hover {
            transform: translateY(-5px);
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
                <li><a href="main.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contacts">CONTACTS</a></li>
            </ul>
        </nav>
    </header>
    <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    <div class="main-container">
        <div class="grid-container">
        <div class="grid-item">
                <img src="image 16.png" alt="Submit Resume">
                <a href="submit_resume.php">Submit Resume</a>
            </div>
            <div class="grid-item">
                <img src="image 15.png" alt="Add CV">
                <a href="add_cv.php">Add CV</a>
            </div>
            <div class="grid-item">
                <img src="image 14.png" alt="CVs List">
                <a href="list_cv.php">CVs List</a>
            </div>
            <div class="grid-item">
                <img src="image 13.png" alt="Archive">
                <a href="archive.php">Archive</a>
            </div>

            <div class="grid-item">
                <img src="image 12.png" alt="Statistics">
                <a href="statistics.php">Statistics</a>
            </div>   
            <div class="grid-item">
                <img src="image 17.png" alt="Manage Users">
                <a href="manage_users.php">Manage Users</a>
            </div>
            
        
        </div>
    </div>
</body>
</html>
