<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #2c3e50;
            transition: background 0.5s, color 0.5s;
            scroll-behavior: smooth;
        }
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a1a, #2c3e50);
            color: #f8f9fa;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #61cdbb;
            border-radius: 10px;
        }
        body.dark-mode ::-webkit-scrollbar-thumb {
            background: #4fa89a;
        }

        /* CNI Logo Styling */
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px;
            height: auto;
            z-index: 10;
            transition: transform 0.3s ease;
        }
        .logo:hover {
            transform: scale(1.1);
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 1.2rem;
            color: #2c3e50;
            transition: color 0.3s ease;
        }
        .dark-mode-toggle:hover {
            color: #61cdbb;
        }
        body.dark-mode .dark-mode-toggle {
            color: #f8f9fa;
        }

        /* Header */
        .header {
            text-align: center;
            margin: 100px 0 40px;
            animation: fadeIn 1.5s ease-in-out;
        }
        .header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            line-height: 1.3;
            margin-bottom: 20px;
            transition: color 0.5s;
        }
        body.dark-mode .header h1 {
            color: #f8f9fa;
        }
        .header button {
            margin-top: 20px;
            padding: 10px 30px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 25px;
            background-color: #61cdbb;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .header button:hover {
            background-color: #4fa89a;
            transform: scale(1.05);
        }

        /* Content Section */
        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-in-out;
            transition: background 0.5s;
        }
        body.dark-mode .content {
            background: rgba(44, 62, 80, 0.8);
        }
        .text-container {
            flex: 1;
            margin-right: 30px;
        }
        .text-container p {
            font-size: 1.1rem;
            color: #34495e;
            line-height: 1.6;
            max-width: 550px;
            transition: color 0.5s;
        }
        body.dark-mode .text-container p {
            color: #ecf0f1;
        }
        .text-container .highlight {
            color: #e74c3c;
            font-weight: bold;
        }
        .image-container {
            flex: 1;
            display: flex;
            gap: 20px;
            justify-content: flex-end;
        }
        .image-container img {
            width: 45%;
            max-width: 250px;
            height: auto;
            border-radius: 15px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .image-container img:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #61cdbb, #4fa89a);
            color: white;
            text-align: center;
            padding: 40px 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border-radius: 15px;
            animation: fadeInUp 1.5s ease-in-out;
        }
        .stats div {
            flex: 1;
            padding: 15px;
            font-size: 1.1rem;
        }
        .stats h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .stats p {
            font-size: 1rem;
            color: #ecf0f1;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
                text-align: center;
            }
            .text-container {
                margin-right: 0;
                margin-bottom: 20px;
            }
            .image-container {
                justify-content: center;
                gap: 10px;
            }
            .image-container img {
                width: 48%;
            }
            .header h1 {
                font-size: 2rem;
            }
            .stats {
                padding: 20px 10px;
            }
            .stats h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

<!-- CNI Logo at the Top-Left -->
<img src="cni.png" alt="CNI Logo" class="logo">

<!-- Dark Mode Toggle -->
<div class="dark-mode-toggle" id="darkModeToggle">
    🌓
</div>

<div class="container">
    <div class="header">
        <h1>Learn the skills,</h1>
        <h1>land your dream job.</h1>
        <a href="courses.php">
            <button class="btn btn-primary">Explore Courses</button>
        </a>
    </div>

    <div class="content">
        <div class="text-container">
            <p><span class="highlight">Unlock your potential</span> with top-tier courses and training designed to elevate your career.</p>
            <p>Whether you're looking to gain technical expertise, improve soft skills, or advance in your current profession, we have the resources to help you succeed.</p>
        </div>
        <div class="image-container">
            <img src="1.png" alt="E-learning">
            <img src="2.png" alt="E-learning">
        </div>
    </div>

    <div class="stats d-flex">
        <div>
            <h3 id="studentCount">0</h3>
            <p>Students since our start </p>
        </div>
        <div>
            <h3 id="educatorCount">0</h3>
            <p>Educators </p>
        </div>
        <div>
            <h3 id="courseCount">0</h3>
            <p>Courses</p>
        </div>
    </div>
</div>

<script>
    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        darkModeToggle.textContent = body.classList.contains('dark-mode') ? '🌞' : '🌓';
    });

    // Dynamic Stats Counter
    const studentCount = document.getElementById('studentCount');
    const educatorCount = document.getElementById('educatorCount');
    const courseCount = document.getElementById('courseCount');

    const animateCount = (element, target) => {
        let count = 0;
        const increment = target / 100;
        const interval = setInterval(() => {
            count += increment;
            if (count >= target) {
                count = target;
                clearInterval(interval);
            }
            element.textContent = Math.round(count).toLocaleString();
        }, 20);
    };

    animateCount(studentCount, 1400);
    animateCount(educatorCount, 80);
    animateCount(courseCount, 3100);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>