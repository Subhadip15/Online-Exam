<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['student_id'])) {
    http_response_code(401);
    echo "Error: Student not logged in.";
    exit();
}

$student_id = $_SESSION['student_id'];

$required_fields = [
    'score', 'correct_answers', 'wrong_answers', 'unanswered',
    'total_questions', 'result_data', 'submit_time', 'time_taken'
];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        http_response_code(400);
        echo "Error: Missing required data ($field).";
        exit();
    }
}

// Sanitize inputs
$score = filter_var($_POST['score'], FILTER_VALIDATE_INT);
$correct_answers = filter_var($_POST['correct_answers'], FILTER_VALIDATE_INT);
$wrong_answers = filter_var($_POST['wrong_answers'], FILTER_VALIDATE_INT);
$unanswered = filter_var($_POST['unanswered'], FILTER_VALIDATE_INT);
$total_questions = filter_var($_POST['total_questions'], FILTER_VALIDATE_INT);
$time_taken = filter_var($_POST['time_taken'], FILTER_VALIDATE_INT);
$result_data = $_POST['result_data'];
$submit_time = $_POST['submit_time'];

if (
    $score === false || $correct_answers === false || $wrong_answers === false ||
    $unanswered === false || $total_questions === false || $time_taken === false
) {
    http_response_code(400);
    echo "Error: Invalid number format in input data.";
    exit();
}

// DB connection
$conn = new mysqli("localhost", "root", "", "user_management");
if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed: " . $conn->connect_error;
    exit();
}

// Insert with time_taken
$sql = "INSERT INTO quiz_results (
    student_id, score, correct_answers, wrong_answers, unanswered,
    total_questions, result_data, submit_time, time_taken
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$stmt->bind_param(
    "iiiiiisss",
    $student_id,
    $score,
    $correct_answers,
    $wrong_answers,
    $unanswered,
    $total_questions,
    $result_data,
    $submit_time,
    $time_taken
);

if ($stmt->execute()) {
    echo "success";
} else {
    http_response_code(500);
    echo "Error executing statement: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
