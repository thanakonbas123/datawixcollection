<?php 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        include('connecttion.php');

        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordenc = md5($password);

        $query = "SELECT * FROM user WHERE username ='$username' AND password = '$passwordenc'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1 ) {

            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['userlevel'] = $row['userlevel'];

            if ($_SESSION['userlevel'] == 'a') {
                header("Location: admin_page.php");
            }

            if ($_SESSION['userlevel'] == 'm') {
                header("Location: accesstokenpost.php");
            }
        } else {
            echo "<script>alert('User หรือ Password ไม่ถูกต้อง'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('กรุณากรอก User และ Password'); window.location.href = 'index.php';</script>";
    }
} else {
    header("Location: index.php");
}

?>
