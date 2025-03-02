<?php
// Database Connection
$servername = "localhost";  // Change if needed
$username = "root";         // Change if needed
$password = "";             // Change if needed
$database = "monstagecni"; // Change to your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Arial', sans-serif;
            transition: background-color 0.3s, color 0.3s;
            overflow-x: hidden;
        }
        .logo {
            width: 50px;
            height: auto;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .logo:hover {
            transform: scale(1.1);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #61cdbb;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #4fa89a;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .nav-link {
            color: #131722 !important;
            font-weight: bold;
        }
        .nav-link:hover {
            color: #61cdbb !important;
            transform: translateY(-2px);
            transition: transform 0.2s;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background: linear-gradient(135deg, #131722, #1f2937);
            color: #fff;
        }
        .dark-mode .navbar {
            background: rgba(31, 41, 55, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .dark-mode .navbar-brand, .dark-mode .nav-link {
            color: #fff !important;
        }
        .dark-mode .nav-link:hover {
            color: #61cdbb !important;
        }

        /* Main Content */
        .container {
            margin-top: 100px;
        }
        h1 {
            color: #131722;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        .dark-mode h1 {
            color: #fff;
        }

        /* Course Cards */
        .card {
            background: #fff;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: slideUp 0.5s ease-in-out;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .card:hover .card-img-top {
            transform: scale(1.1);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #131722;
        }
        .dark-mode .card-title {
            color: #fff;
        }
        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .dark-mode .card-text {
            color: #9ca3af;
        }
        .rating {
            color: #FFD700;
            margin-bottom: 0.5rem;
        }
        .card-footer {
            background: #fff;
            border-top: 1px solid #e9ecef;
        }
        .dark-mode .card-footer {
            background: #1f2937;
            border-top: 1px solid #374151;
        }
        .card-footer span {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .dark-mode .card-footer span {
            color: #9ca3af;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #61cdbb, #4fa89a);
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-outline-primary {
            border-color: #61cdbb;
            color: #61cdbb;
            transition: background 0.3s, color 0.3s;
        }
        .btn-outline-primary:hover {
            background: #61cdbb;
            color: #fff;
        }

        /* Adjusted Spacing for Filter Buttons */
        .category-btn {
            border-radius: 20px;
            margin: 0.5rem; /* Increased margin for better spacing */
        }

        /* Footer */
        .footer {
            background: #131722;
            color: #fff;
            padding: 0.01rem 0; /* Reduced padding to make the footer smaller */
            margin-top:0rem; /* Reduced margin to minimize space */
            text-align: center;
            font-size: 0.9rem; /* Smaller font size */
        }
        .footer a {
            color: #61cdbb;
            text-decoration: none;
        }
        .footer a:hover {
            color: #fff;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

<!-- Floating Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
        <div class="logo-container" style="text-align: center; padding-top: 20px;">
            <img src="علّمني.png" alt="Logo" class="logo">
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="home_page.php">🏠 Home</a></li>
                <li class="nav-item"><a class="nav-link" href="contact_us.php">📞 Contact us</a></li>
                <li class="nav-item"><a class="nav-link" href="my_profile.php">👤 My account</a></li>
                <li class="nav-item"><a class="nav-link" href="../../registration.php">🚪 Log Out</a></li>
            </ul>
            <!-- Dark Mode Toggle -->
            <div class="form-check form-switch ms-3">
                <input class="form-check-input" type="checkbox" id="darkModeToggle">
                <label class="form-check-label" for="darkModeToggle">🌓 </label>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
    <h1><i class="fas fa-graduation-cap"></i> My Courses</h1>

    <!-- Search and Filter -->
    <div class="mb-4 text-center">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search for courses">
            <button class="btn btn-primary" type="button">Search</button>
        </div>
        <div class="d-flex flex-wrap justify-content-center">
            <button class="btn btn-outline-primary category-btn">All</button>
            <button class="btn btn-outline-primary category-btn">Design</button>
            <button class="btn btn-outline-primary category-btn">Development</button>
        </div>
    </div>

    <!-- Course Cards -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?= $row['image']; ?>" class="card-img-top" alt="Course Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text">Instructor: <?= htmlspecialchars($row['course_manager_name']); ?></p>
                            <div class="rating">
                                <?php
                                $rating = round($row['rating']); // Round rating to closest whole number
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $rating) {
                                        echo '<i class="fa fa-star"></i>'; // Filled star
                                    } else {
                                        echo '<i class="fa fa-star-half-alt"></i>'; // Half star
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between">
                            <span><?= date("M d", strtotime($row['date'])); ?></span>
                            <span><?= number_format($row['rating'], 1); ?>/10</span>
                        </div>
                        <a href="course_details.php?id=<?= $row['id']; ?>" class="btn btn-outline-primary">View Course</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>No courses available.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2025 علّمني. All rights reserved. | <a href="#">Privacy Policy</a></p>
    </div>
</footer>

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