<?php
session_start();
require 'dbconnect.php';
if(!isset($_SESSION['public_key']) && $_SESSION['loggedin'] !=true){
    header("location: login.php");
  }
  

  if($_SERVER["REQUEST_METHOD"] == "GET")
  {
        $user_id =$_GET['user_id'];
        
        $get_user="select * from users where public_key=$user_id";   
        $run_user=mysqli_query($conn,$get_user);
        $row=mysqli_fetch_array($run_user);
        $username=$row['username'];
        $email=$row['email'];
        $password=$row['password'];
        $preferences=$row['preferences'];
        $new_img_name=$row['img'];
    }

  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile: <?php echo $username;?> </title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/alert.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<body>

    
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="container">
            <div class="header">
                <h2>Profile</h2>
            </div>
            <form id="form" class="form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                <div class="form-control">
                    <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-control">
                            <div class="field image imgcenter form-control">
                            <img src="../images/<?php echo $new_img_name; ?>" width="150"  alt="NA">
                             </div>

                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo $username;?>" readonly/>
                            </div>

                                    <div class="form-control">
                                    <label for="email">Email id</label>
                                    <input id="email" type="email" name="email" value="<?php echo $email;?>" readonly />
                                </div>
                                <div class="form-control">
                                    <label for="preferences">Preferences</label>
                                    <input id="preferences" type="preferences" name="preferences" value="<?php echo $preferences;?>" readonly />
                                </div>
                                
                                
                                <a id="homebtn" class="btn" href="../main.php">Go To Home Page</a>
                    </form>
                </div>
</body>
</html>