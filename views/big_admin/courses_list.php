
<?php
require_once "../../config/database.php";
require_once "../../models/Courses.php";

$db = new Database();
$conn = $db->getConnection();
$course = new Course($conn);
$courses = $course->findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses List</title>
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
        .status-active {
            color: #28a745;
        }
        .status-inactive {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h2 class="mb-4">Courses List</h2>
        <button class="btn btn-primary mb-3">+ Add Course</button>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Manager</th>
                    <th>Date</th>
                    <th>Location</th>
                   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['id']) ?></td>
                        <td><img src="<?= htmlspecialchars($course['image']) ?>" width="50" alt="Course Image"> <?= htmlspecialchars($course['title']) ?></td>
                        <td><?= htmlspecialchars($course['course_manager_name']) ?></td>
                        <td><?= htmlspecialchars($course['date']) ?></td>
                        <td><?= htmlspecialchars($course['location']) ?></td>
                        
                        <td>
                            <a href="edit.php?id=<?= $course['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $course['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No courses found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
