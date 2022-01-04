<?php 
    session_start();
    $output =""; 
    if(isset($_SESSION['public_key'])){
        require 'dbconnect.php';
        $reporter_id = $_SESSION['public_key'];
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $reported_id = $_POST['receiver_id'];
        }
        $sql = "SELECT * FROM `blockreport` WHERE reporter_id=$reporter_id AND reported_id =$reported_id";
        
        $query = mysqli_query($conn, $sql);
        // echo mysqli_num_rows($query);
        if(mysqli_num_rows($query) == 0){
            $sql2 = "INSERT INTO `blockreport`(`reporter_id`, `reported_id` ,`blockstatus`) VALUES ($reporter_id,$reported_id,1)";
            $query2 = mysqli_query($conn, $sql2);
            if($query2){
                $output = true;
                echo $output;
            }
        }
        else{
            
            $sql2 = "Update `blockreport` SET `blockstatus`=1 WHERE reporter_id=$reporter_id AND reported_id =$reported_id";
            $query2 = mysqli_query($conn, $sql2);
            if($query2){
                $output = true;
                echo $output;
            }
        }
    }
?>