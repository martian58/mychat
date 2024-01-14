<?php
session_start();
$username = $_SESSION['username'];
$reciever_usr_name = "Fuad";
    include '../api.php';

    $sql = "select message from messages where sender_usr_name='$username' and reciever_usr_name='$reciever_usr_name';";
    $result = mysqli_query($connect, $sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num > 0){
            $show_able_messages = $result;
        }
    }


?>