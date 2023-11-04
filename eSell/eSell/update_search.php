<?php
session_start();
require "connection.php";
$user=$_SESSION["user"];

$search_txt=addslashes($_POST["search_txt"]);

$product_result=connect::executer("SELECT * FROM `product` WHERE `product_code` ='".$search_txt."' AND `user_email`='".$user["email"]."' AND `status_delete`='1' AND `approve_status`='1';");

$update_array;
if($product_result->num_rows==1){

    $product_fetch=$product_result->fetch_assoc();

 

    $update_array=$product_fetch;

    $update_array["category"]=connect::executer("SELECT `name` FROM `category` WHERE `id`='".$product_fetch["category_id"]."';")->fetch_assoc()["name"];



    $model_has_brand_res=connect::executer("SELECT `model`.`name` AS `model_name`,`brand`.`name` AS `brand_name` FROM `model_has_brand` JOIN `model` ON `model_has_brand`.`model_id`=`model`.`id` JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='".$product_fetch["model_has_brand_id"]."';");


   

   $image_result=connect::executer("SELECT * FROM `image` WHERE `product_id`='".$product_fetch["id"]."';");


    for($image_count=1;$image_count<=$image_result->num_rows;$image_count++){

        $image_fetch= $image_result->fetch_assoc();


       


      
        $update_array["product_img".$image_count]= explode("//",$image_fetch["code"])[1];

  

        




    }

    $model_has_brand_fetch=$model_has_brand_res->fetch_assoc();

    $update_array=$update_array + $model_has_brand_fetch;

    $update_array["image_rows"]=$image_result->num_rows;


     echo json_encode($update_array);





}else{


    echo "Invalid product.";




}


?>