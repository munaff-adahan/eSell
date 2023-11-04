<?php
session_start();
require "connection.php";

$user = $_SESSION["user"];

$product_id = $_POST["product_id"];

$product_result = connect::executer("SELECT * FROM `product` WHERE `id`='" . $product_id . "' AND `user_email`='" . $user["email"] . "';");

if ($product_result->num_rows == 1) {

    // connect::executer("DELETE FROM `watchlist` WHERE `product_id`='" . $product_id . "';");


    // $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_id . "';");

    // for ($image_count = 0; $image_count < $image_result->num_rows; $image_count++) {
        
    //     $image_fetch=$image_result->fetch_assoc();

    //     unlink($image_fetch["code"]);


    // }


    // connect::executer("DELETE FROM `image` WHERE `product_id`='" . $product_id . "';");


    connect::executer("UPDATE `product` SET `status_delete`='2' WHERE `id`='".$product_id."';");

    
    connect::executer("DELETE FROM `cart` WHERE `product_id`='".$product_id."';");

    connect::executer("DELETE FROM `watchlist` WHERE `product_id`='".$product_id."';");


} else {

    echo "Invalid Product!";
}
?>