<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['MaSV'])) {
    echo json_encode([
        "status" => false,
        "message" => "Mã sinh viên không được cung cấp!"
    ]);
    exit;
}

$masv = $conn->real_escape_string($data['MaSV']);

$sql = "DELETE FROM sv WHERE MaSV='$masv'";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "Xóa sinh viên thành công!"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Xóa sinh viên thất bại! Lỗi: " . $conn->error
    ]);
}
