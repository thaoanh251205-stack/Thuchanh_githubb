<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

// Kiểm tra dữ liệu đầu vào
if (!isset($data['MaSV']) || !isset($data['TenSV']) || !isset($data['Ngaysinh']) || !isset($data['Diachi']) || !isset($data['Gioitinh'])) {
    echo json_encode([
        "status" => false,
        "message" => "Dữ liệu không đầy đủ!"
    ]);
    exit;
}

$masv = trim($data['MaSV']);
$tensv = trim($data['TenSV']);
$ngaysinh = trim($data['Ngaysinh']);
$diachi = trim($data['Diachi']);
$gioitinh = trim($data['Gioitinh']);

// Escape để tránh SQL injection
$masv = $conn->real_escape_string($masv);
$tensv = $conn->real_escape_string($tensv);
$ngaysinh = $conn->real_escape_string($ngaysinh);
$diachi = $conn->real_escape_string($diachi);
$gioitinh = $conn->real_escape_string($gioitinh);

// Kiểm tra mã sinh viên đã tồn tại
$sql = "SELECT * FROM sv WHERE MaSV='$masv'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode([
        "status" => false,
        "message" => "Mã sinh viên đã tồn tại!"
    ]);
} else {
    // Insert dữ liệu
    $sql = "INSERT INTO sv (MaSV, TenSV, Ngaysinh, Diachi, Gioitinh) VALUES ('$masv', '$tensv', '$ngaysinh', '$diachi', '$gioitinh')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => true,
            "message" => "Thêm sinh viên thành công!"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Thêm sinh viên thất bại! Lỗi: " . $conn->error
        ]);
    }
}