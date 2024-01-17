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
    <link rel="stylesheet" href="../css/contacts.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li>Contacts</li>
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
                $reciever_usr_name = "user1";
                include '../api.php';
            
                $sql = "select username from users;";
                $result = mysqli_query($connect, $sql);
                if($result){
                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            $username = $_SESSION['username'];
                            if($row['username'] != $username){
                                 echo '<a href="home.php"><div id="contact-usernames">' .$row['username'] . '</div></a>';
                            }
                        }
                
                    }
                }
                ?>
            </div>
            <div class="message-area">
                <form action="../php/create_chat.php" method="post">
                    <input type="text" name="reciever_usr_name" id="message_input" class="message_input">
                    <input type="submit" value="Start Chat">
                </form>
            </div>
        </div>
    </div>
    <script src="../js/contacts.js"></script>
    <script>
        scrollToBottom();
    </script>
</body>
</html>