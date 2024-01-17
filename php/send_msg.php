<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}
$username = $_SESSION['username'];
$reciever_usr_name = "user1";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../api.php';
    $message = $_POST['message_input'];
   
    $username = $_SESSION['username'];
    $sql = "insert into messages (sender_usr_name, reciever_usr_name, message) values ('$username','$reciever_usr_name', '$message');";
    $result = mysqli_query($connect, $sql);
    if($result){
        header("location:../pages/home.php");
        echo $username;
    }
}


?>