<?php
require "connection.php";

$email=$_POST["email"];


$user_result=connect::executer("SELECT * FROM `user` WHERE `email`='".$email."';");



if($user_result->num_rows==1){


    $user_fetch=$user_result->fetch_assoc();


    if($user_fetch["status_id"]==1){



        connect::executer("UPDATE `user` SET `status_id`='2' WHERE `email`='".$email."';");


       echo "Blocked";




    }else if ($user_fetch["status_id"]==2){

        
        connect::executer("UPDATE `user` SET `status_id`='1' WHERE `email`='".$email."';");


       echo "Unblocked";



    }



}else{

  echo "Invalid Product.";


}
?>