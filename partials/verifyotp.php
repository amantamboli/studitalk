<?php
require 'dbconnect.php';
$showError = false;
session_start();
    $data=" ";
    $public_key = $_SESSION['public_key'];
    $sql = "Select * from users where public_key=$public_key";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $mail = $data['email'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $otp = $_POST["otp"];
    if($otp == $data['otp']){
        echo "match";
        header("location: ../main.php");
    }
    else{
        $showError = "OTP does not match. Try Again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Account</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/alert.css">
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
            <strong></strong>'.$showError.'
        </p>
        </div>';
}
?>

    <div class="container">
        <div class="header">
            <h2>Verify OTP</h2>
        </div>
        <form id="form" class="form" method="post" action="">
            <div class="form-control">
                <label for="otp">Enter OTP</label>
                <input type="number" placeholder="Enter OTP HERE" id="otp" name="otp" required />
            </div>
            <button class="btn">Verify</button>

            <div class="foot" id="foot">
                OTP has been sent to your Email ID
                <?php echo $mail; ?>
            </div>
        </form>
    </div>
</body>

</html>