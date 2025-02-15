<?php
require_once "../../models/User.php";
require_once "../../models/Course.php";
require_once "../../config/database.php";

$db = new Database();
$conn = $db->getConnection();

$user = new User($conn);
$course = new Course($conn);
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if ($action == 'deleteUser' && !empty($id)) {
    $user->id = $id;
    $user->deleteUser($id);
    header("Location: list.php");
    exit();
} elseif ($action == 'deleteCourse' && !empty($id)) {
    $course->id = $id;
    $course->deleteCourse($id);
    header("Location: list.php");
    exit();
}

?>
