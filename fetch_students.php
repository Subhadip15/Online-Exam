<?php
require 'connect.php'; // Include your DB connection file

// Fetch all students from the database
$query = "SELECT email FROM users WHERE email = ?"; // Replace `students` with your actual table name for students
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Loop through all students and send email
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
        
        // Notification message (you can fetch this from the database if needed)
        $title = "New Notification";
        $message = "A new notification has been posted on the website. Please check the notifications section.";
        
        // Send email (using PHP's mail function)
        $subject = $title;
        $headers = "From: no-reply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Email sent to: $email<br>";
        } else {
            echo "Failed to send email to: $email<br>";
        }
    }
} else {
    echo "No students found!";
}

$conn->close();
?>
