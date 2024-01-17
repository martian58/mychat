<?php
session_start();
$sender_usr_name = $_SESSION['username'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../api.php';   
    $sender_usr_name = $_SESSION['username'];
    $reciever_usr_name = $_POST['reciever_usr_name'];

    $sql = "select * from chatpairs where (user1='$sender_usr_name' and user2='$reciever_usr_name') or (user2='$sender_usr_name' and user1='$reciever_usr_name'); ";
    $result = mysqli_query($connect, $sql);
    if(!$result){
        echo "chatpair doesnt exist";
       $sql = "insert into chatpairs (user1, user2) values ($sender_usr_name, $reciever_usr_name)";
       $result = mysqli_query($connect, $sql);
       if($result){
            echo "inserted";
            // header("location:../pages/home.php");
       }
    }else{
    //    header("location:../pages/home.php");
    }
}
if (isset($_POST["reciever_usr_name"])) {
    $reciever_usr_name = $_POST["reciever_usr_name"];
    // Rest of your code here
} else {
    // Handle the case when the key is not set
    echo "Form not submitted correctly.";

}

?>