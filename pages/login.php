<?php 
$invalid =0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../api.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from users where username='$username' and password='$password';";
    $result = mysqli_query($connect, $sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            session_start();
            $_SESSION['username'] = $username;
            header('location:home.php');
        }else{
            $invalid=1;
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <?php
        if($invalid){
            echo "<div id='alert'>User doesn't exist</div>";
        }
    ?>
    <div class="container">
        <div id="header">My Chat</div>
        <div>
            <form id="login-form" action="login.php" method="post">
                <br>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <br><br>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <br><br>
                <input type="submit" id="submit-button" value="Login">
                <br>
            </form>
        </div>
        <div id="div-span">
        <span>Don't have an accout? <a id="" href="signup.php">Sign up</a></span>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>