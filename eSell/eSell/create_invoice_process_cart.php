<?php
session_start();


require "connection.php";

$user=$_SESSION["user"];

$order_id=$_POST["order_id"];


$date=new DateTime();
$timeZone= new DateTimeZone("Asia/Colombo");
 $date->setTimezone($timeZone);
 $invoice_date=$date->format("Y-m-d H:i:s");

 $cart_product_res = connect::executer("SELECT  `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`,`product`.`condition_id`,  `product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`cart`.`product_id`,`cart`.`qty` AS `cart_qty`  FROM `cart` INNER JOIN `product` ON cart.`product_id`=product.`id` WHERE `cart`.`user_email`='" . $user["email"] . "' AND `product`.`qty`<>'0' AND `product`.`status_id`='1' AND `cart`.`qty`<=`product`.`qty` AND `cart`.`qty`<>'0';");

 $addres_result=connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='".$user["email"]."';");

   if($addres_result->num_rows==1){


      $addres_fetch=$addres_result->fetch_assoc();


      $location_fetch=connect::executer("SELECT * FROM `location` JOIN `district` ON `location`.`district_id`=`district`.`id` WHERE `location`.`id`='".$addres_fetch["location_id"]."';")->fetch_assoc()["name"];

  

 while($cart_product_fetch=$cart_product_res->fetch_assoc()){



  $shipping=$cart_product_fetch["delivery_fee_other"];


           
  if($location_fetch=="Colombo"){

   $shipping=$cart_product_fetch["delivery_fee_colombo"];

  }



connect::executer("INSERT INTO `invoice`(`user_email`,`product_id`,`date_time`,`qty`,`order_id`,`unit_price`,`delivery_fee`,`status_id`) VALUES('".$user["email"]."','".$cart_product_fetch["id"]."','".$invoice_date."','".$cart_product_fetch["cart_qty"]."','".$order_id."','".$cart_product_fetch["price"]."','".$shipping."','1');");
    








   connect::executer("UPDATE `product` SET `qty`='".$cart_product_fetch["qty"]-$cart_product_fetch["cart_qty"]."' WHERE `id`='".$cart_product_fetch["id"]."';");








 }

 connect::executer("DELETE FROM `cart` WHERE `user_email`='".$user["email"]."';");
   }
?>