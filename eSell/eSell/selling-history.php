<?php
session_start();

require "connection.php";



if (isset($_SESSION["admin"])) {

     


    $admin = $_SESSION["admin"];


    if(isset($_GET["f"])&&isset($_GET["t"])&&!empty($_GET["f"])&&!empty($_GET["t"])){


        
     


       $f_ex= explode("-",addslashes($_GET["f"]));

       $t_ex = explode("-",addslashes($_GET["t"]));

       $from=$f_ex[0].$f_ex[1].$f_ex[2];

       $to=$t_ex[0].$t_ex[1].$t_ex[2];


       if($from<$to){
?>

<!DOCTYPE html>

<html>

<head>

    <title>eSell | Manage Products</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body  >

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-dark text-center">
                <label class="form-label fs-2 fw-bold text-success">Product Selling History</label>
            </div>


            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-lg-2 col-2 bg-success text-white fw-bold p-2">
                        <span>Order Id</span>
                    </div>
                    <div class="col-lg-4 bg-secondary fw-bold p-2 d-none d-lg-block text-white">
                        <span>Product</span>
                    </div>
                    <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                        <span>Buyer</span>
                    </div>
                    <div class="col-lg-2 col-10  bg-secondary fw-bold p-2 text-white">
                        <span>Quantity</span>
                    </div>
                    <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                        <span>Price</span>
                    </div>
                </div>
            </div>

            <?php
            $sell_history_result = connect::executer("SELECT `invoice`.`id` AS `invoice_id`,  `invoice`.`user_email`,  `invoice`.`product_id`,  `invoice`.`date_time`,  `invoice`.`qty`, `invoice`.`order_id`,  `invoice`.`unit_price`,`product`.`title`,`product`.`user_email` AS `seller_email`,`user`.`fname`,`user`.`lname`  FROM `invoice` INNER JOIN `product` ON `invoice`.`product_id`=`product`.`id` INNER JOIN `user` ON `invoice`.`user_email`=`user`.`email`;");

            while ($sell_history_fetch = $sell_history_result->fetch_assoc()) {


                $selling_date_time_sub=substr($sell_history_fetch["date_time"],0,10);


                $selling_date_time_ex=explode("-",$selling_date_time_sub);

                $selling_date_time=$selling_date_time_ex[0].$selling_date_time_ex[1].$selling_date_time_ex[2];
                

                if($selling_date_time>=$from&&$selling_date_time<=$to){

            ?>

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-lg-2 col-2 bg-success text-white fw-bold p-2">
                            <span><?php  echo $sell_history_fetch["order_id"];  ?></span>
                        </div>
                        <div class="col-lg-4 bg-light fw-bold p-2 d-none d-lg-block">
                            <span><?php  echo $sell_history_fetch["title"];  ?></span>
                        </div>
                        <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                            <span><?php  echo $sell_history_fetch["fname"]." ".$sell_history_fetch["lname"];  ?></span>
                        </div>
                        <div class="col-lg-2 col-10  bg-light fw-bold p-2">
                            <span><?php  echo $sell_history_fetch["qty"];  ?></span>
                        </div>
                        <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                            <span><?php  echo $sell_history_fetch["unit_price"] * $sell_history_fetch["qty"];  ?></span>
                        </div>
                    </div>
                </div>
            <?php
                }
            }

            ?>




            <hr />


            <!-- footer -->
            <?php require "footer.php"; ?>
            <!-- footer -->

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
<?php
}else{
    ?>

    <script>window.location="admin.php";</script>
    
    <?php


}
}else{
?>

<script>window.location="admin.php";</script>

<?php



}


} else {


?>

    <script>
        window.location = "admin-signin.php";
    </script>

<?php




}


?>

