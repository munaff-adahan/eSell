<?php
use PHPMailer\PHPMailer\PHPMailer;
require "connection.php";


$email=$_POST["email"];


$admin_result=connect::executer("SELECT * FROM `admin` WHERE `email`='".$email."';");



if($admin_result->num_rows==1){

   
    $admin_code=uniqid();



    connect::executer("UPDATE `admin` SET `verification_code`='".$admin_code."';");


     
    require 'Exception.php'; 
               require 'PHPMailer.php'; 
               require 'SMTP.php'; 
                
               $mail = new PHPMailer; 
               $mail->IsSMTP();
               $mail->Host = 'smtp.gmail.com'; 
               $mail->SMTPAuth = true; 
               $mail->Username = 'thisitha2008@gmail.com'; 
               $mail->Password = 'zdtcckaaqqagafrn';
               $mail->SMTPSecure = 'ssl';
               $mail->Port = 465;
               $mail->setFrom('thisitha2008@gmail.com', 'eSell'); 
               $mail->addReplyTo('thisitha2008@gmail.com', 'eSell'); 
               $mail->addAddress($email); 
               $mail->isHTML(true); 
               $mail->Subject = 'eSell Sign In Verification Code'; 
               $bodyContent = '<p style="color:#D01313 ;">'.$admin_code.'</p>'; 
               $mail->Body    = $bodyContent; 
               
               if(!$mail->send()) { 
                   echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
               } else { 
                   echo 'The signin verification verification code is sent to your email please check your inbox.'; 
               } 
                
           



}else{


    echo "Invalid email!";


}

?>