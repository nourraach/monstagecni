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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Light Mode Styles */
        body.light-mode {
            background-color: #f8f9fa;
            color: #131722;
        }
        .light-mode .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .light-mode .navbar-brand, .light-mode .nav-link {
            color: #131722 !important;
        }
        .light-mode .nav-link:hover {
            color: #61cdbb !important;
        }
        .light-mode .table-dark {
            background-color: #ffffff;
            color: #131722;
        }
        .light-mode .table-dark th {
            background-color: #61cdbb;
            color: #131722;
        }
        .light-mode .table-dark tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #131722;
            color: #d1d5db;
        }
        .dark-mode .navbar {
            background-color: #1f2937;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .dark-mode .navbar-brand, .dark-mode .nav-link {
            color: #d1d5db !important;
        }
        .dark-mode .nav-link:hover {
            color: #61cdbb !important;
        }
        .dark-mode .table-dark {
            background-color: #1f2937;
            color: #d1d5db;
        }
        .dark-mode .table-dark th {
            background-color: #61cdbb;
            color: #131722;
        }
        .dark-mode .table-dark tbody tr:hover {
            background-color: #374151;
        }

        /* Navbar Styles */
        .navbar {
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .navbar-brand, .nav-link {
            transition: color 0.3s;
        }

        /* Table Container */
        .table-container {
            margin-top: 80px;
            padding: 20px;
        }

        /* Table Styles */
        .table-dark {
            border-radius: 10px;
            overflow: hidden;
        }
        .table-dark th, .table-dark td {
            border-color: #374151;
        }
        .table-dark thead th {
            font-weight: bold;
        }
        .table-dark tbody tr:hover {
            transition: background-color 0.3s;
        }

        /* Buttons */
        .btn-primary {
            background-color: #61cdbb;
            border-color: #61cdbb;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            background-color: #4fa89a;
            border-color: #4fa89a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Edit and Delete Buttons */
        .btn-edit {
            background-color: transparent;
            border: 1px solid #61cdbb;
            color: #61cdbb;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-edit:hover {
            background-color: #61cdbb;
            color: #fff;
        }
        .btn-delete {
            background-color: transparent;
            border: 1px solid #ff6b6b;
            color: #ff6b6b;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-delete:hover {
            background-color: #ff6b6b;
            color: #fff;
        }
    </style>
</head>
<body class="light-mode"> <!-- Default to light mode -->

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home_page.php">🏠 Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">👤 My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">🚪 Log Out</a>
                </li>
            </ul>
            <!-- Dark Mode Toggle -->
            <div class="form-check form-switch ms-3">
                <input class="form-check-input" type="checkbox" id="darkModeToggle">
                <label class="form-check-label" for="darkModeToggle">🌙</label>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
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
                    <td>
                        
                        <?= htmlspecialchars($course['title']) ?>
                    </td>
                    <td><?= htmlspecialchars($course['course_manager_name']) ?></td>
                    <td><?= htmlspecialchars($course['date']) ?></td>
                    <td><?= htmlspecialchars($course['location']) ?></td>
                    <td>
                        <a href="edit_course.php?id=<?= $course['id'] ?>" class="btn btn-edit btn-sm">Edit</a>
                        <a href="delete_course.php?id=<?= $course['id'] ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No courses found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Dark Mode Toggle Script -->
<script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    // Check local storage for dark mode preference
    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
        darkModeToggle.checked = true;
    }

    // Toggle dark mode
    darkModeToggle.addEventListener('change', () => {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>