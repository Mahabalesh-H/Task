<?php
$conn = new mysqli('localhost', 'root', '', 'assignment');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET["email"];
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        // Return a JSON response indicating that the user was not found
        echo json_encode(["error" => "User not found"]);
    }

    $stmt->close();
}

$conn->close();
