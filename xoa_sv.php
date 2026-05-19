<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$masv = $data['MaSV'];

$sql = "DELETE FROM sv WHERE MaSV='$masv'";
$conn->query($sql);

if ($conn->affected_rows > 0) {
    echo json_encode([
        "status" => true,
        "message" => "Xoa thanh cong!!"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Khong tim thay sinh vien!"
    ]);
}
