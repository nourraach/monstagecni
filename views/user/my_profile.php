
<div class="profile-container">
    <h1>My Profile</h1>
    <div class="profile-info">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
    </div>
    <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
</div>

