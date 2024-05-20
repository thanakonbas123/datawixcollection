<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            max-width: 100%;
            overflow: auto;
        }
        table {
            background-color: #ffffff;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        footer {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px; /* ปรับขนาดของเส้นขีดแบ่งระหว่างคอลัมน์ */
            }

            footer .column {
                border-right: 1px solid #ccc; /* เพิ่มเส้นขีดด้านขวาของแต่ละคอลัมน์ */
                padding-right: 20px; /* เพิ่มระยะห่างด้านขวาของแต่ละคอลัมน์ */
            }

            footer .column:last-child {
                border-right: none; /* ยกเลิกการใส่เส้นขีดที่คอลัมน์สุดท้าย */
            }

            footer {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            footer .column h4 {
                color: #ff7f50; /* สีส้ม */
            }

            footer .column .logo {
                max-width: 100px;
                margin-bottom: 2rem;
            }

            h2 {
                font-family: Arial, sans-serif;
                font-weight: bold;
            }

        
    </style>
</head>
<body>
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 mb-4 border-bottom border-1 border-dark">
    <a href="#" class="d-flex align-items-center col-md-2 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="https://static.wixstatic.com/media/ce1a33_40b3d369556a46208d13ea9176151af9~mv2.png/v1/fill/w_439,h_163,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/ce1a33_40b3d369556a46208d13ea9176151af9~mv2.png" alt="Logo" width="280" height="80" class="me-2">
        <svg class="bi me-2" width="200" height="80" role="img" aria-label="Bootstrap"><use xlink:href="index.php"></use></svg>
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2"></a></li>
    </ul>

    <div class="col-md-3 text-end">
        <a href="logout.php" class="btn btn-outline-danger me-2">Logout</a>
    </div>
    
</header>

    <?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost:3306"; // หรือชื่อเซิร์ฟเวอร์ MySQL ของคุณ
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน MySQL
$dbname = "loginadminuser";


// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้าง query เพื่อดึงข้อมูลจากฐานข้อมูลตามเงื่อนไข userlevel = 'm'
$sql = "SELECT * FROM user WHERE userlevel = 'm'";
$result = $conn->query($sql);

?>
<?php
// ตรวจสอบว่ามีผลลัพธ์จาก query หรือไม่
if ($result->num_rows > 0) {
    echo "<div class='table-container mt-4'>";
    echo "<h2 style='text-align:'>ตารางรายชื่อ User</h2><br>";
    echo "<div class='table-responsive' style='margin: auto;'>";
    echo "<table class='table table-bordered table-striped table-hover' style='margin: auto;'>";
    echo "<tr><th>id</th>   <th>username</th>   <th>password</th>   <th>firstname</th>   <th>lastname</th>   <th>userlevel</th> <th>Delete</th></tr>"; // เปลี่ยน Column1, Column2, Column3 ตามฐานข้อมูลจริงของคุณ

    // วนลูปผลลัพธ์และแสดงผลในตาราง
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["userlevel"] . "</td>";
        echo "<td><a href='delete_file.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirmDelete()'>Delete</a></td>";
        echo "</tr>";
    }
    
    
    echo "</table>";
    echo "</div>";
    echo "</div>";
} else {
    echo "0 results";
}

$conn->close(); // ปิดการเชื่อมต่อ MySQL
?>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>




<script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"; </script>
<br><br>

<footer class="">
    <div class="logo">
                <img src="https://static.wixstatic.com/media/ce1a33_40b3d369556a46208d13ea9176151af9~mv2.png/v1/fill/w_439,h_163,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/ce1a33_40b3d369556a46208d13ea9176151af9~mv2.png">
    </div>
</footer>


</body>
</html>
