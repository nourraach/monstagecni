<?php
session_start();
include 'config/database.php';
include 'send_email.php';
$database = new Database();
$conn = $database->getMysqliConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Signup
    if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $phone_number = $_POST['phone_number'];

        // Check if email already exists
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Email already exists. Please use a different email.";
            header("Location: registration.php");
            exit();
        }

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
        $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP valid for 10 minutes

        // Insert user data into the database
        $sql = "INSERT INTO users (username, email, password, phone_number, otp, otp_expiry) VALUES ('$username', '$email', '$password', '$phone_number', '$otp', '$otp_expiry')";
        if (mysqli_query($conn, $sql)) {
            $user_id = mysqli_insert_id($conn);

            // Store user data in session for OTP verification
            $_SESSION['temp_user'] = [
                'id' => $user_id,
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
            $_SESSION['error'] = "Registration failed. Please try again.";
            header("Location: registration.php");
            exit();
        }
    }

    // Handle Login
    if (isset($_POST['login'])) {
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #2c3e50;
            transition: background 0.5s, color 0.5s;
            scroll-behavior: smooth;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a1a, #2c3e50);
            color: #f8f9fa;
        }

        /* Logo Styling */
        .logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .logo:hover {
            transform: scale(1.1);
        }

        /* Auth Container */
        .auth-container {
            position: relative;
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
            transition: background 0.5s;
        }
        body.dark-mode .auth-container {
            background: rgba(44, 62, 80, 0.9);
        }

        /* Forms Container */
        .forms-container {
            display: flex;
            width: 200%; /* Double the width to accommodate both forms */
            transition: transform 0.5s ease-in-out;
        }

        /* Login and Signup Forms */
        .auth-form {
            width: 50%; /* Each form takes half of the container */
            padding: 30px;
            text-align: center;
        }
        .auth-form h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
            transition: color 0.5s;
        }
        body.dark-mode .auth-form h2 {
            color: #f8f9fa;
        }
        .auth-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease, background 0.5s, color 0.5s;
        }
        body.dark-mode .auth-form input {
            background: #34495e;
            border-color: #2c3e50;
            color: #f8f9fa;
        }
        .auth-form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            background-color: #61cdbb;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .auth-form button:hover {
            background-color: #4fa89a;
            transform: scale(1.05);
        }

        /* Toggle Link */
        .toggle-link {
            color: #61cdbb;
            cursor: pointer;
            text-decoration: underline;
            transition: color 0.3s ease;
        }
        .toggle-link:hover {
            color: #4fa89a;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

<!-- Dark Mode Toggle -->
<div class="dark-mode-toggle" id="darkModeToggle">
    🌓
</div>

<!-- Auth Container -->
<div class="auth-container">
    <!-- Logo Inside the Container -->
    <div class="logo-container" style="text-align: center; padding-top: 20px;">
        <img src="علّمني.png" alt="Logo" class="logo">
    </div>

    <!-- Forms Container -->
    <div class="forms-container" id="formsContainer">
        <!-- Login Form -->
        <div class="auth-form" id="loginForm">
            <h2>Login</h2>
            <form method="post" action="registration.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
            <p>Don't have an account? <span class="toggle-link" id="showSignup">Signup</span></p>
        </div>

        <!-- Signup Form -->
        <div class="auth-form" id="signupForm">
            <h2>Signup</h2>
            <form method="post" action="registration.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone_number" placeholder="Phone Number" required>
                <button type="submit" name="signup">Signup</button>
            </form>
            <p>Already have an account? <span class="toggle-link" id="showLogin">Login</span></p>
        </div>
    </div>
</div>

<script>
    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        darkModeToggle.textContent = body.classList.contains('dark-mode') ? '🌞' : '🌓';
    });

    // Toggle Between Login and Signup Forms
    const formsContainer = document.getElementById('formsContainer');
    const showSignup = document.getElementById('showSignup');
    const showLogin = document.getElementById('showLogin');

    showSignup.addEventListener('click', () => {
        formsContainer.style.transform = 'translateX(-50%)'; // Slide to the left
    });

    showLogin.addEventListener('click', () => {
        formsContainer.style.transform = 'translateX(0%)'; // Slide back to the right
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>