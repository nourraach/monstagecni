<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        /* Dashboard Container */
        .dashboard-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .dashboard-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            transition: color 0.5s;
        }
        body.dark-mode .dashboard-header h1 {
            color: #f8f9fa;
        }
        .dashboard-header .logout-btn {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 25px;
            background-color:rgba(255, 107, 107, 0.41);
            border: none;
            color: #fff;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .dashboard-header .logout-btn:hover {
            background-color:rgba(255, 76, 76, 0.29);
            transform: scale(1.05);
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
        }
        .quick-actions button {
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 25px;
            background-color: #61cdbb;
            border: none;
            color: #fff;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .quick-actions button:hover {
            background-color: #4fa89a;
            transform: scale(1.05);
        }

        /* Recent Activity Section */
        .recent-activity {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 40px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            transition: background 0.5s;
        }
        body.dark-mode .recent-activity {
            background: rgba(44, 62, 80, 0.8);
        }
        .recent-activity h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
            transition: color 0.5s;
        }
        body.dark-mode .recent-activity h2 {
            color: #f8f9fa;
        }
        .recent-activity ul {
            list-style-type: none;
            padding: 0;
        }
        .recent-activity li {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #34495e;
            transition: color 0.5s;
        }
        body.dark-mode .recent-activity li {
            color: #ecf0f1;
        }

        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        .stats .stat-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            transition: background 0.5s;
        }
        body.dark-mode .stats .stat-card {
            background: rgba(44, 62, 80, 0.8);
        }
        .stats .stat-card h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
            transition: color 0.5s;
        }
        body.dark-mode .stats .stat-card h3 {
            color: #f8f9fa;
        }
        .stats .stat-card p {
            font-size: 1rem;
            color: #34495e;
            transition: color 0.5s;
        }
        body.dark-mode .stats .stat-card p {
            color: #ecf0f1;
        }

        /* Cute Pictures Section */
        .cute-pictures {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
        }
        .cute-pictures img {
            width: 200px;
            height: auto;
            border-radius: 15px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .cute-pictures img:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: fixed;
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
    </style>
</head>

<body>

<!-- Dark Mode Toggle -->
<div class="dark-mode-toggle" id="darkModeToggle">
    🌓
</div>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1>Hi, Admin!</h1>
        <p>What are we doing today?</p>
        <a href="logout.php">
            <button class="logout-btn">Log Out</button>
        </a>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="users_list.php">
            <button>Manage Users</button>
        </a>
        <a href="courses_list.php">
            <button>Manage Courses</button>
        </a>
    </div>

    <!-- Recent Activity Section -->
    <div class="recent-activity">
        <h2>Recent Activity</h2>
        <ul>
            <li>📚 Course "Advanced Python" was updated.</li>
            <li>📅 New event "Web Development Workshop" was added.</li>
            <li>📊 10 new users joined this week.</li>
            <li>📥 5 new courses were published.</li>
        </ul>
    </div>

    <!-- Stats Section -->
    <div class="stats">
        <div class="stat-card">
            <h3>1,200</h3>
            <p>Active Users</p>
        </div>
        <div class="stat-card">
            <h3>50</h3>
            <p>Educators</p>
        </div>
        <div class="stat-card">
            <h3>2,500</h3>
            <p>Active Courses</p>
        </div>
        <div class="stat-card">
            <h3>95%</h3>
            <p>Platform Uptime</p>
        </div>
    </div>

    <!-- Cute Pictures Section -->
    <div class="cute-pictures">
        <img src="i1.jpg" alt="Cute Picture 1">
        <img src="i6.jpg" alt="Cute Picture 2">
        <img src="i5.jpg" alt="Cute Picture 3">
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
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>