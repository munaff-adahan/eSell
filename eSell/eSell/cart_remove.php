<?php
session_start();
require "connection.php";
$user=$_SESSION["user"];
$product_id=$_POST["product_id"];

$watch_check_result=connect::executer("SELECT * FROM `cart` WHERE `product_id`='".$product_id."' AND `user_email`='".$user["email"]."';");

if($watch_check_result->num_rows==1){


   connect::executer("DELETE FROM `cart` WHERE `product_id`='".$product_id."' AND `user_email`='".$user["email"]."';");


}else{


   echo  "This product was not found in the cart.";


}

?>