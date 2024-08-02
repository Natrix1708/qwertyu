<?php
// add_cv.php
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
        $sql = "INSERT INTO resumes (name, surname, category, cv_file, is_archived) VALUES ('$name', '$surname', '$category', '$cv_file', 0)";
        if ($conn->query($sql) === TRUE) {
            echo "New CV added successfully";
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
    <title>Add CV</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #FAF3E0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: transparent;
        }

        header .logo {
            height: 50px;
        }


        .sidebar {
            width: 15%;
            background-color: #FAF3E0;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Changed to flex-start to align items at the top */
            align-items: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .sidebar .top, .sidebar .bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar a {
            color: #000000;
            text-decoration: none;
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }

        .sidebar a:hover {
            background-color: #F8A455;
        }

        .content {
            width: 65%;
            padding: 20px;
            overflow-y: auto;
            position: center;
            background-color: #FFFFFF; /* Updated background color */
            margin-left: 10px;
            border-radius: 10px;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            margin-top: 20px; /* Adjusted margin to lower the form */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #333;
            font-size: 12.5px;
        }

        input, button {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            color: white;
            background-color: #ff4c61; /* Updated button color */
            cursor: pointer;
        }

        button:hover {
            background-color: #F8A455; /* Updated hover color */
        }

        .divider {
            position: absolute;
            left: 15%;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #ff4c61; /* Updated divider color */
        }

        .sidebar h1 {
            margin: 0;
            font-size: 24px;
            color: #ff4c61; /* Updated color */
            margin-bottom: 20px; /* Added margin to separate from links */
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="top">
        <div class="logo">
            <img src="Logo1.1.png" alt="HRMS Logo">
            <br>
            <br>
        </div>
        <a href="main.php">HOME</a>
        <a href="add_cv.php">ADD CV</a>
        <a href="list_cv.php">CVs LIST</a>
        <a href="archive.php">ARCHIVE</a>
        <a href="statistics.php">STATISTICS</a>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <br>
    <div class="bottom">
        <a href="about.php">ABOUT</a>
        <a href="faq.php">FAQ</a>
        <a href="contacts.php">CONTACTS</a>
    </div>
</div>
<div class="divider"></div>
<div class="content">
    <div class="container">
        <h1>Add CV</h1>
        <form action="add_cv.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required>
            
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
            
            <label for="cv_file">CV File:</label>
            <input type="file" id="cv_file" name="cv_file" required>
            
            <button type="submit">Add CV</button>
        </form>
    </div>
</div>
</body>
</html>
