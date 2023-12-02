<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'assignment');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $password = $_POST["password"];;

    // Check if email or phone number already exists
    $checkQuery = "SELECT * FROM user WHERE email = ? OR phoneNumber = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("si", $email, $phoneNumber);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // User already exists
        echo "User with the same email or phone number already exists!";
    } else {
        // Insert new user data
        $insertQuery = "INSERT INTO user (firstName, lastName, email, phoneNumber, password) VALUES ( ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssis", $firstName, $lastName, $email, $phoneNumber, $password);

        if ($insertStmt->execute()) {
            // Registration successful
            echo "Registration successful!";
        } else {
            // Error during registration
            echo "Error during registration: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}

$conn->close();
