<?php

$showAlert = false;
$showError = false;

require 'partials/dbconnect.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
   $username = $_POST["username"];
    $password = $_POST["password"];
     
    $sql = "Select * from users where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    // print_r($row);
    // echo $row['unique_id'];
    // echo var_dump($num);
    if ($num == 1){
        // while($row=mysqli_fetch_array($result)){
            if(password_verify($password,$row['password'])){
                $login = true;
                if($login){
                     session_start();
                     $sql = "Select * from users where username='$username'";
                     $result = mysqli_query($conn, $sql);
                     $data = mysqli_fetch_assoc($result);
                     $_SESSION['username'] = $username;
                     $_SESSION['public_key'] = $data['public_key'];

                     $public_key = $data['public_key'];
                     $to = $data['email'];
                     $otp = $random_id = mt_rand(111111, 999999);
                     $sql2 = "UPDATE `users` SET `otp`=$otp WHERE public_key = $public_key;";
                     $result2 = mysqli_query($conn,$sql2);
                     include 'sendotp.php';
                       sendotp($to,$otp);
                     header("location: verifyotp.php");
                     
                }
            }
            else{
                $showError = "password not match";
            }
        // }
    } 
    else{
        $showError = "Invalid Credentials";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login: </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/alert.css">
</head>

<body>
    <?php

if($showError){
    echo '<div class="alert error">
        <input type="checkbox" id="alert1"/>
        <label class="close" title="close" for="alert1">
        <i class="icon-remove"></i>
        </label>
        <p class="inner">
            <strong>Warning! </strong>'.$showError.'
        </p>
        </div>';
}


?>

    <div class="container">
        <div class="header">
            <h2>Login</h2>
        </div>
        <form id="form" class="form" method="post" action="">
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" placeholder="" id="username" name="username" required />

            </div>

            <div class="form-control">
                <label for="username">Password</label>
                <input type="password" placeholder="" id="password" name="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                    required />

            </div>

            <button id="submit">Login</button>
            <div class="foot" id="foot">
                Don't Have an Account?
                <a href="index.php">Signup Here</a>
            </div>
            <div class="foot" id="foot">
                <a href="forgotpass.php">Forgot Password</a>
            </div>
        </form>
        
    </div>

    <script>

    </script>
</body>

</html>