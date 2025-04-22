<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #047857;
            --secondary-color: #065f46;
            --background-color: #f0fdf4;
            --card-color: #ffffff;
            --text-color: #1f2937;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        header {
            background-color: var(--primary-color);
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-button {
            background: none;
            border: none;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 3rem;
            background: var(--card-color);
            width: 230px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            z-index: 999;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.8rem 1rem;
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.3s;
        }

        .dropdown-menu a:hover {
            background: #e0f2f1;
        }

        .dashboard {
            margin-top: 5.5rem;
            padding: 2rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            height: 72vh;
        }

        .dashboard h2 {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }

        .sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .section {
            background: var(--card-color);
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            cursor: pointer;
            min-height: 200px;
        }

        .section:hover {
            transform: translateY(-5px);
        }

        .section h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: #e5e7eb;
            font-size: 0.9rem;
            color: #4b5563;
            margin-top: 4rem;
        }

        .fullscreen-section {
            position: fixed;
            top: 4.5rem;
            left: 0;
            width: 100%;
            height: calc(100% - 4.5rem);
            background: var(--card-color);
            z-index: 999;
            overflow-y: auto;
            padding: 2rem;
            display: none;
            flex-direction: column;
        }

        .fullscreen-section.active {
            display: flex;
        }

        .fullscreen-section .close-btn {
            align-self: flex-end;
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            font-weight: bold;
            border-radius: 0.5rem;
            cursor: pointer;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <header>
        <h1><i class="fas fa-chalkboard-teacher"></i> Teacher Dashboard</h1>
        <div class="profile-dropdown">
            <button class="profile-button" onclick="toggleDropdown()">
                <i class="fas fa-user-circle"></i> Teacher
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="#" class="dropdown-icon" data-icon="profile"><i class="fas fa-user"></i> Profile</a>
                <a href="#" class="dropdown-icon" data-icon="settings"><i class="fas fa-cog"></i> Settings</a>
                <a href="#" class="dropdown-icon" data-icon="Support"><i class="fas fa-headset"></i> Support</a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>

    <div class="dashboard">
        <h2>Welcome, Teacher!</h2>
        <div class="sections">
            <a href="Tcreate.php" style="text-decoration: none;color: black;">
                <div class="section">
                    <h3><i class="fas fa-book"></i> Manage Quizzes</h3>
                    <p>Create, edit, and delete quizzes for your students.</p>
                </div>
            </a>
            <a href="Tresult.php" style="text-decoration: none;color: black;">
                <div class="section">
                    <h3><i class="fas fa-poll-h"></i> View Results</h3>
                    <p>Review student submissions and analyze quiz performance.</p>
                </div>
            </a>
            <a href="TSchedule.php" style="text-decoration: none;color: black;">
                <div class="section">
                    <h3><i class="fas fa-calendar-alt"></i> Schedule Exams</h3>
                    <p>Plan upcoming tests and notify students in advance.</p>
                </div>
            </a>
            <a href="Tsend.php" style="text-decoration: none;color: black;">
                <div class="section">
                    <h3><i class="fas fa-bell"></i> Send Notifications</h3>
                    <p>Share announcements and updates with students.</p>
                </div>
            </a>
        </div>
    </div>

    <footer>
        &copy; 2025 Online Exam Portal - Teacher Dashboard
    </footer>

    <div class="fullscreen-section" id="fullscreenSection">
        <button class="close-btn" onclick="closeFullscreen()">Close</button>
        <div id="fullscreenContent"></div>
    </div>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById("dropdownMenu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        window.addEventListener("click", function(e) {
            const menu = document.getElementById("dropdownMenu");
            if (!e.target.closest(".profile-dropdown")) {
                menu.style.display = "none";
            }
        });

        const icons = document.querySelectorAll('.dropdown-icon');
        const fullscreen = document.getElementById('fullscreenSection');
        const fullscreenContent = document.getElementById('fullscreenContent');

        icons.forEach(icon => {
            icon.addEventListener('click', (e) => {
                e.preventDefault();
                const anchor = e.target.closest('a');
                if (!anchor) return;
                const iconType = anchor.getAttribute('data-icon');
                fullscreenContent.innerHTML = `<h3>${iconType.charAt(0).toUpperCase() + iconType.slice(1)} Settings</h3><p>Manage your ${iconType} settings here.</p>`;
                fullscreen.classList.add('active');
                document.getElementById("dropdownMenu").style.display = "none";
            });
        });

        function logout() {
            localStorage.removeItem('user');
            sessionStorage.clear();
            document.cookie = 'session=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
            alert("You have been logged out.");
            window.location.href = 'index.php';
        }

        function closeFullscreen() {
            fullscreen.classList.remove('active');
        }
    </script>
</body>

</html>