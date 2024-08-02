<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $category = $_POST['category'];
    $cv_file = $_FILES['cv_file']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($cv_file);

    if (move_uploaded_file($_FILES['cv_file']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO resumes_temp (name, surname, category, cv_file) VALUES ('$name', '$surname', '$category', '$cv_file')";
        if ($conn->query($sql) === TRUE) {
            header("Location: submit_resume.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Resume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FAF3E0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 50px;
            background-color: transparent;
            position: fixed;
            top: 0;
            left: 0;
            width: 90%;
            z-index: 1000;
        }

        header .logo {
            height: 40px;
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


        .container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            background-color: #FFA45B;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        label {
            color: #fff;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #FF6F61;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #E55B50;
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
    <div class="container">
        <h1>Submit Your Resume</h1>
        <form action="send_cv.php" method="post" enctype="multipart/form-data">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="surname">Last Name:</label>
            <input type="text" id="surname" name="surname" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="vacancy">Vacancy:</label>
            <input type="text" id="сategory" name="category" required>

            <!-- <label for="comment">Comment:</label>
            <textarea id="comment" name="comment"></textarea> -->

            <label for="cv_file">Upload CV:</label>
            <input type="file" id="cv_file" name="cv_file" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
