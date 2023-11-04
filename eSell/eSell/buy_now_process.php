<?php

session_start();
require "connection.php";


if(isset($_SESSION["user"])){


    $user=$_SESSION["user"];

    $product_id=$_POST["product_id"];
    $qty= addslashes($_POST["qty"]);


      $product_result=connect::executer("SELECT * FROM `product` WHERE `id`='".$product_id."' AND `status_id`='1' AND `status_delete`='1' AND `approve_status`='1';");


      if($product_result->num_rows==1){


        $product_fetch=$product_result->fetch_assoc();


        if($product_fetch["qty"]!=0){

        $addres_result=connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='".$user["email"]."';");

         if($addres_result->num_rows==1){


            $addres_fetch=$addres_result->fetch_assoc();


            $location_fetch=connect::executer("SELECT * FROM `location` JOIN `district` ON `location`.`district_id`=`district`.`id` WHERE `location`.`id`='".$addres_fetch["location_id"]."';")->fetch_assoc()["name"];

                $shipping=0;


                 
               if($location_fetch=="Colombo"){

                $shipping=$product_fetch["delivery_fee_colombo"];

               }else{


                $shipping=$product_fetch["delivery_fee_other"];


               }


               if(!empty($qty)&&is_numeric($qty)){

          if($qty>0){

        if($qty<=$product_fetch["qty"]){


           $detail_array=$user+$product_fetch;

           
           $detail_array["total"]=$product_fetch["price"] * $qty+$shipping;

           $detail_array["address"]= $addres_fetch["line1"]." ".$addres_fetch["line2"];

           $detail_array["district"]= $location_fetch;

           $order_id=uniqid();

           $detail_array["order_id"]= $order_id;


           echo json_encode($detail_array);
               


        }else{


              echo "The qty can't be greater the original qty.";



        }
      }else{


          echo "The qty can't be less than 1.";



      }
    }else{


      echo "Please enter a qty.";


    }
    }else{

        echo "Please update your address first!";


    }
  }else{

      echo "The product is out of stock!";


  }
      }else{


         echo "Invalid Product.";




      }




      








}else{

echo "Sign In First!";



}
?>