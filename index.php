<?php
session_start();

// Check if the user is already logged in, otherwise show the OTP verification page
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");  // Redirect to dashboard if the user is already logged in
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - OTP Verification</title>
</head>
<body>

    <h1>Login - OTP Verification</h1>

    <?php
    // Display error message if OTP has expired or if there's any other issue
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);  // Clear the error message after displaying it
    }
    ?>

    <form method="post" action="otp_verification.php">
        <label for="otp">Enter OTP:</label><br>
        <input type="number" name="otp" placeholder="Enter OTP" required><br><br>
        <button type="submit">Submit</button>
    </form>

</body>
</html>
