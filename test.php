<?php 


  if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_id =$_POST['receiver_id'];
        echo $user_id."p";
        print_r($_POST);
    }
  
?>