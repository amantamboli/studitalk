<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendotp($to,$otp){
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$body = "Your OTP is $otp";
// $mail = new PHPMailer(); 
	// $mail->SMTPDebug  = 3; // display all debug content
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8'; 
	$mail->Username   = 'testingphp111@gmail.com';                     //SMTP username
    $mail->Password   = 'testingphp@1234';
	$mail->SetFrom("testingphp111@gmail.com");
	$mail->Subject ="sucess";
	$mail->Body =$body;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>true
	));
	if(!$mail->Send()){
		// echo $mail->ErrorInfo;
		echo 'fail';
	}else{
		echo 'Sent';
	}
}