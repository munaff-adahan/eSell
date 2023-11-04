<?php
session_start();
require "connection.php";

if(isset($_SESSION["user"])){


$user=$_SESSION["user"];
$product_id=$_POST["product_id"];;

$qty=addslashes($_POST["qty"]);

if(!empty($qty)&&is_numeric($qty)){

$find_result=connect::executer("SELECT * FROM `cart` WHERE `product_id`='".$product_id."' AND `user_email`='".$user["email"]."';");

$find_product=connect::executer("SELECT * FROM `product` WHERE `id`='".$product_id."';");

         if($qty>0){
   
    if($qty<=$find_product->fetch_assoc()["qty"]){

  if($find_result->num_rows==1){

    echo "This product is already added to the cart !";



  }else{

         
     connect::executer("INSERT INTO `cart`(`product_id`,`user_email`,`qty`) VALUES ('".$product_id."','".$user["email"]."','".$qty."');");
     
     echo "success!";

  }

}else{


    echo "The  qty can't be greater than the product's qty.";


 }
}else{


    echo "The qty can't be less than 1.";



}
}else{

  echo "Please enter a qty.";


}
}else{

  echo "First sign in!";


}

?>
