<?php
session_start();
require "connection.php";

if(isset($_SESSION["user"])){


$user=$_SESSION["user"];
$product_id=$_POST["product_id"];;

$find_result=connect::executer("SELECT * FROM `watchlist` WHERE `product_id`='".$product_id."' AND `user_email`='".$user["email"]."';");

  if($find_result->num_rows==1){

    echo "This product is already added to the watchlist !";



  }else{

         
     connect::executer("INSERT INTO `watchlist`(`product_id`,`user_email`) VALUES ('".$product_id."','".$user["email"]."');");


  }
}else{

  echo "First sign in!";


}

?>