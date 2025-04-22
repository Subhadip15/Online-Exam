<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Optional, for CORS if frontend is separate
header("Access-Control-Allow-Methods: POST");

// Database connection
$host = "localhost";
$username = "root";
$password = ""; // use your actual password
$database = "user_management"; // use your actual DB name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

$exam_date = $data["date"] ?? null;
$start_time = $data["start"] ?? null;
$end_time = $data["end"] ?? null;

if (!$exam_date || !$start_time || !$end_time) {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit();
}

// Prepare & execute insert
$stmt = $conn->prepare("INSERT INTO exam_schedule (exam_date, start_time, end_time) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $exam_date, $start_time, $end_time);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Exam scheduled successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error scheduling exam"]);
}

$stmt->close();
$conn->close();
?>
