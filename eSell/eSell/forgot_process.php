<?php
require "connection.php";

use PHPMailer\PHPMailer\PHPMailer; 



if(isset($_GET["email"])){

    $email=$_GET["email"];

    if(!empty($email)){


        $forgotResult=connect::executer("SELECT * FROM user WHERE `email`='".$email."';");

        if($forgotResult->num_rows==1){

            $forgotFetch=$forgotResult->fetch_assoc();
           

               $userCode=uniqid();

            connect::executer("UPDATE user SET `verification_code`='".$userCode."' WHERE `email`='".$email."';");
                     
       
           
             
            require 'Exception.php'; 
            require 'PHPMailer.php'; 
            require 'SMTP.php'; 
             
            $mail = new PHPMailer; 
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'futureharp12619@gmail.com'; 
            $mail->Password = 'future#june16*';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('futureharp12619@gmail.com', 'eSell'); 
            $mail->addReplyTo('futureharp12619@gmail.com', 'eSell'); 
            $mail->addAddress($forgotFetch["email"]); 
            $mail->isHTML(true); 
            $mail->Subject = 'eSell Password Reset Verification Code'; 
            $bodyContent = '<p style="color:#D01313 ;">'.$userCode.'</p>'; 
            $mail->Body    = $bodyContent; 
            
            if(!$mail->send()) { 
                echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
            } else { 
                echo 'Success.'; 
            } 
             
        






            


        }else{

     
               echo "User not found!";


        }





    }else{

     
        echo "Please enter your email.";





    }









}else{


    echo "Please enter your email.";


}



?>