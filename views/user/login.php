<!-- views/login.php -->
<form action="UserController.php?action=login" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    
    <button type="submit">Login</button>
</form>
<a href="forgotPassword.php">Forgot Password?</a>
<a href="register.php">Sign Up</a>
<?php
session_start();
require_once 'controllers/UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController = new UserController();
    $userController->login();  // Handle the login action
}
?>

<!-- Include the login form view -->
<?php include('views/login.php'); ?>
