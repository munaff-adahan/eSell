<?php

require "connection.php";

$color_txt=$_POST["color_txt"];


     if(!empty($color_txt)){

        $category_result=connect::executer("SELECT * FROM `color` WHERE `name`='". addslashes($color_txt)."';");


        if($category_result->num_rows==0){


          connect::executer("INSERT INTO `color`(`name`) VALUES ('".addslashes($color_txt)."');");

          echo "Colour sucessfully added!";



        }else{


        echo "This colour already exsists.";


        }



     }else{

        echo "Please enter the colour.";


     }
?>