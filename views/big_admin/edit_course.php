<?php
require_once "../../config/database.php";
require_once "../../models/Courses.php";

$db = new Database();
$conn = $db->getConnection();
$course = new Course($conn);

// Check if the course ID is provided in the URL
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $course_data = $course->findCourse($course_id);

    if (!$course_data) {
        die("Course not found.");
    }
} else {
    die("Invalid request.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assign form data to the course object
    $course->id = $course_id;
    $course->title = $_POST['title'];
    $course->description = $_POST['description'];
    $course->course_manager_name = $_POST['course_manager_name'];
    $course->rating = $_POST['rating'];
    $course->date = $_POST['date'];
    $course->location = $_POST['location'];
    $course->image = $_POST['image'];

    // Update the course
    if ($course->updateCourse()) {
        header("Location: courses_list.php");
        exit();
    } else {
        echo "Failed to update the course.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
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
        .light-mode .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .light-mode .form-control {
            background-color: #ffffff;
            color: #131722;
            border: 1px solid #ced4da;
        }
        .light-mode .btn-primary {
            background-color: #61cdbb;
            border-color: #61cdbb;
        }
        .light-mode .btn-primary:hover {
            background-color: #4fa89a;
            border-color: #4fa89a;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #131722;
            color: #d1d5db;
        }
        .dark-mode .container {
            background-color: #1f2937;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .dark-mode .form-control {
            background-color: #374151;
            color: #d1d5db;
            border: 1px solid #4b5563;
        }
        .dark-mode .btn-primary {
            background-color: #61cdbb;
            border-color: #61cdbb;
        }
        .dark-mode .btn-primary:hover {
            background-color: #4fa89a;
            border-color: #4fa89a;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="light-mode"> <!-- Default to light mode -->

<!-- Dark Mode Toggle -->
<div class="form-check form-switch ms-3" style="position: fixed; top: 20px; right: 20px;">
    <input class="form-check-input" type="checkbox" id="darkModeToggle">
    <label class="form-check-label" for="darkModeToggle">🌙</label>
</div>

<!-- Main Content -->
<div class="container">
    <h2>Edit Course</h2>
    <form method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($course_data['title']) ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($course_data['description']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="course_manager_name">Course Manager</label>
            <input type="text" class="form-control" id="course_manager_name" name="course_manager_name" value="<?= htmlspecialchars($course_data['course_manager_name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" step="0.01" class="form-control" id="rating" name="rating" value="<?= htmlspecialchars($course_data['rating']) ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($course_data['date']) ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($course_data['location']) ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" value="<?= htmlspecialchars($course_data['image']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Course</button>
        <a href="courses_list.php" class="btn btn-secondary">Cancel</a>
    </form>
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