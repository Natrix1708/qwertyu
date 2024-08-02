<?php
// restore_cv.php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "UPDATE resumes SET is_archived=0 WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: archive.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
