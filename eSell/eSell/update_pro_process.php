<?php
require "connection.php";
session_start();

if(isset($_SESSION["user"])){

$user=$_SESSION["user"];


$first_name= addslashes($_POST["first_name"]);
$last_name= addslashes($_POST["last_name"]);
$mobile= addslashes($_POST["mobile"]);
$address_line_1= addslashes($_POST["address_line_1"]);
$address_line2= addslashes($_POST["address_line2"]);
$city_pro= addslashes($_POST["city_pro"]);

$location_result=connect::executer("SELECT * FROM `location` WHERE `city_id`='".$city_pro."';");


if(empty($first_name)){


    echo "Please enter your first name.";



}else if(empty($last_name)){


    echo "Please enter your last name.";



}else if(empty($mobile)){

    echo "Please enter your mobile.";
}else if(strlen($mobile)!=10){

echo "Your mobile must contain 10 digits.";


}else if(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){


echo "Your mobile must be a sri lankan mobile number.";


}else if(empty($address_line_1)){

    echo "Please enter your address line 1.";


}else if(empty($address_line2)){

    echo "Please enter your address line 2.";


}else if(empty($city_pro)){

    echo "Please select your city.";


}else{


if($location_result->num_rows==1){

$location_fetch=$location_result->fetch_assoc();





     

if(isset($_FILES["profile_img_selector"])){

    
       $allowed_file_formats=array("image/png","image/jpeg","image/svg");


        $profile_pic=$_FILES["profile_img_selector"];

       
        if(!in_array($profile_pic["type"],$allowed_file_formats)){

           echo "Invalid file format.";

        }else{

            $default_file_type="";
        

        if($profile_pic["type"]=="image/png"){

            $default_file_type="png";



        }else if($profile_pic["type"]=="image/jpeg"){

            
            $default_file_type="jpg";

        }else if($profile_pic["type"]=="image/svg"){

            $default_file_type="svg";

        }
        $upload_img="user_images//".uniqid().".".$default_file_type;
       
       
        move_uploaded_file($profile_pic["tmp_name"],$upload_img);
        
        $prof_img_res=connect::executer("SELECT * FROM `profile_img` WHERE `user_email`='".$user["email"]."';"); 

 

      

        
        if($prof_img_res->num_rows==1){

           

            $pro_fetch = $prof_img_res->fetch_assoc();

            $profile_pic=$pro_fetch["image_path"];
                    
            unlink($pro_fetch["image_path"]);

            
            connect::executer("UPDATE `profile_img` SET `image_path`='".$upload_img."' WHERE `user_email`='".$user["email"]."';");
        
    
            
         }else{


           connect::executer("INSERT INTO `profile_img`(`image_path`,`user_email`) VALUES ('".$upload_img."','".$user["email"]."');");



         }

          

       

    }
}

connect::executer("UPDATE `user` SET `fname`='".$first_name."',`lname`='".$last_name."',`mobile`='".$mobile."' WHERE `email`='".$user["email"]."';");

$has_address_result=connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='".$user["email"]."';");


echo "Success";

if($has_address_result->num_rows==1){

    connect::executer("UPDATE `user_has_address` SET `line1`='".$address_line_1."',`line2`='".$address_line2."',`location_id`='".$location_fetch["id"]."' WHERE `user_email`='".$user["email"]."';");

}else{

connect::executer("INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`location_id`) VALUES ('".$user["email"]."','".$address_line_1."','".$address_line2."','".$location_fetch["id"]."');");


}



$user_result=connect::executer("SELECT * FROM user WHERE `email`='".$user["email"]."';");


$_SESSION["user"]=$user_result->fetch_assoc();

}else{

  echo "A location with the city you selected was not found.";



}
}
}
?>