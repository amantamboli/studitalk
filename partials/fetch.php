<?php 
    session_start();
    if(isset($_SESSION['public_key'])){
        require 'dbconnect.php';
        $sender_id = $_SESSION['public_key'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $receiver_id = $_POST['receiver_id'];
        }
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.public_key = messages.sender_id
                WHERE (sender_id = {$sender_id} AND receiver_id = {$receiver_id})
                OR (sender_id = {$receiver_id} AND receiver_id = {$sender_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['sender_id'] === $sender_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details" id="outgoing_msg" value='.$row['msg_id'].'>
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming ">
                               
                                <div class="details" value='.$row['msg_id'].'>
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>