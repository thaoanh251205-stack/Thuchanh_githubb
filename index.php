<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Trang quản lý sinh viên</h1>
    <div id="student-list"></div>
    
        <label for="masv">Mã SV:</label>
        <input type="text" id="masv" name="masv"><br><br>
        <label for="tensv">Tên SV:</label>
        <input type="text" id="tensv" name="tensv"><br><br>
        <label for="ngaysinh">Ngày sinh:</label>
        <input type="date" id="ngaysinh" name="ngaysinh"><br><br>
        <label for="diachi">Địa chỉ:</label>    
        <input type="text" id="diachi" name="diachi"><br><br>
        <label for="gioitinh">Giới tính:</label>
        <select id="gioitinh" name="gioitinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br><br>
        <button onclick="addStudent()">Thêm sinh viên</button>
        <button onclick="fetchStudents()">Xem danh sách sinh viên</button>
    <table id="students-table" border="1" style="margin-top: 20px; width: 100%; display: none;">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Tên SV</th>
                <th>Ngày sinh</th>
                <th>Địa chỉ</th>
                <th>Giới tính</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody></tbody>
</body>
</html>