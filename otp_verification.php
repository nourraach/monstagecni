<?php
session_start();
include 'config/database.php';
$database = new Database();
$conn = $database->getMysqliConnection();

if (!isset($_SESSION['temp_user'])) {
    header("Location:views/user/home_page.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Combine the OTP inputs into a single string
    $user_otp = $_POST['otp1'] . $_POST['otp2'] . $_POST['otp3'] . $_POST['otp4'] . $_POST['otp5'] . $_POST['otp6'];
    $stored_otp = $_SESSION['temp_user']['otp'];
    $user_id = $_SESSION['temp_user']['id'];

    // Query the database for the user and OTP
    $sql = "SELECT * FROM users WHERE id='$user_id' AND otp='$user_otp'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);

    if ($data) {
        // Check if OTP has expired
        $otp_expiry = strtotime($data['otp_expiry']);
        if ($otp_expiry >= time()) {
            // OTP is valid, store user ID in session and unset 'temp_user'
            $_SESSION['user_id'] = $data['id'];
            unset($_SESSION['temp_user']);
            header("Location: views/user/home_page.php");
            exit();
        } else {
            // OTP has expired
            $_SESSION['error'] = "OTP has expired. Please try again.";
            header("Location: views/user/home_page.php");
            exit();
        }
    } else {
        // Invalid OTP
        echo "<script> alert('Invalid OTP. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        /* Form Styles */
        .auth-form {
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
        .auth-form p {
            font-size: 1rem;
            color: #34495e;
            margin-bottom: 20px;
            transition: color 0.5s;
        }
        body.dark-mode .auth-form p {
            color: #ecf0f1;
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

        /* OTP Input Styling */
        .otp-input {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .otp-input input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.5rem;
            border: 2px solid #61cdbb;
            border-radius: 10px;
            transition: border-color 0.3s ease;
        }
        .otp-input input:focus {
            border-color: #4fa89a;
            outline: none;
        }

        /* Resend OTP Link */
        .resend-otp {
            color: #61cdbb;
            cursor: pointer;
            text-decoration: underline;
            transition: color 0.3s ease;
        }
        .resend-otp:hover {
            color: #4fa89a;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
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

    <!-- OTP Verification Form -->
    <div class="auth-form">
        <h2>Secret Code Time 🔐</h2>
        <p>Almost there !</p><p> Please enter the 6-digit magic key sent to <strong><?php echo $_SESSION['temp_user']['email']; ?> 📩</strong></p>
        
        <!-- OTP Input Fields -->
        <form method="post" action="otp_verification.php">
            <div class="otp-input">
                <input type="number" name="otp1" maxlength="1" required>
                <input type="number" name="otp2" maxlength="1" required>
                <input type="number" name="otp3" maxlength="1" required>
                <input type="number" name="otp4" maxlength="1" required>
                <input type="number" name="otp5" maxlength="1" required>
                <input type="number" name="otp6" maxlength="1" required>
            </div>
            <button type="submit">Let's Verify ✅</button>
        </form>

        <!-- Resend OTP Link -->
       
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

    // Auto-focus and move between OTP inputs
    const otpInputs = document.querySelectorAll('.otp-input input');
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && index > 0 && !e.target.value) {
                otpInputs[index - 1].focus();
            }
        });
    });

    // Resend OTP Link
    const resendOtp = document.getElementById('resendOtp');
    resendOtp.addEventListener('click', () => {
        alert('OTP has been resent!');
        // Add logic to resend OTP here
    });

    // Shake animation for invalid OTP
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const otp = Array.from(otpInputs).map(input => input.value).join('');
        if (otp.length !== 6) {
            e.preventDefault();
            otpInputs.forEach(input => {
                input.style.animation = 'shake 0.5s';
                input.addEventListener('animationend', () => {
                    input.style.animation = '';
                });
            });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>