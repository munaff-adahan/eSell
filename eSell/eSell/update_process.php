<?php
require "connection.php";
session_start();
$user = $_SESSION["user"];


$product_id = $_POST["product_id"];
$product_title = addslashes($_POST["product_title"]);
$qty = (int)addslashes($_POST["qty"]);
$cost_p_i = (int)addslashes($_POST["cost_p_i"]);
$pwc = (int) addslashes($_POST["pwc"]);
$poc = (int) addslashes($_POST["poc"]);
$description =  addslashes($_POST["description"]);




if (empty($product_title)) {



    echo "Please enter the product's title.";
} else if (strlen($product_title) > 100) {



    echo "The product's title can't have more than 100 charactors.";
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








    if (isset($_FILES["upload_image"])) {


        $upload_image = $_FILES["upload_image"];

        $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_id . "';");

        $image_fetch = $image_result->fetch_assoc();


        $allowed_file_formats = array("image/png", "image/jpeg", "image/svg");





        if (!in_array($upload_image["type"], $allowed_file_formats)) {

            echo "Invalid file format.";
        } else {


            if ($upload_image["type"] == "image/png") {

                $default_file_type = "png";
            } else if ($upload_image["type"] == "image/jpeg") {


                $default_file_type = "jpg";
            } else if ($upload_image["type"] == "image/svg") {

                $default_file_type = "svg";
            }



            $file_name = "product_images//" . uniqid() . "." . $default_file_type;

            move_uploaded_file($upload_image["tmp_name"], $file_name);

            connect::executer("UPDATE `image` SET `code`='" . $file_name . "' WHERE `code`='" . $image_fetch["code"] . "' AND `product_id`='" . $product_id . "';");


            unlink($image_fetch["code"]);

            connect::executer("UPDATE `product` SET `title`='" . $product_title . "',`qty`='" . $qty . "',`price`='" . $cost_p_i . "',`description`='" . $description . "',`delivery_fee_colombo`='" . $pwc . "',`delivery_fee_other`='" . $poc . "' WHERE `id`='" . $product_id . "';");



            echo "Product successfully updated!";
        }
    }else{


        connect::executer("UPDATE `product` SET `title`='".$product_title."',`qty`='".$qty."',`price`='".$cost_p_i."',`description`='".$description."',`delivery_fee_colombo`='".$pwc."',`delivery_fee_other`='".$poc."' WHERE `id`='".$product_id."';");
   


        echo "Product successfully updated!";
        



    }
}

?>
