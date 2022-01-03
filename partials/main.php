 <!-- receiver_id -->
<!-- sender_id -->
<?php 
error_reporting(0);
  require 'dbconnect.php';
  session_start();
  if(!isset($_SESSION['public_key'])){
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
            // echo $preference_receiver."   ";
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

    
    // $output = "";
    // if(mysqli_num_rows($result) == 0){
    //     $output .= "No users are available to chat";
    // }elseif(mysqli_num_rows($result) > 0){
        
    //     // echo $row3['blockstatus'];
    //     while($row = mysqli_fetch_assoc($result)){
            
    //         $sql2 = "SELECT * FROM messages WHERE (receiver_id = {$row['public_key']}
    //                 OR sender_id = {$row['public_key']}) AND (sender_id = {$sender_id} 
    //                 OR receiver_id = {$sender_id}) ORDER BY msg_id DESC LIMIT 1";
    //         $result2 = mysqli_query($conn, $sql2);
    //         $row2 = mysqli_fetch_assoc($result2);

    //         $sql3 = "SELECT * FROM blockreport WHERE reporter_id=$sender_id AND reported_id =$row[public_key]";
    //         $result3 = mysqli_query($conn, $sql3);
    //         $row3 =mysqli_fetch_array($result3);
    //         $blockstatus = $row3['blockstatus'];
            
    //         if($blockstatus){
    //             continue;
    //         }

    //         (mysqli_num_rows($result2) > 0) ? $shortm = $row2['msg'] : $shortm ="No message available";
    //         (strlen($shortm) > 28) ? $msg =  substr($shortm, 0, 28) . '...' : $msg = $shortm;
    //         if(isset($row2['sender_id'])){
    //             ($sender_id == $row2['sender_id']) ? $you = "You: " : $you = "";
    //         }else{
    //             $you = "";
    //         }
            
    
    //         $output .= '<a href="chat.php?user_id='. $row['public_key'] .'">
    //         <div class="content">
    //         <div class="details">
    //             <span>'. $row['username'] .'</span>
    //             <p>'. $you . $msg .'</p>
    //         </div>
    //         </div>
    //         <div class=""><i class="fas fa-circle"></i></div>
    //     </a>';
    //     }
    // }
    echo $output;
?>