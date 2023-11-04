<?php

session_start();
require "connection.php";


if(isset($_SESSION["user"])){


    $user=$_SESSION["user"];

  




       

        $addres_result=connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='".$user["email"]."';");

         if($addres_result->num_rows==1){


            $addres_fetch=$addres_result->fetch_assoc();


            $location_fetch=connect::executer("SELECT * FROM `location` JOIN `district` ON `location`.`district_id`=`district`.`id` WHERE `location`.`id`='".$addres_fetch["location_id"]."';")->fetch_assoc()["name"];




            $cart_product_res = connect::executer("SELECT  `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`,`product`.`condition_id`,  `product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`cart`.`product_id`,`cart`.`qty` AS `cart_qty`  FROM `cart` INNER JOIN `product` ON cart.`product_id`=product.`id` WHERE `cart`.`user_email`='" . $user["email"] . "' AND `product`.`qty`<>'0' AND `product`.`status_id`='1' AND `cart`.`qty`<=`product`.`qty` AND  `cart`.`qty`<>'0' ;");

            $cart_product_rows=$cart_product_res->num_rows;

       

           

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



           
           $detail_array["total"]=$price_total + $shipping_total;

           $detail_array["address"]= $addres_fetch["line1"]." ".$addres_fetch["line2"];

           $detail_array["district"]= $location_fetch;

           $order_id=uniqid();

           $detail_array["order_id"]= $order_id;

           $item_name="Items";

           if($cart_product_rows==1){

            $item_name="Item";


           }


           $detail_array["prod_amount"]=$cart_product_rows." ".$item_name;

           $detail_array=$detail_array+ $user;


           echo json_encode($detail_array);
               


       

          



     
    }else{

        echo "Please update your address first!";


    }

     




      








}else{

echo "Sign In First!";



}
?>