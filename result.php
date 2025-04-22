<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz Result</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th,
        td {
            padding: 12px 16px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f6f6f6;
        }

        .correct {
            background-color: #c8e6c9;
        }

        .wrong {
            background-color: #ffcdd2;
        }

        .skipped {
            background-color: #fff9c4;
        }

        .score-box {
            text-align: center;
            font-size: 1.4em;
            font-weight: bold;
            margin-top: 10px;
            color: #2e7d32;
        }

        .time-box {
            text-align: center;
            font-size: 1.1em;
            color: #555;
            margin-bottom: 15px;
        }

        .button-group {
            text-align: center;
            margin-top: 30px;
        }

        .button-group button {
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 6px;
            margin: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
        }

        .button-group button:hover {
            background-color: #388e3c;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Quiz Results</h1>
        <div class="score-box" id="score-display"></div>
        <div class="time-box" id="time-taken-display"></div>
        <table id="result-table">
            <thead>
                <tr>
                    <th>Q.No</th>
                    <th>Your Answer</th>
                    <th>Correct Answer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="button-group">
            <button onclick="goHome()">Go to Home</button>
            <button onclick="downloadPDF()">Export as PDF</button>
            <button onclick="emailResult()">Share via Email</button>
        </div>
    </div>

    <script>
        // Get data from localStorage
        const score = localStorage.getItem("quizScore");
        const resultDataRaw = localStorage.getItem("quizResultData");
        const timeTaken = localStorage.getItem("quizTimeTaken");

        const scoreBox = document.getElementById("score-display");
        const timeBox = document.getElementById("time-taken-display");
        const tableBody = document.querySelector("#result-table tbody");

        let resultData = [];

        try {
            resultData = JSON.parse(resultDataRaw) || [];
        } catch (err) {
            console.error("Failed to parse result data:", err);
            resultData = [];
        }

        if (score !== null && !isNaN(score)) {
            scoreBox.textContent = `You scored ${score} out of ${resultData.length}`;
        } else {
            scoreBox.textContent = "Score data not available.";
        }

        if (timeTaken) {
            timeBox.textContent = `Time Taken: ${timeTaken}`;
        } else {
            timeBox.textContent = `Time Taken: Not recorded`;
        }

        if (resultData.length > 0) {
            resultData.forEach((item, index) => {
                const questionNo = item.questionNo || index + 1;
                const userAnswer = item.userAnswer ?? "-";
                const correctAnswer = item.correctAnswer ?? "-";
                const status = item.status || "Unknown";

                const row = document.createElement("tr");
                const statusClass = status === "Correct" ? "correct" :
                    status === "Wrong" ? "wrong" : "skipped";
                row.classList.add(statusClass);
                row.innerHTML = `
        <td>${questionNo}</td>
        <td>${userAnswer}</td>
        <td>${correctAnswer}</td>
        <td>${status}</td>
      `;
                tableBody.appendChild(row);
            });
        } else {
            const row = document.createElement("tr");
            row.innerHTML = `<td colspan="4">No result data found.</td>`;
            tableBody.appendChild(row);
        }

        function goHome() {
            window.location.href = "Sdash.php";
        }

        function downloadPDF() {
            alert("PDF Export not implemented. Use html2pdf if needed.");
        }

        function emailResult() {
            const subject = "My Quiz Results";
            const body = `I scored ${score} out of ${resultData.length} on the quiz. Time taken: ${timeTaken || "N/A"}`;
            window.location.href = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        }

        // Optional: Clear localStorage after use
        localStorage.removeItem("quizScore");
        localStorage.removeItem("quizResultData");
        localStorage.removeItem("quizTimeTaken");
    </script>

</body>

</html>