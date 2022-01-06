<?php
require ("dbconnect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
function sendMail($email,$token)
    {
        // require('PHPMailer/PHPMailer.php');
        // require('PHPMailer/SMTP.php');
        // require('PHPMailer/Exception.php');
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
                             //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('testingphp111@gmail.com', 'testing');
        $mail->addAddress($email);     //Add a recipient
        
    //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password reset link';
        $mail->Body    = "we got a request from you to reset you password<br>
        click the link below: <br>
        <a href='https://mahi.codes/chatapp/partials/updatepassword.php?email=$email&token=$token'>Reset Password</a>";
       
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['send-reset-link']))
{
    $email = $_POST['email'];
    
    $query="select * from users WHERE email='$email'";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            $token=bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Kolkata');
            $date=date("Y-m-d");
            $query="UPDATE `users` SET `token`='$token',`tokenexpired`='$date' WHERE email = '$email';";
            $send = sendMail($email,$token);
            mysqli_query($conn,$query);
            if(mysqli_query($conn,$query) && $send)
            {
                echo"
                     <script>
                        alert('password reset link send to mail');
                        window.location.href = '../login.php';
                    </script>
                     "; 
            }
            else
            {
                echo"
                    <script>
                        alert(' try again later');
                    </script>
                     "; 
            }
            
        }
            else
            {
                echo"
                    <script>
                        alert(' server down!try again later');
                        window.location.href = '../login.php';
                    </script>
                     "; 
            }
        }
        else
        {
            echo"
            <script>
                alert(' email not found');
                window.location.href = '../login.php';
            </script>
            "; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<style>
    .foot {
        margin: 10px;
        text-decoration: none;
    }
</style>

<body>

    <div class="container">
        <div class="header">
            <h2>Reset Password</h2>
        </div>
        <form id="form" class="form" method="post" action="">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" placeholder="" id="email" name="email" required />
            </div>
            <button type="submit" class="reset-btn btn" name="send-reset-link">send link</button>
        </form>
    </div>
</body>

</html>