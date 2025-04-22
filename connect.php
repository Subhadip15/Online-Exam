<?php
session_start(); // Start the session to set session variables

header("Content-Type: application/json");

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Email and Password are required."]);
    exit();
}

$email = trim($data['email']);
$password = $data['password'];

if (isset($data['name'])) {
    // Signup logic
    $name = trim($data['name']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already registered."]);
    } else {
        $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $name, $email, $hashedPassword);
        if ($insert->execute()) {
            echo json_encode(["success" => true, "message" => "Signup successful!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Signup failed."]);
        }
        $insert->close();
    }

    $stmt->close();
} else {
    // Login logic
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $user_name, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Save session variables for user ID and name
            $_SESSION['student_id'] = $user_id;
            $_SESSION['student_name'] = $user_name; // Store student's name in session

            echo json_encode([
                "success" => true,
                "message" => "Login successful.",
                "student_id" => $user_id,
                "student_name" => $user_name // Return student name in the response (optional)
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Incorrect password."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email not registered."]);
    }

    $stmt->close();
}

$conn->close();
