<?php 
    session_start();
    if(isset($_SESSION['public_key']) && $_SESSION['loggedin'] ==true){
        require 'dbconnect.php';
        $sender_id = $_SESSION['public_key'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $receiver_id = $_POST['receiver_id'];
            $msg_id = $_POST['msg_id'];
        }
        $sql = "SELECT * FROM `messages` WHERE msg_id=$msg_id";
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        
        if($sender_id == $row['sender_id']){
            $sql2 = "DELETE FROM `messages` WHERE msg_id =$msg_id";
            $result2 = mysqli_query($conn, $sql2);
        }
        else{
            $true = true ;
            $sql3 = "UPDATE messages SET hide=$true WHERE msg_id=$msg_id";
            $result3 = mysqli_query($conn, $sql3);
        }

    }
?>