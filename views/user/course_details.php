<?php
require_once "../../config/database.php";
require_once "../../models/Courses.php";

$db = new Database();
$conn = $db->getConnection();
$course = new Course($conn);

$course_id = $_GET['id'] ?? '';
$course_details = $course->findCourse($course_id);

if (!$course_details) {
    echo "Course not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
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

        /* Course Details Styles */
        .course-details {
            margin-top: 80px;
            padding: 20px;
        }
        .course-details img {
            max-width: 50%; /* Smaller image */
            height: auto;
            border-radius: 10px;
            display: block;
            margin: 0 auto 20px; /* Center the image */
        }
        .btn-register {
            background-color: #61cdbb;
            border-color: #61cdbb;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-register:hover {
            background-color: #4fa89a;
            border-color: #4fa89a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Navbar Styles */
        .navbar {
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .navbar-brand, .nav-link {
            transition: color 0.3s;
        }
    </style>
</head>
<body class="light-mode"> <!-- Default to light mode -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Course Details</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">🏠 Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">👤 My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">🚪 Log Out</a>
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

    <!-- Course Details -->
    <div class="container course-details">
    <center><h1><?= htmlspecialchars($course_details['title']) ?></h1></center>
        <img src="<?= htmlspecialchars($course_details['image']) ?>" alt="<?= htmlspecialchars($course_details['title']) ?>">
        <p><?= htmlspecialchars($course_details['description']) ?></p>
        <p><strong>Course Manager:</strong> <?= htmlspecialchars($course_details['course_manager_name']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($course_details['date']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($course_details['location']) ?></p>
        <button class="btn btn-register" onclick="registerCourse(<?= $course_details['id'] ?>)">Register</button>
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