<?php
// submit_resume.php
session_start();
include 'db_config.php';

$sql = "SELECT * FROM resumes_temp";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $category = $_POST['category'];
    $cv_file = $_POST['cv_file'];

    $sql_insert = "INSERT INTO resumes (name, surname, category, cv_file, is_archived) VALUES ('$name', '$surname', '$category', '$cv_file', 0)";
    if ($conn->query($sql_insert) === TRUE) {
        $sql_delete = "DELETE FROM resumes_temp WHERE id='$id'";
        $conn->query($sql_delete);
        header("Location: submit_resume.php");
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
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
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #FAF3E0;
            color: #fff;
        }

        .sidebar {
            width: 15%;
            background-color: #FAF3E0;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
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
            width: 85%;
            padding: 20px;
            overflow-y: auto;
            position: relative;
            margin-left: 10px;
            border-radius: 10px;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            color: #333;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px;
            font-size: 14px;
            color: #fff;
            background-color: #ff4c61;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #F8A455;
        }

        .divider {
            position: absolute;
            left: 15%;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #ff4c61;
        }

        .sidebar h1 {
            margin: 0;
            font-size: 24px;
            color: #ff4c61;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .content h1 {
            color: #000000;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="top">
        <div class="logo">
            <img src="Logo1.1.png" alt="HRMS Logo">
            <br><br>
        </div>
        <a href="main.php">HOME</a>
        <a href="add_cv.php">ADD CV</a>
        <a href="list_cv.php">CVs LIST</a>
        <a href="archive.php">ARCHIVE</a>
        <a href="statistics.php">STATISTICS</a>
    </div>
    <br><br><br><br><br><br><br><br><br>
    <div class="bottom">
        <a href="about.php">ABOUT</a>
        <a href="faq.php">FAQ</a>
        <a href="contacts.php">CONTACTS</a>
    </div>
</div>
<div class="divider"></div>
<div class="content">
    <div class="container">
        <h1>Submit Resume</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Category</th>
                <th>CV File</th>
                <th>Add to CV List</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['surname']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><a href="uploads/<?php echo htmlspecialchars($row['cv_file']); ?>" download><?php echo htmlspecialchars($row['cv_file']); ?></a></td>
                <td>
                    <form action="submit_resume.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                        <input type="hidden" name="surname" value="<?php echo htmlspecialchars($row['surname']); ?>">
                        <input type="hidden" name="category" value="<?php echo htmlspecialchars($row['category']); ?>">
                        <input type="hidden" name="cv_file" value="<?php echo htmlspecialchars($row['cv_file']); ?>">
                        <button type="submit">Add CV</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>
