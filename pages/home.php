<?php
    session_start();
    
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
    $username = $_SESSION['username'];
    
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
                    echo $username;
                ?>
            </div>
            <div class="chatbox" id="chatbox">
                <?php
                $reciever_usr_name = "Fuad";
                include '../api.php';
            
                $sql = "select message from messages where sender_usr_name='$username' and reciever_usr_name='$reciever_usr_name';";
                $result = mysqli_query($connect, $sql);
                if($result){
                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="message-div" >' .$username .'<br>' . $row['message'] . '</div>';
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