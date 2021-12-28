 <!-- receiver_id -->
<!-- sender_id -->
<?php 
  require 'dbconnect.php';
  session_start();
  if(!isset($_SESSION['public_key'])){
    header("location: login.php");
  }

    $sender_id = $_SESSION['public_key'];
    $sql = "SELECT * FROM users WHERE NOT public_key = {$sender_id} ORDER BY user_id DESC";
    $result = mysqli_query($conn, $sql);
    
    $output = "";
    if(mysqli_num_rows($result) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $sql2 = "SELECT * FROM messages WHERE (receiver_id = {$row['public_key']}
                    OR sender_id = {$row['public_key']}) AND (sender_id = {$sender_id} 
                    OR receiver_id = {$sender_id}) ORDER BY msg_id DESC LIMIT 1";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            (mysqli_num_rows($result2) > 0) ? $shortm = $row2['msg'] : $shortm ="No message available";
            (strlen($shortm) > 28) ? $msg =  substr($shortm, 0, 28) . '...' : $msg = $shortm;
            if(isset($row2['sender_id'])){
                ($sender_id == $row2['sender_id']) ? $you = "You: " : $you = "";
            }else{
                $you = "";
            }
            
    
            $output .= '<a href="chat.php?user_id='. $row['public_key'] .'">
            <div class="content">
            <div class="details">
                <span>'. $row['username'] .'</span>
                <p>'. $you . $msg .'</p>
            </div>
            </div>
            <div class=""><i class="fas fa-circle"></i></div>
        </a>';
        }
    }
    echo $output;
?>