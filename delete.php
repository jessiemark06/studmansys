<?php
include("dbconnect.php");

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    
    $sql = "DELETE FROM stud_table WHERE stud_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $student_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid student ID";
    exit;
}

mysqli_close($con);
?>
