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
    <?php
        // echo $username;
    ?>
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
                $reciever_usr_name = "Fuad";
                include '../api.php';
            
                $sql = "select username from users;";
                $result = mysqli_query($connect, $sql);
                if($result){
                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div id="contact-usernames">' .$row['username'] . '</div>';
                        }
                
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="../js/contacts.js"></script>
    <script>
        scrollToBottom();
    </script>
</body>
</html>