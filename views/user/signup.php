<!-- views/register.php -->
<form action="UserController.php?action=register" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    
    <label for="num">Phone Number:</label>
    <input type="text" name="num" required><br>
    
    <button type="submit">Register</button>
</form>
<a href="login.php">Already have an account? Login</a>
