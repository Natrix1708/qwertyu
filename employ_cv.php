<?php
// employ_cv.php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Get the resume details
    $sql = "SELECT * FROM resumes WHERE id=$id";
    $result = $conn->query($sql);
    $resume = $result->fetch_assoc();

    // Insert into manage_users table (assuming the table structure is known)
    $name = $resume['name'];
    $surname = $resume['surname'];
    $category = $resume['category'];
    $cv_file = $resume['cv_file'];

    $insert_sql = "INSERT INTO manage_users (name, surname, category, cv_file) VALUES ('$name', '$surname', '$category', '$cv_file')";
    if ($conn->query($insert_sql) === TRUE) {
        // Optionally, you can delete the resume from resumes table or set it as archived
        $delete_sql = "DELETE FROM resumes WHERE id=$id";
        $conn->query($delete_sql);

        header("Location: manage_users.php");
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}
?>
