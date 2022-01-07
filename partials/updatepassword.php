<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password </title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>

<?php

require ("dbconnect.php");
if(isset($_GET['email'])&& isset($_GET['token']))
{
    $email  = $_GET['email'];
    $token = $_GET['token'];
    date_default_timezone_set('Asia/Kolkata');
    $date=date("Y-m-d");
    $query="select * from users WHERE email='$email' AND token='$token' AND tokenexpired='$date'";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            echo "
            <div class='container'>
            <form class='form' method='POST'>
            <div class='form-control'>
                <label for='password'>Create New Password</label>
                <input type='password' placeholder='enter new password' id='password' name='password' required />
                <input type='hidden' name='email' value='$email'>
                <button type='submit' name='updatepassword' class='btn'>UPDATE</button>
            </div>
            </form>
            </div>
            ";
        }
        
        else  
        {
            echo"
            <script>
             alert(' invalid or expired link');
             window.location.href='../login.php';
            </script>
             ";   
        }
    }

    else 
    {
        echo"
                    <script>
                     alert(' server down!try again later');
                     window.location.href='../login.php';
                    </script>
                     "; 
    }
}
?>
<?php
    if(isset($_POST['updatepassword']))
    {
    $password = $_POST['password'];
    $email = $_POST['email'];
       $hash=password_hash($password ,PASSWORD_DEFAULT);
       $update="UPDATE `users` SET `password`='$hash',`token`=NULL,`tokenexpired`=NULL WHERE email='$email'";
       mysqli_query($conn,$update);
       if(mysqli_query($conn,$update))
       {
        echo"
        <script>
         alert(' Password Updated Sucessfully');
         window.location.href='../login.php';
        </script>
         "; 
       }
    
       else
        {
            echo"
            <script>
             alert(' server down!try again later');
             window.location.href='../login.php';
            </script>
             "; 
       }
    }
?>

        </form>
    </div>
</body>
</html>