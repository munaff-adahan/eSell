<?php
session_start();

require "connection.php";

$user=$_SESSION["user"];



$invoice_result=connect::executer("SELECT * FROM `invoice` WHERE  `user_email`='".$user["email"]."';");

if($invoice_result->num_rows!=0){

    connect::executer("UPDATE `invoice` SET `status_id`='2' WHERE  `user_email`='".$user["email"]."';");


    echo "Success";


}



?>