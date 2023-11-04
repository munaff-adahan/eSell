<?php

require "connection.php";

$model_txt=$_POST["model_txt"];


     if(!empty($model_txt)){

        $category_result=connect::executer("SELECT * FROM `model` WHERE `name`='". addslashes($model_txt)."';");


        if($category_result->num_rows==0){


          connect::executer("INSERT INTO `model`(`name`) VALUES ('".addslashes($model_txt)."');");

          echo "Model sucessfully added!";



        }else{


        echo "This model already exsists.";


        }



     }else{

        echo "Please enter the model.";


     }
?>