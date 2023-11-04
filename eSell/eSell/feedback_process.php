<?php
session_start();

require "connection.php";

$user=$_SESSION["user"];

$product_id=$_POST["product_id"];
$feedback_txt=$_POST["feedback_txt"];

$product_result=connect::executer("SELECT * FROM `product` WHERE `id`='".$product_id."';");



if(!empty($feedback_txt)){


if($product_result->num_rows==1){

    connect::executer("INSERT INTO `feedback`(`feedback_txt`,`product_id`,`user_email`) VALUES ('".$feedback_txt."','".$product_id."','".$user["email"]."');");

    echo "Feedback successfully made!";



}else{

    echo "Invalid Product!";



}
  
}else{

 
    echo "Please enter a feedback.";



}
?>