<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            max-height: 100%;

        }

        .main {
            display: flex;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .wname {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            margin-right: 10px;
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        #displayName {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .displayname {
            font-family: "Playwrite IN", serif;
            font-optical-sizing: auto;
            font-weight: none;
            font-style: normal;
        }

        .header .account {
            width: 35px;
            height: 35px;
            border: 1px solid whitesmoke;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            position: relative;
            background-color: rgb(19, 19, 19);
        }

        .header .profile-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #333;
            min-width: 160px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

        .show {
            display: block;
        }


        .slide {
            height: 92.1vh;
            width: 301px;
            padding-left: 42px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: black;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 19.5vh;
            width: 15vw;
            border: 1px solid rgb(69, 71, 56);
            border-radius: 3px;
            /* Adjust sidebar width */
            background-color: #333;
            /* Match the background color in the image */
            padding: 178px 20px 350px 20px;
            grid-template-columns: repeat(3, 1fr);
            /* 3 columns */
            gap: 10px;
            /* Space between boxes */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s ease;
            align-items: center;
            justify-items: center;
        }

        .under_sidebar {
            height: 44vh;
            width: 15vw;
            border: 2px solid rgb(219, 212, 212);
            /* Adjust sidebar width */
            background-color: #333;
            border-radius: 5px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 3 columns */
            gap: 2px;

            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s ease;
            align-items: center;
            justify-items: center;
        }

        .box {
            width: 50px;
            height: 50px;
            margin: 10px 0;
            background-color: ghostwhite;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s;
        }

        .box.correct {
            background-color: #28a745;
            color: white;
        }

        .box.wrong {
            background-color: #dc3545;
            color: white;
        }

        .pending {
            background-color: yellow !important;
        }

        /* Ensure box 14 and 15 behave correctly */
        .box[data-question="14"].correct,
        .box[data-question="15"].correct,
        .box:nth-child(14).correct,
        .box:nth-child(15).correct {
            background-color: #28a745 !important;
            /* Green for correct */
        }

        .box[data-question="14"].wrong,
        .box[data-question="15"].wrong,
        .box:nth-child(14).wrong,
        .box:nth-child(15).wrong {
            background-color: #dc3545 !important;
            /* Red for wrong */
        }

        .box:hover {
            transform: scale(1.1);
            /* Slight hover effect */
        }


        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .progress-bar {
            position: absolute;
            top: 0px;
            padding-left: 6px;
            padding-bottom: 25px;
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: space-between;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        .close-btn {
            margin: 0 0 0 45px;
            padding: 0 0 25px 35px;
            background-color: #333;
            color: white;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            /* Rounded button for a clean look */
            transition: background-color 0.3s ease;
            z-index: 10;
            /* Ensure it appears above the sidebar content */
        }

        .close-btn:hover {
            background-color: #333;
        }

        .result-sec {
            position: absolute;
            bottom: 1px;
            left: 0px;
            max-width: 30vw;
        }

        .summary-container {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 13px;
            padding: 5px;
            gap: 8px;
            background-color: #2a2a2a;
            width: 102%;
            max-width: 284px;

        }

        .summary-item {
            color: white;
            display: flex;
            align-items: center;
            /* gap: 0px; */
            font-size: 13px;
        }

        .boxx {
            width: 17px;
            height: 17px;
            border-radius: 4px;
        }

        .correct {
            background-color: #4caf50;
        }

        /* Green */
        .wrong {
            background-color: #f44336;
        }

        /* Red */
        .unanswered {
            border: 1px solid wheat;
            background-color: transparent;
        }


        .toggle-btn {
            position: fixed;
            top: 69px;
            left: 3px;
            background-color: black;
            font-size: 17px;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .toggle-btn:hover {
            background-color: black;
            color: white;

        }


        .container {
            flex: 1;
            max-width: 65vw;
            height: 75vh;
            margin: 50px auto;

            background: ghostwhite;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        h1 {
            padding-top: 5px;
            text-align: center;
            color: white;
        }

        .quiz-container {
            height: 70vh;
            width: 65vw;
            padding: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0 css Copy Edit .5);
        }

        .quiz-header {
            height: 8vh;
            text-align: left;
            background-color: rgb(13 0 80);
        }

        .question-progress {
            background-color: #d3bfbf;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            text-align: left;
            margin: 15px 15px 0 15px;
            padding: 20px;
            border-radius: 20px 20px 0 0;
        }


        .question-progress span {
            color: #4caf50;
            /* Highlight color for the numbers */
        }

        .navigation {
            bottom: 5px;
            display: flex;
            justify-content: space-between;
            margin: 60px 40px;
        }

        .question p {
            margin: 0 15px;
            padding: 15px 30px;
            border-radius: 0 0 20px 20px;
            background-color: #d3bfbf;
        }

        .question-section {
            margin-bottom: 2px;
        }

        .question-title {
            margin-top: 40px;
            margin-bottom: 20px;
            font-size: 20px;
            line-height: 1.5;
        }

        .options-section {

            margin-top: 1px;
        }

        .st {
            font-size: 2rem;
            height: 430px;
        }

        .options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* 2 columns */
            gap: 16px;
            /* Space between options */
            list-style: none;
            /* Remove default list styling */
            padding: 50px;
            margin: 10px 0 0 0;
        }

        .options li {
            font-size: 1.3rem;
            background-color: #f9f9f9;
            /* Light background */
            border: 1px solid #ddd;
            /* Subtle border */
            border-radius: 8px;
            /* Rounded corners */
            padding: 12px;
            text-align: left;
            /* Align text to the left */
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .options li:hover {
            background-color: #f0f0f0;
            /* Highlight on hover */
        }

        .options input[type="radio"] {
            display: grid;
            content: "";
            width: 20px;
            height: 20px;
            border: 2px solid #bbb;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
            background-color: transparent;
            transition: background 0.3s ease, border 0.3s ease;
            /* Hide the default radio button */
        }

        /* Style label to make it look like a button */
        .options label {
            display: flex;
            align-items: center;
            justify-content: start;
            cursor: pointer;
            width: 100%;
            padding: 10px;
            position: relative;
            font-weight: bold;
        }

        /* Custom circular radio button */


        /* Change the color of the radio button when selected */
        .options input[type="radio"]:checked+label::before {
            background-color: #4CAF50;
            /* Green fill */
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.8);
            /* Glowing effect */
        }

        /* Change the background color of the selected option */
        .options input[type="radio"]:checked+label {
            background-color: #2a2f2f;
            /* Dark green */
            border: 2px solid #6abf4b;
            /* Green border */
            border-radius: 8px;
            color: #dfffd6;
            /* Light green text */
        }


        .feed {
            margin-left: 50px;
            font-size: 16px;
            padding: 0 10px 10px;
            margin-bottom: 2px;
            border-radius: 8px;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
        }

        .correct {
            color: green;
        }

        .incorrect {
            color: red;
        }

        .boxx.correct {
            background-color: green;
        }

        .boxx.wrong {
            background-color: red;
        }


        button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result {
            background-color: #e7f3e7;
            color: #2d6a2d;
            border: 1px solid #a9d8a9;
            border-radius: 5px;
            text-align: center;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <header class="header">
        <div href="#" class="wname">
            <p class="logo">Welcome</p>
            <p class="displayname" id="displayName"></p>

        </div>

        <div class="account" id="account">
            <button class="profile-btn" onclick="toggleDropdown()"><i class="fa-solid fa-user"></i></button>
            <div class="dropdown" id="dropdownMenu">
                <a href="#">⚙ Profile</a>
                <a href="#">🏆 Leaderboard</a>
                <a href="#">🚪 Log Out</a>
            </div>
        </div>
    </header>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let studentName = localStorage.getItem("studentName");

            if (studentName) {
                document.getElementById("displayName").innerText = `${studentName}`;
            } else {
                document.getElementById("displayName").innerText = "Student!";
            }
        });
    </script>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdownMenu").classList.toggle("show");
        }

        // Close dropdown if clicked outside
        window.onclick = function(event) {
            let account = document.getElementById("account");
            let dropdownMenu = document.getElementById("dropdownMenu");

            // Check if the click is outside the account section
            if (!account.contains(event.target)) {
                dropdownMenu.classList.remove("show");
            }
        };
    </script>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <div class="main">
        <div class="slide" id="slide">
            <div class="sidebar" id="sidebar">
                <div class="progress-bar">
                    Question <span id="current-question" style="color: red;"> 1 </span> of <span id="total-questions" style="color: red;"> 15</span>
                    <button class="close-btn" onclick="toggleSidebar()">×</button>
                </div>
                <div class="under_sidebar">
                    <div class="hide1">
                        <div class="box" id="box-1">1</div>
                        <div class="box" id="box-2">2</div>
                        <div class="box" id="box-3">3</div>
                        <div class="box" id="box-4">4</div>
                        <div class="box" id="box-5">5</div>
                    </div>
                    <div class="hide2">
                        <div class="box" id="box-6">6</div>
                        <div class="box" id="box-7">7</div>
                        <div class="box" id="box-8">8</div>
                        <div class="box" id="box-9">9</div>
                        <div class="box" id="box-10">10</div>
                    </div>
                    <div class="hide3">
                        <div class="box" id="box-11">11</div>
                        <div class="box" id="box-12">12</div>
                        <div class="box" id="box-13">13</div>
                        <div class="box" id="box-14">14</div>
                        <div class="box" id="box-15">15</div>
                    </div>
                </div>
                <div class="result-sec">
                    <div class="summary-container">
                        <div class="summary-item">
                            <div class="boxx correct"></div>
                            <span id="correct-count">0</span> Correct
                        </div>
                        <div class="summary-item">
                            <div class="boxx wrong"></div>
                            <span id="wrong-count">0</span> Wrong
                        </div>
                        <div class="summary-item">
                            <div class="boxx unanswered"></div>
                            <span id="unanswered-count">0</span> Unanswered
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="quiz-container">
                <div id="result" class="result" style="display: none;"></div>
                <div class="quiz-header">
                    <h1>MCQ Test</h1>
                </div>
                <div class="st">
                    <div class="question-progress">
                        Question <span id="current-questionn" style="color: #7c3434;">1</span>
                    </div>
                    <!-- Question 1 -->
                    <div class="question hidden" id="question-1">
                        <p>Which sorting algorithm is generally considered the most efficient in practice for large data sets?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q1" value="Bubble Sort">Bubble Sort</label></li>
                            <li><label><input type="radio" name="q1" value="Merge Sort">Merge Sort</label></li>
                            <li><label><input type="radio" name="q1" value="Quick Sort">Quick Sort</label></li>
                            <li><label><input type="radio" name="q1" value="Insertion Sort">Insertion Sort</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-2">
                        <p>In object-oriented programming, which of the following concepts is used to restrict access to certain parts of an object?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q2" value="Abstraction">Abstraction</label></li>
                            <li><label><input type="radio" name="q2" value="Encapsulation">Encapsulation</label></li>
                            <li><label><input type="radio" name="q2" value="Inheritance">Inheritance</label></li>
                            <li><label><input type="radio" name="q2" value="Polymorphism">Polymorphism</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-3">
                        <p>Which of the following is a characteristic of a linked list compared to an array?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q3" value="Fixed size">Fixed size</label></li>
                            <li><label><input type="radio" name="q3" value="Constant time access">Constant time access</label></li>
                            <li><label><input type="radio" name="q3" value="Dynamic size">Dynamic size</label></li>
                            <li><label><input type="radio" name="q3" value="Contiguous memory allocation">Contiguous memory allocation</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-4">
                        <p>Which type of database is most appropriate for managing large amounts of unstructured data?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q4" value="Relational database">Relational database</label></li>
                            <li><label><input type="radio" name="q4" value="Object-oriented database">Object-oriented database</label></li>
                            <li><label><input type="radio" name="q4" value="NoSQL database">NoSQL database</label></li>
                            <li><label><input type="radio" name="q4" value="Hierarchical database">Hierarchical database</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-5">
                        <p>In which of the following scenarios is a hash table most useful?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q5" value="Sorting a large list of numbers">Sorting a large list of numbers</label></li>
                            <li><label><input type="radio" name="q5" value="Searching for a value based on a unique key">Searching for a value based on a unique key</label></li>
                            <li><label><input type="radio" name="q5" value="Storing ordered data">Storing ordered data</label></li>
                            <li><label><input type="radio" name="q5" value="Traversing data sequentially">Traversing data sequentially</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-6">
                        <p>Which of the following best describes the principle of “inheritance” in object-oriented programming?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q6" value="Classes can share behaviors with other classes">Classes can share behaviors with other classes</label></li>
                            <li><label><input type="radio" name="q6" value="Methods in the base class can override methods in the derived class">Methods in the base class can override methods in the derived class</label></li>
                            <li><label><input type="radio" name="q6" value="Objects can be combined into larger objects">Objects can be combined into larger objects</label></li>
                            <li><label><input type="radio" name="q6" value="Variables are private to the class">Variables are private to the class</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-7">
                        <p>Which of the following is a valid state in the life cycle of a thread in Java?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q7" value="New">New</label></li>
                            <li><label><input type="radio" name="q7" value="Running">Running</label></li>
                            <li><label><input type="radio" name="q7" value="Blocked">Blocked</label></li>
                            <li><label><input type="radio" name="q7" value="All of the above">All of the above</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-8">
                        <p>What is the purpose of the 'final' keyword in Java?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q8" value="To declare a constant value">To declare a constant value</label></li>
                            <li><label><input type="radio" name="q8" value="To create a new object">To create a new object</label></li>
                            <li><label><input type="radio" name="q8" value="To make a method abstract">To make a method abstract</label></li>
                            <li><label><input type="radio" name="q8" value="To override a method">To override a method</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-9">
                        <p>Which of the following algorithms has the best worst-case time complexity for searching in a balanced binary search tree?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q9" value="O(n)">O(n)</label></li>
                            <li><label><input type="radio" name="q9" value="O(log n)">O(log n)</label></li>
                            <li><label><input type="radio" name="q9" value="O(n log n)">O(n log n)</label></li>
                            <li><label><input type="radio" name="q9" value="O(1)">O(1)</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-10">
                        <p>Which of the following is the key difference between a process and a thread?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q10" value="Processes share memory, but threads do not">Processes share memory, but threads do not</label></li>
                            <li><label><input type="radio" name="q10" value="Threads are independent, but processes are dependent">Threads are independent, but processes are dependent</label></li>
                            <li><label><input type="radio" name="q10" value="Threads are lighter and share memory with the process">Threads are lighter and share memory with the process</label></li>
                            <li><label><input type="radio" name="q10" value="Processes can run concurrently, but threads cannot">Processes can run concurrently, but threads cannot</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-11">
                        <p>What is the main purpose of the “garbage collection” process in Java?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q11" value="Free up memory by removing unused objects">Free up memory by removing unused objects</label></li>
                            <li><label><input type="radio" name="q11" value="Automatically generate code">Automatically generate code</label></li>
                            <li><label><input type="radio" name="q11" value="Optimize the JVM’s performance">Optimize the JVM’s performance</label></li>
                            <li><label><input type="radio" name="q11" value="Increase the speed of method execution">Increase the speed of method execution</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-12">
                        <p>Which data structure is most commonly used to implement recursion?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q12" value="Queue">Queue</label></li>
                            <li><label><input type="radio" name="q12" value="Stack">Stack</label></li>
                            <li><label><input type="radio" name="q12" value="Linked list">Linked list</label></li>
                            <li><label><input type="radio" name="q12" value="Tree">Tree</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-13">
                        <p>Which of the following is not a characteristic of a deadlock?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q13" value="Mutual exclusion">Mutual exclusion</label></li>
                            <li><label><input type="radio" name="q13" value="Circular wait">Circular wait</label></li>
                            <li><label><input type="radio" name="q13" value="Starvation">Starvation</label></li>
                            <li><label><input type="radio" name="q13" value="Hold and wait">Hold and wait</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-14">
                        <p>Which of the following is an example of a non-relational (NoSQL) database?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q14" value="MongoDB">MongoDB</label></li>
                            <li><label><input type="radio" name="q14" value="MySQL">MySQL</label></li>
                            <li><label><input type="radio" name="q14" value="PostgreSQL">PostgreSQL</label></li>
                            <li><label><input type="radio" name="q14" value="Oracle">Oracle</label></li>
                        </ul>
                    </div>

                    <div class="question hidden" id="question-15">
                        <p>Which of the following is an example of an immutable class in Java?</p>
                        <ul class="options">
                            <li><label><input type="radio" name="q15" value="String">String</label></li>
                            <li><label><input type="radio" name="q15" value="ArrayList">ArrayList</label></li>
                            <li><label><input type="radio" name="q15" value="HashMap">HashMap</label></li>
                            <li><label><input type="radio" name="q15" value="Thread">Thread</label></li>
                        </ul>
                    </div>

                    <div id="feed" class="feed"></div>
                </div>
                <div class="navigation">
                    <button id="prev" onclick="prevQuestion()" disabled>Previous</button>
                    <button onclick="handleSubmit()">Submit Answer</button>
                    <button id="next" onclick="nextQuestion()">Next</button>
                    <button id="submit" class="hidden" onclick="submitQuiz()">Submit Quiz</button>
                </div>

            </div>

        </div>
    </div>
    </div>
    <script>
        let currentQuestion = 1;
        const totalQuestions = 15;
        const answers = {
            q1: "Quick Sort",
            q2: "Encapsulation",
            q3: "Dynamic size",
            q4: "NoSQL database",
            q5: "Searching for a value based on a unique key",
            q6: "Classes can share behaviors with other classes",
            q7: "All of the above",
            q8: "To declare a constant value",
            q9: "O(log n)",
            q10: "Threads are lighter and share memory with the process",
            q11: "Free up memory by removing unused objects",
            q12: "Stack",
            q13: "Starvation",
            q14: "MongoDB",
            q15: "String"
        };

        let quizSubmitted = false;
        let studentId = null;
        const startTime = new Date(); // 🕒 Start quiz time

        // Fetch student ID from session (via PHP)
        fetch('get_user_id.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    studentId = data.student_id;
                } else {
                    alert("Error: Student not logged in.");
                }
            })
            .catch(error => {
                console.error("Error fetching student ID:", error);
                alert("Could not retrieve student ID.");
            });

        function updateCurrentQuestion() {
            const el1 = document.getElementById("current-question");
            if (el1) el1.innerText = currentQuestion;
            const el2 = document.getElementById("current-questionn");
            if (el2) el2.innerText = currentQuestion;
        }

        function showQuestion(questionNumber) {
            for (let i = 1; i <= totalQuestions; i++) {
                const q = document.getElementById(`question-${i}`);
                if (q) q.classList.add("hidden");
            }

            const currentEl = document.getElementById(`question-${questionNumber}`);
            if (currentEl) currentEl.classList.remove("hidden");

            updateCurrentQuestion();

            document.getElementById("prev").disabled = questionNumber === 1;
            document.getElementById("next").style.display = questionNumber === totalQuestions ? "none" : "inline-block";
            document.getElementById("submit").classList.toggle("hidden", questionNumber !== totalQuestions);
        }

        function nextQuestion() {
            if (quizSubmitted) return;

            const questionId = `q${currentQuestion}`;
            const selected = document.querySelector(`input[name="${questionId}"]:checked`);
            const box = document.getElementById(`box-${currentQuestion}`);

            if (selected && !box.classList.contains("correct") && !box.classList.contains("wrong")) {
                box.classList.add("pending");
            }

            if (!selected) {
                box.classList.add("pending");
            }

            if (currentQuestion < totalQuestions) {
                currentQuestion++;
                showQuestion(currentQuestion);
            }
        }

        function prevQuestion() {
            if (quizSubmitted) return;
            if (currentQuestion > 1) {
                currentQuestion--;
                showQuestion(currentQuestion);
            }
        }

        function handleSubmit() {
            if (quizSubmitted) return;

            const questionId = `q${currentQuestion}`;
            const selected = document.querySelector(`input[name="${questionId}"]:checked`);
            const box = document.getElementById(`box-${currentQuestion}`);

            if (!selected) {
                const feed = document.getElementById("feed");
                feed.innerHTML = "Please select an option to submit.";
                feed.style.color = "red";
                return;
            }

            document.getElementById("feed").innerHTML = "";

            box.classList.remove("correct", "wrong", "pending");

            if (selected.value === answers[questionId]) {
                box.classList.add("correct");
            } else {
                box.classList.add("wrong");
            }

            document.querySelectorAll(`input[name="${questionId}"]`).forEach(opt => opt.disabled = true);

            updateSummaryCounts();
        }

        function updateSummaryCounts() {
            const correct = document.querySelectorAll(".box.correct").length;
            const wrong = document.querySelectorAll(".box.wrong").length;
            const totalBoxes = document.querySelectorAll(".box").length;
            const unanswered = totalBoxes - (correct + wrong);

            document.getElementById("correct-count").textContent = correct;
            document.getElementById("wrong-count").textContent = wrong;
            document.getElementById("unanswered-count").textContent = unanswered;
        }

        function submitQuiz() {
            if (quizSubmitted) return;

            if (!studentId) {
                alert("Error: Student ID not available. Please log in again.");
                return;
            }

            const endTime = new Date(); // 🕓 End quiz time
            const timeTaken = Math.floor((endTime - startTime) / 1000);

            let score = 0;
            let correctCount = 0;
            let wrongCount = 0;
            let unansweredCount = 0;
            let resultData = [];
            let resultsArray = [];

            for (let i = 1; i <= totalQuestions; i++) {
                const questionId = `q${i}`;
                const selected = document.querySelector(`input[name="${questionId}"]:checked`);
                const userAnswer = selected ? selected.value : "Not Answered";
                const correctAnswer = answers[questionId];
                const isCorrect = selected && userAnswer === correctAnswer;

                const box = document.getElementById(`box-${i}`);
                if (!selected) {
                    box.classList.add("pending");
                    unansweredCount++;
                }

                if (isCorrect) {
                    score++;
                    correctCount++;
                } else if (userAnswer !== "Not Answered") {
                    wrongCount++;
                }

                resultData.push(`Q${i}: ${isCorrect ? "C" : (userAnswer === "Not Answered" ? "S" : "W")}`);

                resultsArray.push({
                    questionNo: i,
                    userAnswer: userAnswer,
                    correctAnswer: correctAnswer,
                    status: isCorrect ? "Correct" : (userAnswer === "Not Answered" ? "Skipped" : "Wrong")
                });
            }

            const payload = new URLSearchParams();
            payload.append('student_id', studentId);
            payload.append('score', score);
            payload.append('correct_answers', correctCount);
            payload.append('wrong_answers', wrongCount);
            payload.append('unanswered', unansweredCount);
            payload.append('total_questions', totalQuestions);
            payload.append('result_data', JSON.stringify(resultData));
            payload.append('submit_time', new Date().toISOString());
            payload.append('time_taken', timeTaken);

            fetch('connectR.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: payload.toString()
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    if (data.includes("success")) {
                        // Save to localStorage
                        localStorage.setItem("quizScore", score);
                        localStorage.setItem("quizResultData", JSON.stringify(resultsArray));
                        const minutes = Math.floor(timeTaken / 60);
                        const seconds = timeTaken % 60;
                        const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                        localStorage.setItem("quizTimeTaken", formattedTime);

                        window.location.href = "result.php";
                    } else {
                        alert("Error: " + data);
                    }
                })
                .catch(error => {
                    console.error('Error saving results:', error);
                    alert("Failed to save quiz result.");
                });

            quizSubmitted = true;
        }

        function goToQuestion(questionNumber) {
            if (quizSubmitted) return;
            currentQuestion = questionNumber;
            showQuestion(currentQuestion);
        }

        function toggleSidebar() {
            document.getElementById("slide").classList.toggle("hidden");
        }

        document.querySelectorAll('.box').forEach((box, idx) =>
            box.addEventListener('click', () => goToQuestion(idx + 1))
        );

        showQuestion(currentQuestion);
        updateCurrentQuestion();
    </script>




</body>

</html>