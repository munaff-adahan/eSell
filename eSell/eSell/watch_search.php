<?php
session_start();

$user = $_SESSION["user"];

require "connection.php";


$watch_product_res = connect::executer("SELECT * FROM `watchlist` INNER JOIN `product` ON watchlist.`product_id`=product.`id` WHERE `watchlist`.`user_email`='" . $user["email"] . "' AND `product`.`title` LIKE '%" . addslashes($_POST["search_txt"]) . "%'  AND `product`.`status_id`='1' AND  `product`.`approve_status`='1';");


if ($watch_product_res->num_rows == 0) {
?>
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="col-12 emptyview"></div>
            <div class="col-12 text-center">
                <label class="form-label fs-1 mb-3 fw-bolder text-success">No results found</label>
            </div>
        </div>
    </div>



<?php





}
?>





<?php

for ($watch_product_count = 0; $watch_product_count < $watch_product_res->num_rows; $watch_product_count++) {





    $watch_product_fetch = $watch_product_res->fetch_assoc();

    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $watch_product_fetch["model_has_brand_id"] . "';");

    $modal_brand_fetch = $modal_brand_result->fetch_assoc();





?>


    <div class="col-12 col-lg-9">
        <div class="row g-2">
            <!-- card -->

            <div class="card mb-3 mx-3 col-12">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $watch_product_fetch["product_id"] . "';")->fetch_assoc()["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $watch_product_fetch["title"]; ?></h3>
                            <?php

                            $qty_status = "";


                            if ($watch_product_fetch["qty"] != 0) {

                            ?>


                                <input type="number" value="1" class="form-control mb-1" min="1" max="<?php echo $watch_product_fetch["qty"]; ?>" id="qty_selector_watch<?php echo $watch_product_fetch['id']; ?>" />


                            <?php
                            } else {

                                $qty_status = "disabled";
                            ?>
                                <input type="number" value="0" class="form-control mb-1" readonly />
                            <?php
                            }
                            ?>
                            <span class="fw-bold text-black-50">Colour : <?php echo connect::executer("SELECT * FROM `color` WHERE `id`='" . $watch_product_fetch["color_id"] . "';")->fetch_assoc()["name"]; ?></span> &nbsp; | &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo connect::executer("SELECT * FROM `condition` WHERE `id`='" . $watch_product_fetch["condition_id"] . "';")->fetch_assoc()["name"];  ?></span>
                            <br />
                            <span class="fw-bold text-black-50 fs-5">Price : </span> &nbsp; <span class="fw-bold text-black fs-5">Rs. <?php echo $watch_product_fetch["price"];   ?> </span>
                            <br />
                            <span class="fw-bold text-black-50 fs-5">Seller : </span>
                            <br />
                            <?php
                            $user_result = connect::executer("SELECT * FROM user WHERE `email`='" . $watch_product_fetch["user_email"] . "';");

                            $user_fetch = $user_result->fetch_assoc();
                            ?>
                            <span class="fw-bold text-black fs-5"><?php echo $user_fetch["fname"] . " " . $user_fetch["lname"];  ?></span>
                            <br />
                            <span class="fw-bold text-black fs-5"><?php echo $user_fetch["email"];  ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 mt-4 ">
                        <div class="card-body d-grid">
                            <a href="#" class="btn btn-outline-success fw-bold mb-2" onclick="goToSingle(<?php echo $watch_product_fetch['id']; ?>);">By Now</a>
                            <a href="#" class="btn btn-outline-warning fw-bold mb-2" onclick="addToCart('<?php echo $watch_product_fetch['id'];  ?>');">Add Cart</a>
                            <a href="#" class="btn btn-outline-danger fw-bold mb-2" onclick="remove_from_watchlist(<?php echo $watch_product_fetch['product_id']; ?>);">Remove</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php

}
?>