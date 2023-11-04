<?php
require "connection.php";
$email=$_POST["email"];
$new_password=$_POST["new_password"];
$confirm_password=$_POST["confirm_password"];
$verification_code=$_POST["verification_code"];

if(empty($email)){

echo "Please enter your email!";

}else if(empty($new_password)){


echo "Please enter your new password.";



    
}else if(strlen($new_password)<8){

    echo "Your password must contain atleast charactors.";


}else if(!preg_match("#[A-Z]#",$new_password)||!preg_match("#[a-z]#",$new_password)||!preg_match("#[0-9]#",$new_password)){

    echo "Your password must contain capital and simple letters and numbers.";

}else if($confirm_password!=$new_password){

echo "Your passwords does not match.";



}else if(empty($verification_code)){

echo "Please enter the password verification code.";



}else{

$verfyResult=connect::executer("SELECT * FROM user WHERE `email`='".$email."' AND `verification_code`='".$verification_code."';");

   
if($verfyResult->num_rows==0){

echo "Invalid details.";


}else{

    echo "Success";

    connect::executer("UPDATE user SET `password`='".$new_password."' WHERE `email`='".$email."';");



}





}



?>