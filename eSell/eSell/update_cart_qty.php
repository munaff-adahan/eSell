<?php
session_start();

require "connection.php";

$user = $_SESSION["user"];

$product_id = $_POST["product_id"];
$qty = $_POST["qty"];

$addres_result=connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='".$user["email"]."';");

$cart_product_res0 = connect::executer("SELECT  `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`,`product`.`condition_id`,  `product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`cart`.`product_id`,`cart`.`qty` AS `cart_qty`  FROM `cart` INNER JOIN `product` ON cart.`product_id`=product.`id` WHERE `cart`.`user_email`='" . $user["email"] . "' AND `product`.`id`= '" . $product_id . "' AND `product`.`qty`<>'0' AND `product`.`status_id`='1' AND `cart`.`qty`<=`product`.`qty` AND `cart`.`qty`<>'0';");

if($addres_result->num_rows==1){


if (!empty($qty)&&is_numeric($qty)) {


   


       
        



    if ($cart_product_res0->num_rows == 1) {


        $cart_product_fetch0 = $cart_product_res0->fetch_assoc();

        if ($qty > $cart_product_fetch0["qty"]) {

            echo "The cart's qty can't be greater than the product's original qty which is " . $cart_product_fetch0["qty"] . ".";
        } else {


          



            

          
                
            $cart_array;


            connect::executer("UPDATE `cart` SET `qty`='" . $qty . "' WHERE  `product_id`= '" . $product_id . "' AND  `user_email`='" . $user["email"] . "';");

            $cart_product_res1 = connect::executer("SELECT  `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`,`product`.`condition_id`,  `product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`cart`.`product_id`,`cart`.`qty` AS `cart_qty`  FROM `cart` INNER JOIN `product` ON cart.`product_id`=product.`id` WHERE `cart`.`user_email`='" . $user["email"] . "' AND `product`.`id`= '" . $product_id . "' AND `product`.`qty`<>'0' AND `product`.`status_id`='1' AND `cart`.`qty`<=`product`.`qty` AND `cart`.`qty`<>'0';");

            $cart_product_fetch1=$cart_product_res1->fetch_assoc(); 

   
   
               $addres_fetch=$addres_result->fetch_assoc();
   
   
               $location_fetch=connect::executer("SELECT * FROM `location` JOIN `district` ON `location`.`district_id`=`district`.`id` WHERE `location`.`id`='".$addres_fetch["location_id"]."';")->fetch_assoc()["name"];
   
   
   
   
               $cart_product_res = connect::executer("SELECT  `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`,`product`.`condition_id`,  `product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`cart`.`product_id`,`cart`.`qty` AS `cart_qty`  FROM `cart` INNER JOIN `product` ON cart.`product_id`=product.`id` WHERE `cart`.`user_email`='" . $user["email"] . "' AND `product`.`qty`<>'0' AND `product`.`status_id`='1' AND `cart`.`qty`<=`product`.`qty` AND  `cart`.`qty`<>'0' ;");
   
               $cart_product_rows=$cart_product_res->num_rows;

               $delivery_fee_single=$cart_product_fetch1["delivery_fee_other"];

               if ($location_fetch == "Colombo") {
   
                $delivery_fee_single = $cart_product_fetch1["delivery_fee_colombo"];
            }

      

   
          
   
              
   
              $price_total=0;
   
          
   
              $shipping_total=0;
   
   
               for($cart_count=0;$cart_count<$cart_product_rows;$cart_count++){
   
                   $cart_product_fetch=$cart_product_res->fetch_assoc();
   
                   $price_total = $price_total + $cart_product_fetch["price"] * $cart_product_fetch["cart_qty"];
   
                   $delivery_fee = $cart_product_fetch["delivery_fee_other"];
   
   
                   if ($location_fetch == "Colombo") {
   
                    $delivery_fee = $cart_product_fetch["delivery_fee_colombo"];
                }
    
                 
   
                   $shipping_total = $shipping_total + $delivery_fee;
   
   
   
               }

                 

            $cart_array["product_qty"]="Quantity : ".$cart_product_fetch1["cart_qty"];

            $cart_array["requeted_total"]="Rs.".$cart_product_fetch1["price"]*$cart_product_fetch1["cart_qty"]+$delivery_fee_single;

            $cart_array["total_price_with_ship"]="Rs.".$price_total+$shipping_total;

            $cart_array["total_price"]="Rs.".$price_total;


            echo json_encode($cart_array);
   



            
       

           
        }
    } else {



        echo "Product not found in the cart!";
    }


} else {


    echo "Please enter the qty.";
}

}else{

 echo "Please update your address first!";

}
?>