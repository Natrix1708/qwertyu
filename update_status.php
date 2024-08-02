<?php
// update_status.php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE resumes SET status='$status' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: list_cv.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
