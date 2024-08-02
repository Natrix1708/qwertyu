<?php
// list_cv.php
session_start();
include 'db_config.php';

$sql = "SELECT * FROM resumes WHERE is_archived=0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of CVs</title>
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
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        select, button {
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
        <h1>List of CVs</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Category</th>
                <th>CV File</th>
                <th>Status</th>
                <th>Archive</th>
                <th>Employed</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['surname']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><a href="uploads/<?php echo $row['cv_file']; ?>" download><?php echo $row['cv_file']; ?></a></td>
                <td>
                    <form action="update_status.php" method="post">
                        <select name="status" onchange="this.form.submit()">
                            <option value="0" <?php if($row['status'] == 0) echo 'selected'; ?>>Stage 1</option>
                            <option value="1" <?php if($row['status'] == 1) echo 'selected'; ?>>Stage 2</option>
                            <option value="2" <?php if($row['status'] == 2) echo 'selected'; ?>>Stage 3</option>
                            <option value="3" <?php if($row['status'] == 3) echo 'selected'; ?>>Stage 4</option>
                            <option value="4" <?php if($row['status'] == 4) echo 'selected'; ?>>Stage 5</option>
                        </select>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </form>
                </td>
                <td>
                    <form action="archive_cv.php" method="post">
                        <button type="submit">Archive</button>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </form>
                </td>
                <td>
                    <form action="employ_cv.php" method="post">
                        <button type="submit">Employed</button>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>
