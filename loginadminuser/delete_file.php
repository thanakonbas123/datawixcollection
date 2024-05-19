<?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "loginadminuser";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงค่า id จากพารามิเตอร์ของ URL
$id = $_GET['id'];

// สร้าง query เพื่อลบข้อมูลจากฐานข้อมูล
$sql = "DELETE FROM user WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // ถ้าลบข้อมูลสำเร็จ redirect กลับไปยังหน้าหลัก
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>