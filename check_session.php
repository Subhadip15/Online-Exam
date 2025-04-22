<?php
session_start();

if (isset($_SESSION['student_id'])) {
    echo "Student ID: " . $_SESSION['student_id'];
} else {
    echo "No student is logged in.";
}

