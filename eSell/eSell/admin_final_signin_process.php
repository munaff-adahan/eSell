<?php
session_start();



require "connection.php";


$email=$_POST["email"];

$verification_code=$_POST["verification_code"];


$admin_result=connect::executer("SELECT * FROM `admin` WHERE `email`='".$email."' AND `verification_code`='".$verification_code."';");



if($admin_result->num_rows==1){


     echo "Success.";


     $_SESSION["admin"]=$admin_result->fetch_assoc();


}else{


   echo "Invalid credentials.";


}




?>