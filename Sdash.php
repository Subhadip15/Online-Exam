<?php
session_start();

// Check if the student is logged in by verifying the session
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

// Store student name for use in the profile button
$student_name = isset($_SESSION['student_name']) ? $_SESSION['student_name'] : 'Student';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --background-color: #f1f5f9;
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
            border-bottom: 2px solid #ddd;
            position: fixed;
            top: 0;
            width: 100%;
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
            z-index: 1000;
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
            background: #f0f4ff;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .dashboard {
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            height: 73vh;
            margin: 5rem auto 0;
            padding: 0 2rem;
            transition: margin-top 0.3s ease;
        }

        .dashboard h2 {
            font-size: 2rem;
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            width: 100%;
        }

        .section {
            background: var(--card-color);
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .section h3 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section p,
        .section ul {
            font-size: 1rem;
            color: #374151;
        }

        .section a p {
            text-decoration: none;
        }

        .fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ffffff;
            z-index: 999;
            padding: 2rem;
            overflow-y: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: #e5e7eb;
            font-size: 0.9rem;
            color: #4b5563;
            margin-top: 4rem;
        }

        .always-visible-section {
            display: block;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            .dashboard {
                padding: 0 1rem;
            }

            .sections {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
        <div class="profile-dropdown">
            <button class="profile-button" onclick="toggleDropdown()">
                <i class="fas fa-user-circle"></i>
                <?php echo $student_name; ?>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
                <a href="#" onclick="expandToFullScreen('profile')"><i class="fas fa-user"></i> Profile</a>
                <a href="#" onclick="expandToFullScreen('performance')"><i class="fas fa-chart-line"></i> Performance</a>
                <a href="#" onclick="expandToFullScreen('notifications')"><i class="fas fa-bell"></i> Notifications</a>
                <a href="#" onclick="expandToFullScreen('settings')"><i class="fas fa-cog"></i> Settings</a>
                <a href="#" onclick="expandToFullScreen('support')"><i class="fas fa-headset"></i> Support</a>
                <a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>

    <div class="dashboard">
        <h2>Welcome, Student!</h2>

        <div class="sections">
            <div id="quiz" class="section always-visible-section" onclick="expandSection('quiz')">
                <a href="exam.php" style="text-decoration: none;">
                    <h3><i class="fas fa-question"></i> Quiz</h3>
                    <p>Click here to start Quiz</p>
                </a>
            </div>

            <div id="result" class="section always-visible-section" onclick="expandSection('result')">
                <h3><i class="fas fa-poll"></i> Result</h3>
                <p id="resultText">Click here to show your Result.</p>
            </div>

            <div id="exam-calendar" class="section always-visible-section" onclick="expandSection('exam-calendar')">
                <h3><i class="fas fa-calendar-alt"></i> Exam Calendar</h3>
                <p>Stay updated with upcoming exams and schedules.</p>
            </div>
        </div>

        <div id="profile" class="section" style="display:none;">
            <h3><i class="fas fa-user"></i> Profile</h3>
            <p>Your student profile and personal information will appear here.</p>
            <p><strong>Welcome, <?php echo htmlspecialchars($student_name); ?>!</strong></p>

        </div>

        <div id="settings" class="section" style="display:none;">
            <h3><i class="fas fa-cog"></i> Settings</h3>
            <p>Manage your account settings and application preferences here.</p>
        </div>

        <div id="notifications" class="section" style="display:none;">
            <h3><i class="fas fa-bell"></i> Notifications</h3>
            <ul>
                <li>📢 New quiz available: Data Structures.</li>
                <li>✅ Your score for Python Basics has been posted.</li>
            </ul>
        </div>

        <div id="support" class="section" style="display:none;">
            <h3><i class="fas fa-headset"></i> Technical Support</h3>
            <p>Need help? Reach us at <a href="mailto:support@example.com">support@example.com</a>.</p>
        </div>

        <div id="performance" class="section" style="display:none;">
            <h3><i class="fas fa-chart-line"></i> Performance</h3>
            <p>Your learning progress and statistics will be shown here.</p>
        </div>
    </div>

    <footer>
        &copy; 2025 Online Exam Portal - Student Dashboard
    </footer>

    <script>
        // Function to toggle the dropdown visibility
        function toggleDropdown(event) {
            const menu = document.getElementById("dropdownMenu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
            event.stopPropagation(); // Prevent event from propagating to the window click listener
        }

        // Function to hide the dropdown when clicking outside
        window.addEventListener("click", function(e) {
            const menu = document.getElementById("dropdownMenu");
            if (!e.target.closest(".profile-dropdown")) { // If the click is outside the dropdown
                menu.style.display = "none"; // Hide the dropdown
            }
        });

        // Close dropdown menu after clicking an option
        function closeDropdown() {
            const menu = document.getElementById("dropdownMenu");
            menu.style.display = "none"; // Hide the dropdown menu when an option is clicked
        }

        // Function to expand a section to full screen
        function expandToFullScreen(sectionId) {
            const section = document.getElementById(sectionId);
            section.classList.add('fullscreen');
            section.style.display = 'flex';

            document.querySelectorAll('.section').forEach(s => {
                if (s.id !== sectionId) {
                    s.classList.remove('fullscreen');
                    s.style.display = 'none';
                }
            });
        }

        // Function to expand a section
        function expandSection(sectionId) {
            expandToFullScreen(sectionId);

            if (sectionId === 'result') {
                showResult();
            }
        }

        // Fetching the student name after DOM content is loaded
        document.addEventListener("DOMContentLoaded", function() {
            fetch('get_student_name.php', {
                    method: 'GET',
                    credentials: 'include'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.name) {
                        const profileButton = document.querySelector('.profile-button');
                        profileButton.innerHTML = `<i class="fas fa-user-circle"></i> ${data.name} <i class="fas fa-chevron-down"></i>`;
                    }
                })
                .catch(err => console.log('Error fetching student info:', err));
        });

        // Function to display the results
        function showResult() {
            const resultContent = document.getElementById('resultText');
            resultContent.innerHTML = 'Loading...';

            fetch('get_results.php', {
                    method: 'GET',
                    credentials: 'include'
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        resultContent.innerHTML = `<p style="color:red;">${data.message}</p>`;
                    } else if (data.data.length === 0) {
                        resultContent.innerHTML = `<p>No quiz results found.</p>`;
                    } else {
                        resultContent.innerHTML = `<h3 style="margin-bottom: 20px;">Your Quiz Attempts</h3>`;
                        data.data.forEach((row, index) => {
                            resultContent.innerHTML += `
                        <div style="margin-bottom: 30px; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <div style="background-color: #E0F2FE; padding: 12px 20px; font-size: 16px; font-weight: bold;">
                                Attempt ${index + 1}
                            </div>
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
                                    <thead>
                                        <tr>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #E0E7FF;">Result ID</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #E0E7FF;">Student ID</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #D1FAE5;">Score</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #D1FAE5;">Total</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #FEF3C7;">Correct</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #FEF3C7;">Wrong</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #FEF3C7;">Unanswered</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #F3F4F6;">Result Details</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #CBD5E1;">Time Taken</th>
                                            <th style="padding: 12px; border: 1px solid #ddd; background-color: #CBD5E1;">Submitted At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.result_id}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.student_id}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.score}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.total_questions}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.correct_answers}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.wrong_answers}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.unanswered}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd; text-align: left;">
                                                <div style="white-space: pre-wrap; font-family: monospace;">${row.result_data}</div>
                                            </td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.time_taken}</td>
                                            <td style="padding: 12px; border: 1px solid #ddd;">${row.submit_time}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>`;
                        });
                    }
                })
                .catch(error => {
                    resultContent.innerHTML = `<p style="color:red;">Failed to load result.</p>`;
                    console.error('Error:', error);
                });
        }

        // Logout function to clear session data
        function logout() {
            localStorage.removeItem('user');
            sessionStorage.clear();
            document.cookie = 'session=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
            alert("You have been logged out.");
            window.location.href = 'index.php';
        }

        // Attaching click event listener to each dropdown option to close the dropdown
        const dropdownLinks = document.querySelectorAll("#dropdownMenu a");
        dropdownLinks.forEach(link => {
            link.addEventListener("click", closeDropdown);
        });
    </script>



</body>

</html>