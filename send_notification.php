<?php
session_start();

// Ensure the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    echo json_encode(["success" => false, "message" => "Teacher not logged in."]);
    exit();
}

// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Handle connection errors
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit();
}

// Get and decode incoming JSON
$data = json_decode(file_get_contents("php://input"), true);

// Check if message is provided
if (empty($data['message'])) {
    echo json_encode(["success" => false, "message" => "Message is required."]);
    exit();
}

// Get message and title from the request data
$message = $conn->real_escape_string(trim($data['message']));
$title = isset($data['title']) ? $conn->real_escape_string(trim($data['title'])) : 'No Title'; // Default to 'No Title'

// Get teacher_id from session
$teacher_id = $_SESSION['teacher_id'];

// Insert notification into database
$query = "INSERT INTO notifications (teacher_id, title, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $teacher_id, $title, $message);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Notification stored successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to store notification: " . $conn->error]);
}

$stmt->close();
$conn->close();
