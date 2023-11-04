<?php
session_start();


require "connection.php";

$user=$_SESSION["user"];

$order_id=$_POST["order_id"];
$email=$_POST["email"];
$total_price=$_POST["total_price"];
$unit_price=$_POST["unit_price"];
$qty=$_POST["qty"];
$product_id=$_POST["product_id"];


$date=new DateTime();
$timeZone= new DateTimeZone("Asia/Colombo");
 $date->setTimezone($timeZone);
 $invoice_date=$date->format("Y-m-d H:i:s");


    
$product_result=connect::executer("SELECT * FROM `product` WHERE `id`='".$product_id."';");


if($product_result->num_rows==1){

   $product_fetch=$product_result->fetch_assoc();


   $addres_result=connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='".$user["email"]."';");

   if($addres_result->num_rows==1){


      $addres_fetch=$addres_result->fetch_assoc();


      $location_fetch=connect::executer("SELECT * FROM `location` JOIN `district` ON `location`.`district_id`=`district`.`id` WHERE `location`.`id`='".$addres_fetch["location_id"]."';")->fetch_assoc()["name"];

      $shipping=$product_fetch["delivery_fee_other"];


           
         if($location_fetch=="Colombo"){

          $shipping=$product_fetch["delivery_fee_colombo"];

         }
      

   connect::executer("INSERT INTO `invoice`(`user_email`,`product_id`,`date_time`,`qty`,`order_id`,`unit_price`,`delivery_fee`,`status_id`) VALUES('".$email."','".$product_id."','".$invoice_date."','".$qty."','".$order_id."','".$unit_price."','".$shipping."','1');");


   connect::executer("UPDATE `product` SET `qty`='".$product_fetch["qty"]-$qty."' WHERE `id`='".$product_id."';");



      }



}


?>