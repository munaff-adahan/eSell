<?php
session_start();
require "connection.php";

$user=$_SESSION["user"];


?>



<div class="row">

    <!-- Search and button start -->

    <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
        <input type="text" class="form-control" placeholder="Search in Watchlist" />
    </div>
    <div class="col-12 col-lg-2 d-grid mb-3">
        <button class="btn btn-outline-primary">Search</button>
    </div>
    <div class="col-12 ">
        <hr class="hrbreak1" />
    </div>

    <!-- Search and button close -->
    <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary h-100">

        <!-- breadcrumb and  title -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
            </ol>
        </nav>
        <nav class="nav flex-column">
            <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
            <a class="nav-link" href="#">My Cart</a>
            <a class="nav-link" href="#">Recently Viewed</a>
        </nav>
    </div>

    <!-- without items  start-->



    <!-- without items  close-->

    <!--items card start-->
    <?php

    $watch_product_res = connect::executer("SELECT * FROM `watchlist` INNER JOIN `product` ON watchlist.`product_id`=product.`id` WHERE `watchlist`.`user_email`='" . $user["email"] . "';");

    if ($watch_product_res->num_rows == 0) {
    ?>
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12 emptyview"></div>
                <div class="col-12 text-center">
                    <label class="form-label fs-1 mb-3 fw-bolder">You have no items in your
                        Watchlist</label>
                </div>
            </div>
        </div>



    <?php





    }

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
                                <h3 class="card-title"><?php echo $modal_brand_fetch["brand_name"] . " " . $modal_brand_fetch["model_name"]; ?></h3>
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
                                <a href="#" class="btn btn-outline-success fw-bold mb-2">By Now</a>
                                <a href="#" class="btn btn-outline-warning fw-bold mb-2">Add Cart</a>
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
    <!--items card close-->
</div>