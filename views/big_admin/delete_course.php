<?php
// Include necessary files
require_once "../../config/database.php";
require_once "../../models/Courses.php";

// Create a Database instance and get the connection
$database = new Database();
$conn = $database->getConnection();

// Create a User instance
$user = new Course($conn);

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Attempt to delete the user
    if ($user->deleteCourse($id)) {
        // Redirect to users_list.php with a success message
        header("Location: courses_list.php?message=course+deleted+successfully");
        exit();
    } else {
        // Redirect to users_list.php with an error message
        header("Location: courses_list.php?error=Failed+to+delete+course");
        exit();
    }
} else {
    // Redirect to users_list.php if no ID is provided
    header("Location: courses_list.php?error=Invalid+request");
    exit();
}
?>