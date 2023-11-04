<?php

require "connection.php";

$category_txt=$_POST["category_txt"];


     if(!empty($category_txt)){

        $category_result=connect::executer("SELECT * FROM `category` WHERE `name`='". addslashes($category_txt)."';");


        if($category_result->num_rows==0){


          connect::executer("INSERT INTO `category`(`name`) VALUES ('".addslashes($category_txt)."');");

          echo "Category sucessfully added!";



        }else{


        echo "This category already exsists.";


        }



     }else{

        echo "Please enter the category.";


     }
?>