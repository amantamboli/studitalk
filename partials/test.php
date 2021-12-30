<?php 
  require 'dbconnect.php';
  session_start();
 

    $sender_id = $_SESSION['public_key'];
    $sql3 = "SELECT * FROM `blockreport` WHERE reporter_id=12 AND reported_id =13";
    $result3 = mysqli_query($conn, $sql3);
    $row3 =mysqli_fetch_array($result3);
    echo $row3['blockstatus'];
    


?>