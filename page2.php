<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Portal</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('back.jpg');
            /* Image URL */
            background-size: cover;
            /* Covers entire area */
            background-position: center;
            /* Centers the image */
            background-repeat: no-repeat;
            /* No repeating */
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .header .logo {
            font-size: 22px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .account {
            position: relative;
            display: flex;
            align-items: center;
        }

        .profile-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
        }

        .profile-btn:hover {
            background-color: #555;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #333;
            min-width: 160px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 1px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .dropdown a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background 0.3s;
        }

        .dropdown a:hover {
            background-color: #4caf50;
        }

        .dropdown.show {
            display: block;
        }

        main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .box {
            width: 400px;
            height: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            background: orange;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .box label {
            margin-bottom: 14px;
            padding: 13px;
            text-align: center;
            font-size: 1.5rem;
            color: black;
        }

        .feedback {
            color: red;
            margin-bottom: 10px;
        }

        .box input {
            width: 80%;
            padding: 10px;
            margin-bottom: 70px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .box button {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            font-size: 20px;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .box button:hover {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="#" class="logo">MySite</a>
        <div class="account">
            <button class="profile-btn" onclick="toggleDropdown()">
                <i class="fa-solid fa-user"></i>
            </button>
            <div class="dropdown" id="dropdownMenu">
                <a href="#">⚙ Profile</a>
                <a href="#">🏆 Leaderboard</a>
                <a href="#" onclick="logout()">🚪 Log Out</a>
            </div>
        </div>
    </header>

    <main>

        <div id="feedback" class="feedback"></div>
        <div class="box">
            <label for="fullName">Enter Your Name To Start Exam</label>
            <input type="text" id="fullName" placeholder="Enter your full name" required maxlength="20" type="text"
                autocomplete="off">
            <button onclick="startExam()">Start Exam</button>
        </div>
    </main>

    <script>
        function startExam() {
            let fullName = document.getElementById("fullName").value.trim();
            let feedback = document.getElementById("feedback");
            if (fullName === "") {
                feedback.textContent = "Please enter your full name.";
                return;
            }
            localStorage.setItem("studentName", fullName);
            window.location.href = "exam.php";
        }

        function toggleDropdown() {
            let dropdown = document.getElementById("dropdownMenu");
            dropdown.classList.toggle("show");
        }

        function logout() {
            document.getElementById("feedback").textContent = "You have been logged out!";
            setTimeout(() => {
                window.location.href = "startexam.php";
            }, 1500);
        }

        document.addEventListener("click", function(event) {
            let dropdown = document.getElementById("dropdownMenu");
            let profileBtn = document.querySelector(".profile-btn");
            if (!profileBtn.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove("show");
            }
        });
    </script>
</body>

</html>


<script>
    function initializeLoginForm() {
        const loginForm = document.getElementById('teacher-login-form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const errorMessageContainer = document.getElementById('error-message');

        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

            if (!email || !password) {
                errorMessageContainer.textContent = "Both email and password are required.";
                return;
            }

            console.log("Login Request:", {
                email,
                password
            });

            fetch('connectt.php', {
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
                        window.location.href = "Tdash.php";
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

    function initializeSignUpForm() {
        const signupForm = document.getElementById('teacher-signup-form');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('signup-email');
        const passwordInput = document.getElementById('signup-password');

        signupForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

            if (!name || !email || !password) {
                alert("All fields are required.");
                return;
            }

            console.log("Signup Request:", {
                name,
                email,
                password
            });

            fetch('connectt.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Signup successful! Please log in.");
                        // Show login form again
                        document.getElementById('sign-popp').innerHTML = getLoginFormHTML();
                        initializeLoginForm();
                    } else {
                        alert(data.message || "Signup failed.");
                    }
                })
                .catch(error => {
                    console.error('Signup error:', error);
                    alert("An error occurred. Try again.");
                });
        });
    }
</script>