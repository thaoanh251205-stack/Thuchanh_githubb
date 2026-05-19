<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['user'];
$password = ($data['password']);
$sql = "SELECT * FROM tk WHERE user='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    echo json_encode([
        "status" => false,
        "message" => "Da ton tai!!",
        "user" => [
            "user" => $user['username'],
            "password" => $user['password']
        ]
    ]);
} else {

    $sql = "INSERT INTO tk (user, password) VALUES ('$username', '$password')";
    if ($conn->query ($sql) == true) {
    echo json_encode([
        "status" => true,
        "message" => "Them thanh cong!!"
    ]);
    }else  {
    echo json_encode ([
        "status"=> false,
        "message"=>" Them that bai!!"
    ]);
}

}