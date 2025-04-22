<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Schedule Exam</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0fdf4;
            padding: 2rem;
        }

        .schedule-form {
            max-width: 500px;
            margin: auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #047857;
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #065f46;
        }

        input[type="date"],
        input[type="time"],
        button {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            background-color: #047857;
            color: white;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background-color: #065f46;
        }

        .message {
            text-align: center;
            color: #1f2937;
            margin-top: 1rem;
        }
    </style>
</head>

<body>

    <div class="schedule-form">
        <h2>Schedule Exam</h2>
        <form id="examScheduleForm">
            <label for="examDate">Exam Date:</label>
            <input type="date" id="examDate" required />

            <label for="startTime">Start Time:</label>
            <input type="time" id="startTime" required />

            <label for="endTime">End Time:</label>
            <input type="time" id="endTime" required />

            <button type="submit">Schedule Exam</button>
        </form>

        <div class="message" id="messageBox"></div>
    </div>

    <script>
        document.getElementById('examScheduleForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const date = document.getElementById('examDate').value;
            const start = document.getElementById('startTime').value;
            const end = document.getElementById('endTime').value;
            const messageBox = document.getElementById('messageBox');

            if (!date || !start || !end) {
                messageBox.textContent = "Please fill in all fields.";
                return;
            }

            if (start >= end) {
                messageBox.textContent = "End time must be after start time.";
                return;
            }

            // Show success (or send via fetch to PHP backend)
            messageBox.textContent = `Exam scheduled on ${date} from ${start} to ${end}.`;

            fetch('schedule_exam.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date,
                        start,
                        end
                    })
                })
                .then(res => res.json())
                .then(data => {
                    messageBox.textContent = data.message;
                })
                .catch(error => {
                    messageBox.textContent = "Error connecting to server.";
                });

        });
    </script>

</body>

</html>