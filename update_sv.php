<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

// Kiểm tra dữ liệu đầu vào
if (!isset($data['mahv']) || !isset($data['tenhv']) || !isset($data['lop']) || !isset($data['diemtb'])) {
    echo json_encode([
        "status" => false,
        "message" => "Dữ liệu không đầy đủ!"
    ]);
    exit;
}

$mahv = trim($data['mahv']);
$tenhv = trim($data['tenhv']);
$lop = trim($data['lop']);
$diemtb = trim($data['diemtb']);

// Escape để tránh SQL injection
$mahv = $conn->real_escape_string($mahv);
$tenhv = $conn->real_escape_string($tenhv);
$lop = $conn->real_escape_string($lop);
$diemtb = $conn->real_escape_string($diemtb);

$sql = "SELECT * FROM hocvien WHERE mahv='$mahv' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Không tìm thấy sinh viên!"
    ]);
} else {
    $sql = "UPDATE hocvien
            SET tenhv='$tenhv',
                lop='$lop',
                diemtb='$diemtb'
            WHERE mahv='$mahv'";

    $conn->query($sql);

    if ($conn->affected_rows > 0) {
        echo json_encode([
            "status" => true,
            "message" => "Sửa thành công!"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Không có dữ liệu thay đổi!"
        ]);
    }
}
?>