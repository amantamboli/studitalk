<?php 
error_reporting(E_ALL ^ E_WARNING); 
  require 'dbconnect.php';
  session_start();
  if(!isset($_SESSION['public_key']) && $_SESSION['loggedin'] !=true){
    header("location: login.php");
  }

    $sender_id = $_SESSION['public_key'];
    $sql = "SELECT * FROM users WHERE NOT public_key = {$sender_id} ORDER BY user_id DESC";
    $result = mysqli_query($conn, $sql);
    

    $sql3 = "select preferences from users where public_key =$sender_id";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $preference_sender = $row3['preferences'];
    $preference_sender = explode(" ",$preference_sender);
    $no_of_pref = sizeof($preference_sender);
    $matchfound = false;
    $blockstatus = false;

    $output = "";
    if(mysqli_num_rows($result) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            
            $sql2 = "select preferences from users where username = '$row[username]'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $preference_receiver = $row2['preferences'];

            $sql4 = "SELECT * FROM blockreport WHERE reporter_id=$sender_id AND reported_id=$row[public_key]";
            $result4 = mysqli_query($conn, $sql4);
            $row4 =mysqli_fetch_array($result4);
            $blockstatus = $row4['blockstatus'];
            if($blockstatus){
                continue;
            }
            $interest = "You both select :";
            foreach($preference_sender as $preference){
                if(strstr($preference_receiver,$preference)){
                    $matchfound = true;
                    $interest = $interest ." ".$preference;
                }
            }
            if($matchfound){             
            $output .= '<a href="chat.php?user_id='. $row['public_key'] .'">
                    <div class="content">
                    <img src="images/'. $row['img'] .'" alt="">
                     <div class="details">
                         <span>'. $row['username'] .'</span>
                       <p>'.$interest.'</p>
                    </div>
                     </div>
                     <div class=""><i class="fas fa-circle"></i></div>
                 </a>';
            }
            $matchfound = false;
        }

    }
    echo $output;
?>