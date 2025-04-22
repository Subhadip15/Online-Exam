<?php
session_start();
header('Content-Type: application/json');

// DB connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "user_management"; // change to your DB name

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Check login
if (!isset($_SESSION['student_id'])) {
    echo json_encode(['success' => false, 'message' => 'Student not logged in']);
    exit();
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'name' => $row['name']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Student not found']);
}

$stmt->close();
$conn->close();
?>
