<?php
session_start();

require "connection.php";

$user=$_SESSION["user"];

$invoice_id=$_POST["invoice_id"];

$invoice_result=connect::executer("SELECT * FROM `invoice` WHERE `id`='".$invoice_id."' AND `user_email`='".$user["email"]."';");

if($invoice_result->num_rows==1){

    connect::executer("UPDATE `invoice` SET `status_id`='2' WHERE `id`='".$invoice_id."' AND `user_email`='".$user["email"]."';");


    echo "Success";


}



?>