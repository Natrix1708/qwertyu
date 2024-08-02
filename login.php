<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $user['role'];
        
        if ($user['role'] == 'admin') {
            header("Location: admin_main.php");
        } else {
            header("Location: main.php");
        }
    } else {
        echo "<script>alert('Неверный логин или пароль'); window.location.href='index.html';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-image: url('bg1.png');
            background-size: cover; /* Cover the entire screen */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Prevent repetition */
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

        .login-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            height: 100vh;
            padding-left: 100px;

        }

        .login-box {
            background-color: #FF4C61;
            padding: 40px;
            border-radius: 20px;
            width: 300px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #fff;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #fff;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .login-box button {
            background-color: #fff;
            color: #FF4C61;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-box button:hover {
            background-color: #FF4C61;
            color: #fff;
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
                <li><a href="#home">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contacts">CONTACTS</a></li>
            </ul>
        </nav>
    </header>
    <div class="login-container">
        <div class="login-box">
            <h2>Sign in</h2>
            <form action="" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>
