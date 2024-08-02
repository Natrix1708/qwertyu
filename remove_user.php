<?php
// remove_user.php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Delete the user from the manage_users table
    $delete_sql = "DELETE FROM manage_users WHERE id=$id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: manage_users.php");
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
}
?>
