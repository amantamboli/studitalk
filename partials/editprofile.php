<?php
session_start();
require 'dbconnect.php';

if(!isset($_SESSION['public_key']) && $_SESSION['loggedin'] !=true){
    header("location: login.php");
  }
$public_key=$_SESSION['public_key'];

        $get_user="select * from users where public_key=$public_key";   
        $run_user=mysqli_query($conn,$get_user);
        $row=mysqli_fetch_array($run_user);
        $username=$row['username'];
        $email=$row['email'];
        $password=$row['password'];
        $preferences=$row['preferences'];
        $new_img_name=$row['img'];

        $updateuser = false;
        $updatemail =false;
        $updatepreferences =false;
        $updatenotification = false;
        $updateprofilepic = true;
    
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    
    if(isset($_POST['username'])){
    $username=$_POST['username'];
    $update="UPDATE `users` SET `username`='$username' WHERE public_key=$public_key";
    $run=mysqli_query($conn,$update);

        $updateuser = true;
    
    }

    if(isset($_POST['email'])){
      
    $email=$_POST['email'];
    $update="UPDATE `users` SET `email`='$email' WHERE public_key=$public_key";
    $run=mysqli_query($conn,$update);
        $updatemail = true;
    }

    if(isset($_POST['preferences'])){
    $preferences=$_POST['preferences'];
    $update="UPDATE `users` SET `preferences`='$preferences' WHERE public_key=$public_key";
    $run=mysqli_query($conn,$update);
    $updatepreferences = true;
    }
    if(isset($_FILES['image'])){
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true){
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name,"../images/".$new_img_name)){
                    
                }
            }else{
                $showError = "Please upload an image file - jpeg, png, jpg";
            }
        }else{
            $showError = "Please upload an image file - jpeg, png, jpg";
        }
        $preferences=$_POST['preferences'];
        $update="UPDATE `users` SET `img`='$new_img_name' WHERE public_key=$public_key";
        $run=mysqli_query($conn,$update);
        $updateprofilepic = true;
    }


    if($updateuser || $updatemail || $updatepreferences || $updateprofilepic)
    {
        $updatenotification = "Settings Updated Successfully!";

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile: <?php echo $username;?> </title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<body>
<?php   
    if($updateuser || $updatemail || $updatepreferences){
        echo '<div class="alert success">
        <input type="checkbox" id="alert1"/>
        <label class="close" title="close" for="alert1">
        <i class="icon-remove"></i>
        </label>
        <p class="inner">
            <strong>' .$updatenotification.'</strong> 
        </p>
        </div>';
    }
?>
    
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="container">
            <div class="header">
                <h2>Edit Profile</h2>
            </div>
            <form id="form" class="form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                <div class="form-control">
                    <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-control">
                                <label for="username">change your Username</label>
                                <input type="text" id="username" name="username" value="<?php echo $username;?>" />
                            </div>
                                <div class="field image form-control">
                                    <label for="image">change profile image</label>
                                    <input id="image" type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg"
                                         />
                                </div>
                                <div class="form-control">
                                    <label for="email">change your Email</label>
                                    <input id="email" type="email" name="email" value="<?php echo $email;?>" />
                                </div>
                                <div class="form-control">
                                    <label for="preferences">change your Preferences</label>
                                    <input id="preferences" type="preferences" name="preferences" value="<?php echo $preferences;?>" />
                                </div>
                                <div class="form-control">
                                    <p for="username">change your Password</p>
                                    <a href="forgotpass.php">Click here to change password</a></label>
                                </div>
                                <button class="btn">Update</button>
                                <a id="homebtn" class="btn" href="../main.php">Go To Home Page</a>
                    </form>
                </div>
</body>
</html>