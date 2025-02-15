<?php
require_once "../../config/database.php";
require_once "../../models/User.php";

$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);
$users = $user->findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #131722;
            color: #d1d5db;
        }
        .table-container {
            margin-top: 50px;
        }
        .btn-primary {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h2 class="mb-4">Users List</h2>
        <button class="btn btn-primary mb-3">+ Add User</button>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['num']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No users found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
