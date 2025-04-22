<?php
session_start();
include('connect.php'); // Assuming connect.php connects to your database

// Assuming you have the student's ID stored in the session
$student_id = $_SESSION['student_id'];

// Query to fetch notifications for the student
$sql = "SELECT * FROM notifications WHERE student_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to store notifications
$notifications = [];

// Fetch the notifications
while ($row = $result->fetch_assoc()) {
    $notifications[] = [
        'title' => $row['title'],
        'message' => $row['message'],
        'created_at' => $row['created_at'] // Assuming you want to include the created_at time
    ];
}

// Return the notifications as a JSON object with a status
echo json_encode([
    'status' => 'success',
    'notifications' => $notifications
]);
