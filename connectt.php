<?php
header("Content-Type: application/json");

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

// Ensure that the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit();
}

// Get and decode incoming JSON
$data = json_decode(file_get_contents("php://input"), true);

// Check if email and password are provided
if (!isset($data['email']) || !isset($data['password']) || empty($data['email']) || empty($data['password'])) {
    echo json_encode(["success" => false, "message" => "Email and Password are required."]);
    exit();
}

$email = $conn->real_escape_string(trim($data['email']));
$password = $data['password'];

// SIGNUP logic (if name is provided)
if (isset($data['name'])) {
    $name = $conn->real_escape_string(trim($data['name']));
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email is already registered
    $checkQuery = "SELECT * FROM teacher WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already registered."]);
    } else {
        // Insert new teacher into database
        $insertQuery = "INSERT INTO teacher (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Signup successful!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Signup failed: " . $conn->error]);
        }
    }
}
// LOGIN logic (if name is not provided)
else {
    // Check if the teacher exists
    $query = "SELECT * FROM teacher WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $teacher = $result->fetch_assoc();
        if (password_verify($password, $teacher['password'])) {
            // Start session and store teacher info
            session_start();
            $_SESSION['teacher_id'] = $teacher['id'];
            $_SESSION['teacher_name'] = $teacher['name'];

            // Optionally, send the teacher_id back in the response
            echo json_encode([
                "success" => true,
                "message" => "Login successful.",
                "teacher_id" => $teacher['id']
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Incorrect password."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email not registered."]);
    }
}

$conn->close();
