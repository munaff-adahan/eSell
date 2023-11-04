<?php

require "connection.php";
use PHPMailer\PHPMailer\PHPMailer; 

$product_id=$_POST["product_id"];

$product_result=connect::executer("SELECT `product`.`id`, `product`.`category_id`, `product`.`model_has_brand_id`, `product`.`title`,`product`.`color_id`,`product`.`price`,`product`.`qty`, `product`.`description`,`product`.`condition_id`,`product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`, `product`.`status_delete`,  `product`.`approve_status`, `product`.`product_code`,`user`.`fname`,`user`.`lname` FROM `product` JOIN `user` ON `product`.`user_email`=`user`.`email` WHERE `product`.`id`='".$product_id."' AND `product`.`approve_status`='2';");

if($product_result->num_rows==1){


    $product_fetch=$product_result->fetch_assoc();


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
    $mail->addAddress($product_fetch["user_email"]); 
    $mail->isHTML(true); 
    $mail->Subject = 'Your product : '.$product_fetch["title"].", which the colour is : ".connect::executer("SELECT * FROM `color` WHERE `id`='".$product_fetch["color_id"]."';")->fetch_assoc()["name"].", has been rejected."; 
    $bodyContent = '<p>Dear '.$product_fetch["fname"].',<br/> Your product <b>'.$product_fetch["title"].'</b> which the colour is <b>'.connect::executer("SELECT * FROM `color` WHERE `id`='".$product_fetch["color_id"]."';")->fetch_assoc()["name"].'</b> has been rejected by the administrators.<br/><br/>Thanks & Regards<br/>eSell</p>'; 
    $mail->Body    = $bodyContent; 
    
    if(!$mail->send()) { 
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    } else { 
        echo 'The product has been successfully rejected!'; 
    } 
     

     $image_result=connect::executer("SELECT * FROM `image` WHERE `product_id`='".$product_fetch["id"]."';");

     connect::executer("DELETE FROM `image` WHERE `product_id`='".$product_fetch["id"]."';");

     while($image_fetch=$image_result->fetch_assoc()){

      
        unlink($image_fetch["code"]);



     }



 connect::executer("DELETE FROM `product` WHERE `id`='".$product_fetch["id"]."';");
   




    
   

}else{

  echo "Invalid product!";


}

?>