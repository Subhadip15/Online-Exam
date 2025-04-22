<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal MCQ Test</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
    <script type="text/javascript">
        var tday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var tmonth = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        function GetClock() {
            var d = new Date(); // Current local time
            var nday = d.getDay();
            var nmonth = d.getMonth();
            var ndate = d.getDate();
            var nyear = d.getFullYear(); // Use getFullYear to avoid year 2000 issues
            var nhour = d.getHours();
            var nmin = d.getMinutes();
            var nsec = d.getSeconds();
            var ap = nhour >= 12 ? " PM" : " AM";

            // Convert hours to 12-hour format
            nhour = nhour % 12 || 12;

            // Add leading zeros to minutes and seconds
            nmin = nmin < 10 ? "0" + nmin : nmin;
            nsec = nsec < 10 ? "0" + nsec : nsec;

            // Format the clock display
            var clockText = `${tday[nday]}, ${tmonth[nmonth]} ${ndate}, ${nyear} ${nhour}:${nmin}:${nsec}${ap}`;

            // Update the clock in the DOM
            document.getElementById('clockbox').innerHTML = clockText;
        }

        // Ensure the script runs on DOMContentLoaded without jQuery
        document.addEventListener("DOMContentLoaded", function() {
            GetClock(); // Run immediately
            setInterval(GetClock, 1000); // Update every second
        });
    </script>
</head>

