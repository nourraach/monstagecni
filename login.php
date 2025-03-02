<?php
session_start();
include 'config/database.php';
include 'send_email.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // Generate a 6-digit OTP
            $otp = rand(100000, 999999);
            $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP valid for 10 minutes

            // Update OTP in the database
            $sql = "UPDATE users SET otp = '$otp', otp_expiry = '$otp_expiry' WHERE id = " . $user['id'];
            if (mysqli_query($conn, $sql)) {
                // Store user data in session for OTP verification
                $_SESSION['temp_user'] = [
                    'id' => $user['id'],
                    'otp' => $otp,
                    'email' => $email
                ];

                // Send OTP via email
                $subject = "Your OTP Code";
                $body = "Your OTP code is: <b>$otp</b>. It will expire in 10 minutes.";
                if (sendEmail($email, $subject, $body)) {
                    header("Location: otp_verification.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to send OTP. Please try again.";
                    header("Location: registration.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Failed to generate OTP. Please try again.";
                header("Location: registration.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: registration.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found.";
        header("Location: registration.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Login</h2>
            <form method="post" action="login.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>