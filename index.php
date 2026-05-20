<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Trang quản lý sinh viên</h1>

    <div>
        <label for="search-query">Tìm kiếm sinh viên:</label>
        <input type="text" id="search-query" name="search-query" placeholder="Mã SV or Tên SV">
        <button onclick="searchStudents()">Tìm kiếm</button>
        <button onclick="fetchStudents()">Xem tất cả</button>
    </div>

    <div style="margin-top: 20px;">
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
    </div>

    <table id="students-table" border="1" style="margin-top: 20px; width: 100%; display: none;">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Tên SV</th>
                <th>Ngày sinh</th>
                <th>Địa chỉ</th>
                <th>Giới tính</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        function renderStudents(students) {
            const table = document.getElementById('students-table');
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = '';

            if (!students || students.length === 0) {
                table.style.display = 'none';
                alert('Không có sinh viên phù hợp.');
                return;
            }

            students.forEach(student => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.MaSV}</td>
                    <td>${student.TenSV}</td>
                    <td>${student.Ngaysinh}</td>
                    <td>${student.Diachi}</td>
                    <td>${student.Gioitinh}</td>
                `;
                tbody.appendChild(row);
            });

            table.style.display = 'table';
        }

        function fetchStudents(query = '') {
            const url = 'get_students.php' + (query ? '?search=' + encodeURIComponent(query) : '');
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        renderStudents(data.data);
                    } else {
                        alert(data.message || 'Lấy danh sách thất bại');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Có lỗi khi lấy dữ liệu.');
                });
        }

        function searchStudents() {
            const query = document.getElementById('search-query').value.trim();
            if (!query) {
                fetchStudents();
                return;
            }
            fetchStudents(query);
        }

        function addStudent() {
            const data = {
                MaSV: document.getElementById('masv').value.trim(),
                TenSV: document.getElementById('tensv').value.trim(),
                Ngaysinh: document.getElementById('ngaysinh').value,
                Diachi: document.getElementById('diachi').value.trim(),
                Gioitinh: document.getElementById('gioitinh').value
            };

            fetch('add_sv.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(result => {
                    alert(result.message || 'Hoàn tất');
                    if (result.status) {
                        fetchStudents();
                    }
                })
                .catch(error => {
                    console.error('Add error:', error);
                    alert('Không thể thêm sinh viên.');
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchStudents();
        });
    </script>
</body>
</html>