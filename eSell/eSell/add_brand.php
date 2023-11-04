<?php

require "connection.php";

$brand_txt=$_POST["brand_txt"];


     if(!empty($brand_txt)){

        $category_result=connect::executer("SELECT * FROM `brand` WHERE `name`='". addslashes($brand_txt) ."';");


        if($category_result->num_rows==0){


          connect::executer("INSERT INTO `brand`(`name`) VALUES ('".addslashes($brand_txt)."');");

          echo "Brand sucessfully added!";



        }else{


        echo "This brand already exsists.";


        }



     }else{

        echo "Please enter the brand.";


     }
?>