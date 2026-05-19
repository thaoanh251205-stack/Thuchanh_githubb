<?php
header("Content-Type: application/json");
include "db.php";

$sql = "SELECT MaSV, TenSV, Ngaysinh, Diachi, Gioitinh FROM sv ORDER BY MaSV DESC";
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode([
    "status" => true,
    "data" => $students,
    "count" => count($students)
]);
