<?php

$conn = new mysqli('localhost', 'root', '', 'assignment');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
        // Login successful
        $response['status'] = 'success';
        $response['message'] = 'Login successful!';
    } else {
        // Login failed
        $response['status'] = 'error';
        $response['message'] = 'Invalid email or password.';
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
