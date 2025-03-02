<?php
// Include necessary files
require_once "../../config/database.php";
require_once "../../models/User.php";

// Create a Database instance and get the connection
$database = new Database();
$conn = $database->getConnection();

// Create a User instance
$user = new User($conn);

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Attempt to delete the user
    if ($user->deleteUser($id)) {
        // Redirect to users_list.php with a success message
        header("Location: users_list.php?message=User+deleted+successfully");
        exit();
    } else {
        // Redirect to users_list.php with an error message
        header("Location: users_list.php?error=Failed+to+delete+user");
        exit();
    }
} else {
    // Redirect to users_list.php if no ID is provided
    header("Location: users_list.php?error=Invalid+request");
    exit();
}
?>