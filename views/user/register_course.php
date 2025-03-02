<?php
session_start(); // Start the session to access user data

require_once "../../config/database.php";
require_once "../../models/Courses.php";

$db = new Database();
$conn = $db->getConnection();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or show an error
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID
$course_id = $_GET['id'] ?? ''; // Get the course ID from the URL

if (empty($course_id)) {
    // If no course ID is provided, show an error
    echo "Invalid course ID.";
    exit();
}

// Check if the user is already registered for this course
$check_query = "SELECT * FROM registrations WHERE user_id = :user_id AND course_id = :course_id";
$check_stmt = $conn->prepare($check_query);
$check_stmt->execute([
    ':user_id' => $user_id,
    ':course_id' => $course_id
]);

if ($check_stmt->rowCount() > 0) {
    // If the user is already registered, show a message
    echo "You are already registered for this course.";
    exit();
}

// Register the user for the course
$insert_query = "INSERT INTO registrations (user_id, course_id) VALUES (:user_id, :course_id)";
$insert_stmt = $conn->prepare($insert_query);

try {
    $insert_stmt->execute([
        ':user_id' => $user_id,
        ':course_id' => $course_id
    ]);

    // Redirect back to the course details page with a success message
    header("Location: course_details.php?id=$course_id&status=registered");
    exit();
} catch (PDOException $e) {
    // Handle any errors during registration
    echo "Registration failed: " . $e->getMessage();
    exit();
}
?>