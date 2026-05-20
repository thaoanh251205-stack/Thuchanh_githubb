<?php
header("Content-Type: application/json");
include "db.php";

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchEscaped = $conn->real_escape_string($search);

if ($search !== '') {
    $sql = "SELECT MaSV, TenSV, Ngaysinh, Diachi, Gioitinh FROM sv WHERE MaSV LIKE '%$searchEscaped%' OR TenSV LIKE '%$searchEscaped%' ORDER BY MaSV DESC";
} else {
    $sql = "SELECT MaSV, TenSV, Ngaysinh, Diachi, Gioitinh FROM sv ORDER BY MaSV DESC";
}

$result = $conn->query($sql);

$students = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode([
    "status" => true,
    "data" => $students,
    "count" => count($students)
]);
