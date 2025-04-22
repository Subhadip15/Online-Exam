<?php
session_start();

// Ensure the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Send Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0fdf4;
            padding: 2rem;
        }

        .notification-form {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #047857;
            text-align: center;
            margin-bottom: 1rem;
        }

        input[type="text"],
        textarea {
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
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #065f46;
        }

        .message {
            text-align: center;
            margin-top: 1rem;
            color: #1f2937;
        }

        .alert {
            color: red;
            text-align: center;
            font-size: 1rem;
            margin-top: 10px;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <div class="notification-form">
        <h2>Send Notification</h2>
        <form id="notification-form">
            <input type="text" id="title" placeholder="Enter title">
            <textarea id="message" placeholder="Enter your notification message"></textarea>
            <button type="submit">Send Notification</button>
        </form>
        <div id="response-message" class="message"></div>
    </div>

    <script>
        // Event listener for form submission
        document.getElementById('notification-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting the traditional way

            // Collect data from the form fields
            const message = document.getElementById('message').value.trim();
            const title = document.getElementById('title').value.trim();

            // Clear previous response messages
            document.getElementById('response-message').textContent = '';

            // Check if the message field is not empty
            if (!message) {
                document.getElementById('response-message').textContent = "Message is required.";
                document.getElementById('response-message').classList.add('alert');
                return;
            }

            // Make the POST request with JSON payload
            fetch('send_notification.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: message,
                        title: title
                    })
                })
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    const responseMessage = document.getElementById('response-message');
                    if (data.success) {
                        responseMessage.textContent = "Notification sent successfully!";
                        responseMessage.classList.remove('alert');
                        responseMessage.classList.add('success');
                    } else {
                        responseMessage.textContent = "Failed to send notification: " + data.message;
                        responseMessage.classList.add('alert');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const responseMessage = document.getElementById('response-message');
                    responseMessage.textContent = "An error occurred. Try again.";
                    responseMessage.classList.add('alert');
                });
        });
    </script>
</body>

</html>