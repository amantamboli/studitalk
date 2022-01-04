<?php
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);
session_start();
require 'partials/dbconnect.php';

$public_key=$_SESSION['public_key'];

        $get_user="select * from users where public_key=$public_key";   
        $run_user=mysqli_query($conn,$get_user);
        $row=mysqli_fetch_array($run_user);
        $username=$row['username'];
        $email=$row['email'];
        $password=$row['password'];
        $preferences=$row['preferences'];
        
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    if(isset($_POST['username'])){
       
    $username=$_POST['username'];
    $update="UPDATE `users` SET `username`='$username' WHERE public_key=$public_key";
    $run=mysqli_query($conn,$update);
    }

    if(isset($_POST['email'])){
      
    $email=$_POST['email'];
    $update="UPDATE `users` SET `email`='$email' WHERE public_key=$public_key";
    $run=mysqli_query($conn,$update);
    }

    if(isset($_POST['preferences'])){
        
    $preferences=$_POST['preferences'];
    $update="UPDATE `users` SET `preferences`='$preferences' WHERE public_key=$public_key";
    $run=mysqli_query($conn,$update);
    }


    if($run)
    {
        // echo "<script>window.open('editprofile.php','_self')</script>";
        // echo "success";

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup </title>
    <link rel="stylesheet" href="css/edit.css">
    <link rel="stylesheet" href="css/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<body>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="container">
            <div class="header">
                <h2>Change Profile</h2>
            </div>
            <form id="form" class="form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                <div class="form-control">
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form-control">

                            <div class="form-control">
                                <label for="username">change your Username</label>
                                <input type="text" id="username" name="username" value="<?php echo $username;?>" />

                                <div class="field image">
                                    <label>change profile image</label>
                                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg"
                                        value="<?php echo $img;?>" />
                                </div>


                                <div class="form-control">
                                    <label for="username">change your Email</label>
                                    <input type="email" name="email" value="<?php echo $email;?>" />
                                </div>

                                <div class="form-control">
                                    <label for="username">change your Preferences</label>
                                    <input type="preferences" name="preferences" value="<?php echo $preferences;?>" />
                                </div>


                                <div class="form-control">
                                    <label for="username">change your Password</label>
                                    <a href="forgotpass.php">Forgot Password</a></label>
                                </div>

                                <button>Update</button>

                                </tr>
                        </table>
                    </form>

                </div>
</body>

</html>