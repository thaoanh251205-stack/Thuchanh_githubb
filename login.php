<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['user'];
$password = ($data['password']);
$sql = "SELECT * FROM tk WHERE user='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    echo json_encode([
        "status" => true,
        "message" => "Login success",
        "user" => [
            "user" => $user['username'],
            "password" => $user['password']
        ]
    ]);
} else {

    echo json_encode([
        "status" => false,
        "message" => "Invalid username or password"
    ]);
}
