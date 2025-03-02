// controllers/UserController.php
<?php
require_once '../../models/User.php';
require_once "../../config/database.php";

class UserController {
    public function showStatistics() {
        $userModel = new User();
        $totalUsers = $userModel->findAll();
        include '../../views/big_admin/statistics.php';
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $num = $_POST['num'];

            $userModel = new User();
            if ($userModel->register($name, $email, $password, $num)) {
                echo "Registration successful!";
            } else {
                echo "Error in registration!";
            }
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: dashboard.php"); // Redirect to a dashboard page
                exit();
            } else {
                echo "Invalid email or password!";
            }
        }
    }

    public function forgotPassword() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];

            $userModel = new User();
            $user = $userModel->forgotPassword($email);
            if ($user) {
                // You can implement password reset email functionality here
                echo "Password reset link has been sent to your email!";
            } else {
                echo "Email not found!";
            }
        }
    }
}
?>

