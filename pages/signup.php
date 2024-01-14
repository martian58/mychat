<?php
$user = 0;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include_once("../api.php");
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if($password == $password2){
        $sql = "select * from users where username='$username';";
        $result = mysqli_query($connect, $sql);

        if($result){
            $num = mysqli_num_rows($result);
            if($num > 0){
                $user = 1;
            }else{
                $sql = "insert into users (username, email, password) values ('$username', '$email', '$password');";
                $result = mysqli_query($connect, $sql);
                if($result){
                    header("location:login.php");
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Sign up</title>
</head>
<body>
    <?php
        if($user){
            echo "<div id='alert'>User already exist!</div>";
        }
    ?>
    <div class="container">
        <div id="header">My Chat</div>
        <div>
            <form id="signup-form" action="signup.php" method="post">
                <br>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <br><br>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <br><br>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <br><br>
                <input type="password" name="password2" id="password2" placeholder="Retype password" required>
                <br><br>
                <input type="submit" id="submit-button" value="Sign up">
                <br>
            </form>
        </div>
        <div id="div-span">
        <span>Already have an accout? <a id="" href="login.php">Login</a></span>
        </div>
    </div>
    <script src="../js/signup.js"></script>
</body>
</html>