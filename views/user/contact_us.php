<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Reuse the same CSS styles from your existing page */
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
        .footer {
            background: #131722;
            color: #fff;
            padding: 0.01rem 0;
            margin-top: 0rem;
            text-align: center;
            font-size: 0.9rem;
        }
        .footer a {
            color: #61cdbb;
            text-decoration: none;
        }
        .footer a:hover {
            color: #fff;
        }
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
    <h1><i class="fas fa-phone-alt"></i> Contact Us</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Centre National de l'Informatique</h5>
                    <p class="card-text text-center"><i class="fas fa-map-marker-alt"></i> 17 Rue Belhassen Ben Chaabane, 1005 El-Omrane</p>
                    <p class="card-text text-center"><i class="fas fa-phone"></i> Telephone: +216 71 78 30 55</p>
                    <p class="card-text text-center"><i class="fas fa-fax"></i> FAX: +216 71 781862</p>
                    <p class="card-text text-center"><i class="fas fa-envelope"></i> E-mail: <a href="mailto:webcni@cni.tn">webcni@cni.tn</a></p>
                    <p class="card-text text-center"><i class="fas fa-globe"></i> Website: <a href="http://www.cni.tn" target="_blank">www.cni.tn</a></p>
                </div>
            </div>
        </div>
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