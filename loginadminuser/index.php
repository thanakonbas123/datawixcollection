<?php

session_start();

require_once "connecttion.php";

if (isset($_POST['submit'])) {
   
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $user_check = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $user_check);
    $user = mysqli_fetch_assoc($result);

    if ($user['username'] === $username) {
        echo "<script>alert('Username Already Exists');</script>"; 
    } else{
        $passwordenc = md5($password);

        $query = "INSERT INTO user (username, password, firstname, lastname, userlevel)
                    VALUE ('$username', '$passwordenc', '$firstname', '$lastname', 'm')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('ลงทะเบียนสำเร็จ'); window.location.href = 'index.php';</script>";
            // Avoid further execution of PHP code
            exit();
        } else {
            $_SESSION['error'] = "Something went wrong";
            echo "<script>alert('Something went wrong');</script>";
            // You might not want to redirect in case of an error
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงชื่อเข้าใช้</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="container">
        <div class="success">
            <?php echo $_SESSION['success']; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="container">
        <div class="error">
            <?php echo $_SESSION['error']; ?>
        </div>
    </div>
<?php endif; ?>

<?php
        if (isset($_SESSION['success'])) {
            echo "<div style='color: green; text-align: center;'>".$_SESSION['success']."</div>";
            unset($_SESSION['success']); // Clear the session variable
        }
        if (isset($_SESSION['error'])) {
            echo "<div style='color: red; text-align: center;'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']); // Clear the session variable
        }
?>
         <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h1>Create Account</h1>
                <br>
                <span>Create a username and password.</span><br>
            <div class="form-group">
                <label for="username"></label>
                <input type="text" name="username" placeholder="Enter Your Username" required>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" name="password" placeholder="Enter Your Password" required>
            </div>
            <div class="form-group">
                <label for="firstname"></label>
                <input type="text" name="firstname" placeholder="Enter Your Firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname"></label>
                <input type="text" name="lastname" placeholder="Enter Your Lastname" required>
            </div><br>
            <div style="display: flex; justify-content: flex-end; margin-right: 2%;">
                <input type="submit" name="submit" value="Submit" style="background-color: #ff914d; color: white;" >
            </div>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login.php" method="post">
                <h1>Sign In</h1>
                <br>
                <span>Enter your username and password.</span>
            <div>
                <br>
                    <label for="username"></label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div>
                    <label for="password"></label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <br>
                <div>
                    <input type="submit" name="submit" value="Login" style="background-color: #ff914d; color: white;">
                </div>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Register</h1>
                    <p>If you already have an account Go to the things sign in page.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Welcome To MyHost!</h1>
                    <p>If you don't have an account yet, go to the registration page.</p>
                    <button id="register">Register</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php 
    if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
        session_destroy();
    }
    
?>
