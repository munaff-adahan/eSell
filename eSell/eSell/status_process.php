<?php
session_start();
require "connection.php";

$user = $_SESSION["user"];

$product_id = $_POST["product_id"];

$product_result = connect::executer("SELECT * FROM `product` WHERE `id`='" . $product_id . "' AND `user_email`='" . $user["email"] . "';");

$json_status;

if($product_result->num_rows==1){

    $product_fetch=$product_result->fetch_assoc();


    if($product_fetch["status_id"]==1){

       connect::executer("UPDATE `product` SET `status_id`='2' WHERE `id`='" . $product_id . "' AND `user_email`='" . $user["email"] . "';");



       $json_status["status_txt"]="Your product is deactive.";


    }else if($product_fetch["status_id"]==2){

        connect::executer("UPDATE `product` SET `status_id`='1' WHERE `id`='" . $product_id . "' AND `user_email`='" . $user["email"] . "';");
 
        $json_status["status_txt"]="Your product is active.";

     }

     echo json_encode($json_status);



}else{

 

    echo "Invalid Product!";



}



?>