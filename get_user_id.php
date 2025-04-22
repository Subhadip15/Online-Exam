<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['student_id'])) {
    echo json_encode(['success' => true, 'student_id' => $_SESSION['student_id']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Student not logged in.']);
}
?>