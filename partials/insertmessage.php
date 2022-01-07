<?php 
    session_start();
    if(isset($_SESSION['public_key']) && $_SESSION['loggedin'] ==true){
        require 'dbconnect.php';
        $sender_id = $_SESSION['public_key'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $receiver_id = $_POST['receiver_id'];
            $message = $_POST['message'];
        }
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (receiver_id, sender_id, msg)
                                        VALUES ({$receiver_id}, {$sender_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>