<?php
require "connection.php";
session_start();

if(isset($_SESSION["user"])){

$user = $_SESSION["user"];



$category =  addslashes($_POST["category"]);
$brand =  addslashes($_POST["brand"]);
$model =  addslashes($_POST["model"]);
$product_title =  addslashes($_POST["product_title"]);
$condition =  addslashes($_POST["condition"]);
$colour =  addslashes($_POST["colour"]);
$qty = (int)addslashes($_POST["qty"]);
$cost_p_i = (int)addslashes($_POST["cost_p_i"] );
$pwc = (int) addslashes($_POST["pwc"]);
$poc = (int) addslashes($_POST["poc"]);
$description =  addslashes($_POST["description"]);




if (empty($category)) {


    echo "Please select the category.";
} else if (empty($brand)) {

    echo "Please select the brand.";
} else if (empty($model)) {

    echo "Please select the model.";
} else if (empty($product_title)) {



    echo "Please enter the product's title.";
} else if (strlen($product_title) > 100) {



    echo "The product's title can't have more than 100 charactors.";
} else if (empty($condition)) {

    echo "Please select the condition.";
} else if (empty($condition)) {

    echo "Please select the condition.";
} else if (empty($colour)) {

    echo "Please select the colour.";
} else if (empty($qty)) {


    echo "Please enter the product's quantity.";
} else if ($qty == "0" || $qty == "e") {


    echo "Please enter the product's quantity.";
} else if (!is_int($qty)) {


    echo "The product's quantity must be an integer value.";
} else if (empty($cost_p_i)) {


    echo "Please enter the product's cost.";
} else if ($cost_p_i == "0" || $cost_p_i == "e") {


    echo "Please enter the product's cost.";
} else if (!is_int($cost_p_i)) {


    echo "The product's cost must be an integer value.";
} else if (empty($pwc)) {


    echo "Please enter the product's price within colombo.";
} else if ($pwc == "0" || $pwc == "e") {


    echo "Please enter the product's product's price within colombo.";
} else if (!is_int($pwc)) {


    echo "The  product's price within colombo must be an integer value.";
} else if (empty($poc)) {


    echo "Please enter the product's price out of colombo.";
} else if ($poc == "0" || $poc == "e") {


    echo "Please enter the product's  out of colombo.";
} else if (!is_int($poc)) {


    echo "The product's product's price out of colombo must be an integer value.";
} else if (empty($description)) {


    echo "Please enter the product's description.";
} else {

    $has_cat_result = connect::executer("SELECT * FROM model_has_brand WHERE `model_id`='" . $model . "' AND `brand_id`='" . $brand . "';");

    if ($has_cat_result->num_rows == 0) {

        echo "The model doesn't match the brand.";
    } else {

        $has_cat_fetch = $has_cat_result->fetch_assoc();

        $date = new DateTime();
        $timeZone = new DateTimeZone("Asia/Colombo");
        $date->setTimezone($timeZone);
        $register_date = $date->format("Y-m-d H:i:s");

        $prod_code=uniqid();

        $last_id;

        
       
        $allowed_file_formats = array("image/png", "image/jpeg", "image/svg");

        if($_POST["upload_image_length"]<=3&&$_POST["upload_image_length"]>=1){

        for($image_count=0;$image_count<$_POST["upload_image_length"];$image_count++){

      

          


            $upload_image = $_FILES["upload_image".$image_count];


            if (!in_array($upload_image["type"], $allowed_file_formats)) {

                echo "Invalid file format.";
            } else {

                if($image_count==0){

                    connect::executer("INSERT INTO `product`(`category_id`,`model_has_brand_id`,`title`,`color_id`,`price`,`qty`,`description`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`status_delete`,`approve_status`,`product_code`) VALUES('" . $category . "','" . $has_cat_fetch["id"] . "','" . $product_title . "','" . $colour . "','" . $cost_p_i . "','" . $qty . "','" . $description . "','" . $condition . "','1','" . $user["email"] . "','" . $register_date . "','" . $pwc . "','" . $poc . "','1','2','".$prod_code."');");

       
                    $last_id = connect::$dbms->insert_id;

                echo "Product added successfully!";

                }
                if ($upload_image["type"] == "image/png") {

                    $default_file_type = "png";
                } else if ($upload_image["type"] == "image/jpeg") {


                    $default_file_type = "jpg";
                } else if ($upload_image["type"] == "image/svg") {

                    $default_file_type = "svg";
                }



                $file_name = "product_images//" . uniqid() . "." . $default_file_type;

                move_uploaded_file($upload_image["tmp_name"], $file_name);

                connect::executer("INSERT INTO `image`(`code`,`product_id`) VALUES('" . $file_name . "','" . $last_id . "');");
            
        }
    }
                         
    }else{


         echo "You can only upload 3 or less images and you must select atleast 1 image.";


    }
    }
}
}
