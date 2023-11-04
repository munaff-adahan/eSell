<?php

require "connection.php";

$brand=$_POST["brand"];
$model=$_POST["model"];


if(empty($brand)){

    echo "Please select the brand.";


}else if(empty($model)){

    echo "Please select the model.";


}else{


$brand_result=connect::executer("SELECT * FROM `brand` WHERE `id`='".$brand."';");

$model_result=connect::executer("SELECT * FROM `model` WHERE `id`='".$model."';");



if($brand_result->num_rows!=1){


    echo "Invalid brand!";



}else if($model_result->num_rows!=1){


    echo "Invalid model!";



}else{

   $model_has_brand_result=connect::executer("SELECT * FROM `model_has_brand` WHERE `model_id`='".$model."' AND `brand_id`='".$brand."';");

   if($model_has_brand_result->num_rows!=1){

       
    connect::executer("INSERT INTO `model_has_brand`(`model_id`,`brand_id`) VALUES ('".$model."','".$brand."');");


    echo "Success";


   }else{


       echo "This match already exsists!";


   }



}



}




?>