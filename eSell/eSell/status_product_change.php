<?php
require "connection.php";

$product_id=$_POST["product_id"];


$product_result=connect::executer("SELECT * FROM `product` WHERE `id`='".$product_id."';");



if($product_result->num_rows==1){


    $product_fetch=$product_result->fetch_assoc();


    if($product_fetch["status_id"]==1){



        connect::executer("UPDATE `product` SET `status_id`='2' WHERE `id`='".$product_id."';");


       echo "Blocked";




    }else if ($product_fetch["status_id"]==2){

        
        connect::executer("UPDATE `product` SET `status_id`='1' WHERE `id`='".$product_id."';");


       echo "Unblocked";



    }



}else{

  echo "Invalid Product.";


}
?>