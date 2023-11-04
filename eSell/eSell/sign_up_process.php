<?php
require "connection.php";
$fname= addslashes($_POST["fname"]);
$lname= addslashes($_POST["lname"]);
$email= addslashes($_POST["email"]);
$password= addslashes($_POST["password"]);
$mobile=addslashes($_POST["mobile"]);
$gender= addslashes($_POST["gender"]);

$emailResult=connect::executer("SELECT * FROM `user` WHERE `email`='".$email."';");

$genderResult=connect::executer("SELECT * FROM `gender` WHERE `id`='".$gender."';");

if(empty($fname)){

    echo "Please enter your first name.";

}else if(filter_var($fname,FILTER_VALIDATE_INT)){
 
    echo "Your first name can't have only integer values.";

}else if(empty($lname)){

    echo "Please enter your last name.";

}else if(filter_var($lname,FILTER_VALIDATE_INT)){
 
    echo "Your last name can't have only integer values.";

}else if(empty($email)){

    echo "Please enter your email.";



}else if(strlen($email)>100){

echo "Your email must contain less than 100 charactors.";



}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){


echo "Invalid email.";


}else if($emailResult->num_rows==1){

    echo "This email is already registered.";

}else if(empty($password)){

    echo "Please enter your password.";


}else if(strlen($password)<8){

    echo "Your password must contain atleast 8 charactors.";


}else if(!preg_match("#[A-Z]#",$password)||!preg_match("#[a-z]#",$password)||!preg_match("#[0-9]#",$password)){

    echo "Your password must contain capital and simple letters and numbers.";

}else if(empty($mobile)){

    echo "Please enter your mobile.";
}else if(strlen($mobile)!=10){

echo "Your mobile must contain 10 digits.";


}else if(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){


echo "Your mobile must be a sri lankan mobile number.";


}else if($genderResult->num_rows!=1){


echo "Invalid gender.";


}else{

        echo "SignUp Success";


     $date=new DateTime();
    $timeZone= new DateTimeZone("Asia/Colombo");
     $date->setTimezone($timeZone);
     $register_date=$date->format("Y-m-d H:i:s");

    connect::executer("INSERT INTO `user`(`email`,`fname`,`lname`,`password`,`mobile`,`register_date`,`gender_id`,`status_id`) VALUES('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$register_date."','".$gender."','1')");
 
    

   

}




?>