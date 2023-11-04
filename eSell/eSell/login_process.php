<?php

require "connection.php";
session_start();

$email= addslashes($_POST["email"]);
$password= addslashes($_POST["password"]);
$remember=$_POST["remember"];



$logInResult=connect::executer("SELECT * FROM user WHERE `email`='".$email."' AND `password`='".$password."' AND `status_id`= '1';");

if($logInResult->num_rows==1){

    $logInFetch=$logInResult->fetch_assoc();

    $_SESSION["user"]=$logInFetch;


echo "Success";


   if($remember=="true"){

      setcookie("email",$logInFetch["email"],time()+60*60*24*365);
      setcookie("password",$logInFetch["password"],time()+60*60*24*365);



   }else{

    setcookie("email","",-1);
    setcookie("password","",-1);




   }



}else{



echo "Invalid details";




}




?>