<body>
    <div id="top-loading-bar"></div>

    <header>
        <h1>Internal MCQ Test</h1>
        <div class="c">
            <h3>EXAMINATION SYSTEM</h3>
            <ul id="clockc">
                <li style="color: #fff; font-size: 16px; margin-left: 55px;" id="clockbox"></li>
            </ul>
        </div>

    </header>
    <div class="new">
        <div class="mar" style="height: 25px; width: 96%; font-size: 16px; background-color: #76c7ffe3;">
            <marquee id="myMarquee" behavior="scroll" direction="left" scrollamount="4">
                Stay tuned for updates, and don't forget to participate in our latest quizzes and tests!
            </marquee>
        </div>
        <script>
            // Get the marquee element
            const marquee = document.getElementById('myMarquee');

            // Pause the marquee when mouse is over it
            marquee.addEventListener('mouseover', function() {
                marquee.stop();
            });

            // Start the marquee when mouse leaves
            marquee.addEventListener('mouseout', function() {
                marquee.start();
            });
        </script>
        <img src=".\data\moon.png" alt="C" id="icon" title="Light or Dark">
        <script>
            var icon = document.getElementById("icon");
            icon.onclick = function() {
                document.body.classList.toggle("dark-theme");
                if (document.body.classList.contains("dark-theme")) {
                    icon.src = "./data/sun.png";
                } else {
                    icon.src = "./data/moon.png";
                }
            }
        </script>
        <!-- <div id="mode" title="Light/Dark">
            <label class="switch">
                <input type="checkbox" id="toggleMode">
                <span class="slider round"></span>
            </label>
        </div> -->

        <!-- <script>
            // Check for user's previous mode preference in localStorage
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                document.getElementById('toggleMode').checked = true;
            }

            // Add event listener to the checkbox
            document.getElementById('toggleMode').addEventListener('change', function() {
                // Toggle dark mode class
                if (this.checked) {
                    document.body.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'enabled'); // Save preference in localStorage
                } else {
                    document.body.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'disabled'); // Save preference in localStorage
                }
            });
        </script> -->

    </div>
    <main>
        <div class="card-container">
            <div id="student" class="card">
                <h2><i class="fas fa-user-graduate"></i> Student</h2>
                <p>Login to take exams, view your progress, and check your results with ease.</p>
                <a href="student.html"><i class="fas fa-sign-in-alt"></i> Enter Student Section</a>
            </div>
            <div id="overlay"></div>
            <div id="teacher" class="card">
                <h2><i class="fas fa-chalkboard-teacher"></i> Teacher</h2>
                <p>Create tests, manage students, and evaluate performance seamlessly.</p>
                <a href="teacher.html"><i class="fas fa-sign-in-alt"></i> Enter Teacher Section</a>
            </div>
            <div id="overlayy"></div>
        </div>
        <div class="support">
            <h3><i class="fas fa-headset"></i> Technical Support</h3>
            <p><i class="fas fa-envelope"></i> support@skk12.com</p>
            <p><i class="fas fa-phone-alt"></i> +91-9876543210</p>
            <p>Our support team is available Monday to Friday, 9 AM to 12 PM.</p>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var teSection = document.getElementById('student');

                teSection.addEventListener('click', function(event) {
                    event.preventDefault();

                    var existingPopup = document.getElementById('sign-pop');
                    var overlay = document.getElementById('overlay');

                    if (!overlay) {
                        overlay = document.createElement('div');
                        overlay.id = 'overlay';
                        document.body.appendChild(overlay);
                    }

                    if (!existingPopup) {
                        var popup = document.createElement('div');
                        popup.id = 'sign-pop';
                        popup.classList.add('popup');
                        popup.innerHTML = getLoginFormHTML();
                        document.body.appendChild(popup);
                    }

                    existingPopup = document.getElementById('sign-pop');
                    overlay = document.getElementById('overlay');

                    overlay.classList.add('show');
                    existingPopup.classList.add('show');
                    document.body.classList.add('blur');

                    initializeLoginForm();

                    overlay.addEventListener('click', closePopup);
                });

                function closePopup() {
                    var popup = document.getElementById('sign-pop');
                    var overlay = document.getElementById('overlay');
                    popup.classList.remove('show');
                    overlay.classList.remove('show');
                    document.body.classList.remove('blur');
                }

                function getLoginFormHTML() {
                    return `
                            <div class="headl" id="student-login">
                               <h2>Student Login</h2>
                               <div id="close-student-popup" title="Close">×</div>
                            </div>
                            <div id="error-message" class="error-message"></div>
                            <div class="forml">
                                <form id="student-login-form" method="POST">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                                    <div class="sign">
                                        <a href="forgot-password.html" class="forgot-password" id="forgot-password">Forgot Password?</a>
                                        <button type="submit">Log In</button>
                                    </div>
                                    <div class="links">
                                        <p>Don't have an account?</p>
                                        <button type="button" id="first-time-signup" style=" background-color: #f3f3f3;">Register</button>
                                    </div>
                                </form>
                            </div>`;
                }

                function getSignUpFormHTML() {
                    return `
                            <div class="headl" id="signup-section">
                                <h2>New Register</h2>
                                <div id="close-signup-popup" title="Close">×</div>
                            </div>
                            <div class="forml">
                                <form id="signup-form" method="POST">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                                    <label for="signup-email">Email</label>
                                    <input type="email" id="signup-email" name="email" placeholder="Enter your email" required>
                                    <label for="signup-password">Password</label>
                                    <input type="password" id="signup-password" name="password" placeholder="Create a password" required>
                                    <div class="sign">
                                        <button type="submit">Sign Up</button>
                                    </div>
                                    <p class="or">..........................................or..........................................</p>
                                    <div class="icons">
                                        <i class="fab fa-google"></i>
                                        <i class="fab fa-facebook"></i>
                                    </div>
                                    <div class="links">
                                        <p>Already have an account?</p>
                                        <button type="button" id="back-to-login" style=" background-color: #f3f3f3;">Sign In</button>
                                    </div>
                                </form>
                            </div>`;
                }

                function animateTopLoadingBar() {
                    const topLoadingBar = document.getElementById('top-loading-bar');
                    if (topLoadingBar) {
                        topLoadingBar.style.display = "block";
                        topLoadingBar.style.width = "0";
                        setTimeout(() => {
                            topLoadingBar.style.width = "100%";
                        }, 50);
                        setTimeout(() => {
                            topLoadingBar.style.width = "0";
                            topLoadingBar.style.display = "none";
                        }, 2000);
                    }
                }

                function initializeLoginForm() {
                    var popup = document.getElementById('sign-pop');
                    var closeBtn = document.getElementById('close-student-popup');
                    var firstTimeSignupLink = document.getElementById('first-time-signup');

                    closeBtn.addEventListener('click', closePopup);

                    var loginForm = document.getElementById('student-login-form');
                    loginForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        animateTopLoadingBar();

                        var email = document.getElementById('email').value;
                        var password = document.getElementById('password').value;
                        var errorMessageContainer = document.getElementById('error-message');
                        errorMessageContainer.textContent = '';

                        fetch('connect.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    email,
                                    password
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.href = "Sdash.php";
                                } else {
                                    errorMessageContainer.textContent = data.message || "Invalid Email or Password.";
                                    loginForm.reset();
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                errorMessageContainer.textContent = "Something went wrong. Please try again.";
                            });
                    });

                    firstTimeSignupLink.addEventListener('click', function() {
                        popup.innerHTML = getSignUpFormHTML();
                        initializeSignUpForm();
                    });
                }

                function initializeSignUpForm() {
                    var popup = document.getElementById('sign-pop');
                    var closeBtn = document.getElementById('close-signup-popup');
                    var backToLoginLink = document.getElementById('back-to-login');

                    closeBtn.addEventListener('click', closePopup);

                    var signupForm = document.getElementById('signup-form');
                    signupForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        animateTopLoadingBar();

                        var name = document.getElementById('name').value;
                        var signupEmail = document.getElementById('signup-email').value;
                        var signupPassword = document.getElementById('signup-password').value;

                        fetch('connect.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    name,
                                    email: signupEmail,
                                    password: signupPassword
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(`Sign up successful! Welcome, ${name}!`);
                                    popup.innerHTML = getLoginFormHTML();
                                    initializeLoginForm();
                                } else {
                                    alert(data.message || "Signup failed.");
                                }
                            })
                            .catch(error => {
                                console.error('Signup Error:', error);
                                alert("Something went wrong during signup.");
                            });
                    });

                    backToLoginLink.addEventListener('click', function() {
                        popup.innerHTML = getLoginFormHTML();
                        initializeLoginForm();
                    });
                }
            });
        </script>
        <!-- a -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var teSection = document.getElementById('teacher');

                teSection.addEventListener('click', function(event) {
                    event.preventDefault();

                    var existingPopup = document.getElementById('sign-popp');
                    var overlay = document.getElementById('overlayy');

                    // Create overlay if it doesn't exist
                    if (!overlay) {
                        overlay = document.createElement('div');
                        overlay.id = 'overlayy';
                        document.body.appendChild(overlay);
                    }

                    // Create popup if it doesn't exist
                    if (!existingPopup) {
                        var popup = document.createElement('div');
                        popup.id = 'sign-popp';
                        popup.classList.add('popup');
                        popup.innerHTML = getLoginFormHTML(); // Load login form initially
                        document.body.appendChild(popup);
                    }

                    existingPopup = document.getElementById('sign-popp');
                    overlay = document.getElementById('overlayy');

                    // Show the popup and overlay
                    overlay.classList.add('show');
                    existingPopup.classList.add('show');
                    document.body.classList.add('blur'); // Apply blur effect

                    // Initialize login form functionality
                    initializeLoginForm();

                    // Close popup functionality
                    overlay.addEventListener('click', closePopup);
                });

                // Function to close popup
                function closePopup() {
                    var popup = document.getElementById('sign-popp');
                    var overlay = document.getElementById('overlayy');
                    popup.classList.remove('show');
                    overlay.classList.remove('show');
                    document.body.classList.remove('blur'); // Remove blur effect
                    document.body.removeChild(overlay); // Remove overlay from DOM
                    document.body.removeChild(popup); // Remove popup from DOM
                }

                // Get Login Form HTML
                function getLoginFormHTML() {
                    return `
        <div class="headl">
            <h2>Teacher Login Portal</h2>
            <div id="close-teacher-popup" title="Close">×</div>
        </div>
        <div id="error-message" class="error-message"></div>
        <div class="forml">
            <form id="teacher-login-form" action="connect.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <div class="sign">
                    <a href="#" class="forgot-password" id="forgot-password">Forgot Password?</a>
                    <button type="submit" name="login">Log In</button>
                </div>
                <div class="links">
                    <p>Don't have an account?</p>
                    <button href="#" id="first-time-signup" type="text">Register</button>
                </div>
            </form>
        </div>
        `;
                }

                // Function to initialize the login form
                function initializeLoginForm() {
                    const loginForm = document.getElementById('teacher-login-form');
                    const emailInput = document.getElementById('email');
                    const passwordInput = document.getElementById('password');
                    const errorMessageContainer = document.getElementById('error-message');

                    loginForm.addEventListener('submit', function(event) {
                        event.preventDefault();

                        const email = emailInput.value.trim();
                        const password = passwordInput.value.trim();

                        // Check if email and password are provided
                        if (!email || !password) {
                            errorMessageContainer.textContent = "Both email and password are required.";
                            return;
                        }

                        // Prepare the data to send
                        const loginData = {
                            email: email,
                            password: password
                        };

                        console.log("Login Request:", loginData);

                        fetch('connectt.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(loginData) // Send data as JSON
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Store the teacher's ID in the session (handled in PHP backend)
                                    sessionStorage.setItem('teacher_id', data.teacher_id); // Optional: Store teacher_id in sessionStorage
                                    window.location.href = "Tdash.php"; // Redirect to teacher's dashboard
                                } else {
                                    errorMessageContainer.textContent = data.message || "Login failed.";
                                    loginForm.reset();
                                }
                            })
                            .catch(error => {
                                console.error('Login error:', error);
                                errorMessageContainer.textContent = "An error occurred. Try again.";
                            });
                    });
                }
            });
        </script>

    </main>

    <footer>
        <p>Student Management Portal. &copy; 2024 All rights reserved.</p>
    </footer>
</body>

</html>