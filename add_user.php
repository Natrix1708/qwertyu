<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $email = $_POST['new_email'];
    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (surname, name, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $surname, $name, $email, $password, $role);

    if ($stmt->execute()) {
        echo "New user added successfully";
        header("Location: user_list.php"); // Redirect to the user list after successful addition
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #FAF3E0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #666;
            font-size: 14px;
        }

        input, select, button {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            color: white;
            background-color: #FF6F61;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #E5564E;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #FF6F61;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add User</h1>
        <form action="add_user.php" method="post">
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="new_email">Email:</label>
            <input type="email" id="new_email" name="new_email" required>

            <label for="new_password">Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Add User</button>
        </form>
        <a href="user_list.php" class="back-link">View Users</a>
    </div>
</body>
</html>
