<?php

session_start();
require "connection.php";
$user = $_SESSION["user"];

$address_line1 = "";
$address_line2 = "";



$cart_product_res = connect::executer("SELECT  `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`,`product`.`condition_id`,  `product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`cart`.`product_id`,`cart`.`qty` AS `cart_qty`  FROM `cart` INNER JOIN `product` ON cart.`product_id`=product.`id` WHERE `product`.`title` LIKE  '%" .addslashes($_POST["search_txt"])  . "%'    AND `cart`.`user_email`='" . $user["email"] . "' AND `product`.`qty`<>'0' AND `product`.`status_id`='1' AND `cart`.`qty`<=`product`.`qty` AND `cart`.`qty`<>'0' AND `product`.`approve_status`='1';");


if ($cart_product_res->num_rows == 0) {

?>
    <div class="col-12">
        <div class="row">
            <div class="col-12 cartemptyview "></div>
            <div class="col-12 text-center">
                <label class="form-label fs-1 fw-bold text-success">No results found.</label>
            </div>
        </div>
    </div>


<?php
}

$user_address_1 = connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user["email"] . "';");

$city = "";


if ($user_address_1->num_rows == 1) {

    $user_fetch_1 = $user_address_1->fetch_assoc();

    $address_line1 = $user_fetch_1["line1"];
    $address_line2 = $user_fetch_1["line2"];

    $city_result = connect::executer("SELECT * FROM `location` WHERE `location`.`id`='" . $user_fetch_1["location_id"] . "';");

    $city_fetch = $city_result->fetch_assoc();

    $city = $city_fetch["district_id"];
}


?>

<?php

$shipping_total = 0;

$price_total = 0;

for ($cart_product_count = 0; $cart_product_count < $cart_product_res->num_rows; $cart_product_count++) {







    $cart_product_fetch = $cart_product_res->fetch_assoc();

    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $cart_product_fetch["model_has_brand_id"] . "';");

    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


    $user_result = connect::executer("SELECT * FROM user WHERE `email`='" . $cart_product_fetch["user_email"] . "';");

    $user_fetch = $user_result->fetch_assoc();




?>

    <div class="card mb-3  col-12 border ">
        <div class="row g-0">

            <div class="col-md-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <span class="fw-bold text-black-50 fs-5">Seller : </span>&nbsp;
                        <span class="fw-bold text-black fs-5"><?php echo $user_fetch["fname"] . " " . $user_fetch["lname"];    ?></span>
                    </div>
                </div>
            </div>

            <hr class="hrbreak1">

            <div class="col-md-3">
                <img src="<?php echo connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $cart_product_fetch["product_id"] . "';")->fetch_assoc()["code"]; ?>" class="img-fluid rounded-start" alt="..." tabindex="0" class="btn btn-lg btn-danger" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $cart_product_fetch["title"];  ?>" data-bs-content="<?php echo $cart_product_fetch["description"];  ?>">
            </div>



            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $cart_product_fetch["title"];  ?></h3>
                    <span class="fw-bold text-black-50">Colour : <?php echo connect::executer("SELECT * FROM `color` WHERE `id`='" . $cart_product_fetch["color_id"] . "';")->fetch_assoc()["name"]; ?></span> &nbsp; |
                    &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo connect::executer("SELECT * FROM `condition` WHERE `id`='" . $cart_product_fetch["condition_id"] . "';")->fetch_assoc()["name"];  ?></span><br />
                    <span class="fw-bold text-black-50 fs-5">Price : </span> &nbsp;
                    <span class="fw-bolder text-black fs-5">Rs.<?php echo $cart_product_fetch["price"];  ?> </span><br />
                    <span class="fw-bold text-black-50 fs-5" id="cart_prod_qty<?php echo $cart_product_fetch['product_id']; ?>">Quantity : <?php echo $cart_product_fetch["cart_qty"];  ?></span>
                    <input type="text" value="<?php echo $cart_product_fetch["cart_qty"];  ?>" min="1" max="<?php echo $cart_product_fetch['qty']; ?>" class="mt-3 form-control" id="cart_qty_cart_buy_now<?php echo $cart_product_fetch['product_id']; ?>" onkeyup="update_cart_qty(<?php echo $cart_product_fetch['product_id'];  ?>);"><br />
                    <span class="fw-boldertext-black-50 fs-5">Delivery fee</span>
                    <span class="fw-bolder text-black fs-5">Rs.<?php

                                                                $price_total = $price_total + $cart_product_fetch["price"] * $cart_product_fetch["cart_qty"];

                                                                $delivery_fee = $cart_product_fetch["delivery_fee_other"];



                                                                if ($city == 1) {

                                                                    $delivery_fee = $cart_product_fetch["delivery_fee_colombo"];
                                                                }

                                                                echo $delivery_fee;


                                                                $shipping_total = $shipping_total + $delivery_fee;

                                                                ?></span>
                </div>
            </div>

            <div class="col-md-3 mt-4">
                <div class="card-body d-grid">
                    <a href="#" class="btn btn-outline-success mb-2" onclick="goToSingle(<?php echo $cart_product_fetch['id'];  ?>);" id="cart_buy_now<?php echo $cart_product_count; ?>">By Now</a>
                    <!-- <a href="#" class="btn btn-outline-warning mb-2">Add to cart</a> -->
                    <a href="#" class="btn btn-outline-danger mb-2" onclick="remove_cart_product(<?php echo $cart_product_fetch['product_id'];  ?>);">Remove</a>
                </div>
            </div>

            <hr class="hrbreak1">

            <div class="col-md-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-6 col-md-6">
                        <span class="fw-bold fs-5 text-black-50">Requested Total<i class="bi bi-info-circle"></i></span>
                    </div>
                    <div class="col-6 col-md-6 text-end">
                        <span class="fw-bold fs-5 text-black-50" id="cart_requested<?php echo $cart_product_fetch['product_id']; ?>">Rs.<?php echo $cart_product_fetch["price"] * $cart_product_fetch["cart_qty"] + $delivery_fee;  ?></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
}
?>