<?php
    session_start();
    include '../api.php';
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
?>
<?php
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
            header("location:../pages/home.php");
       }
    }else{
       header("location:../pages/home.php");
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <style>
        .message-div{
            border-radius: 0px 5px 0px 5px;
            height: auto;
            width: 200px;
            background-color: rgb(20, 71, 115);
            color: white; 
            margin-top: 5px;
        }
        #date{
            font-size: 12px;
        }
    </style>
    <title>Home</title>
</head>
<body>
    <?php
        // echo $username;
    ?>
    <div class="container">
        <div class="navbar">
            <ul>
                <li>Home</li>
                <li><a href="contacts.php">Contacts</a></li>
                <li id="logout"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="chat">
            <div class="statusbar">
                <?php

                    echo "Sender:".$sender_usr_name;
                ?>
            </div>
            <div class="chatbox" id="chatbox">
                <?php
                $reciever_usr_name ="user1";
                $sender_usr_name = $_SESSION['username'];
                $sql = "select * from messages where sender_usr_name='$sender_usr_name' and reciever_usr_name='$reciever_usr_name';";
                $result = mysqli_query($connect, $sql);
                if($result){
                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="message-div" >' .$row['sender_usr_name'] .'<br>' . $row['message'] ."<br>"."<p id='date'>".$row['sent_date']."</p>". '</div>';
                        }
                
                    }
                }
                ?>
            </div>
            <div class="message-area">
                <form action="../php/send_msg.php" method="post">
                    <input type="text" name="message_input" id="message_input" class="message_input">
                    <input type="submit" value="Send">
                </form>
            </div>
        </div>
    </div>
    <script src="../js/home.js"></script>
    <script>
        scrollToBottom();
    </script>
</body>
</html>