<?php
require "connection.php";

session_start();


if (isset($_SESSION["user"])) {

    $user = $_SESSION["user"];

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>eSell | Watchlist</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="bg-dark">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row mt-1 mb-1 text-white">
                        <div class="offset-lg-1 col-12 col-lg-4 align-self-start">

                            <span class="text-start label1"><b>Welcome</b><?php

                                                                            if (isset($_SESSION["user"])) {

                                                                                $user = $_SESSION["user"];

                                                                            ?>

                                <?php


                                                                                echo " " . $user["fname"];
                                                                            } else {

                                ?>

                                    <a href="index.php">Register or Sign In</a>

                                <?php








                                                                            }




                                ?>







                            </span> |
                            <?php
                            if (isset($_SESSION["user"])) {

                            ?>

                                <span class="text-start label2 sell" onclick="SignOut();">Sign Out</span>

                            <?php
                            }
                            ?>


                        </div>

                        <div class="offset-lg-9 col-12 col-lg-2 ">

                            <div class="row mb-5">
                                <div class="col-1 col-lg-1 ">
                                    <span class=" label2 sell" onclick="goToAddProduct();">Sell</span>


                                </div>
                                <div class="col-1 col-lg-1 offset-md-1  dropdown ">

                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        My eSell
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                                        <li><a class="dropdown-item" href="purchase-history.php">Purchase History</a></li>
                                        <li><a class="dropdown-item" href="messages.php">Messages</a></li>
                                        <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                                        <li><a class="dropdown-item" href="my-products.php">My Sellings</a></li>
                                    </ul>




                                </div>

                                <div class="col-1 col-lg-2 offset-3 offset-md-11 mt-1 carticon sell" onclick="goToCart();"></div>

                            </div>




                        </div>



                    </div>





                </div>

                <div class="col-12 border border-1 border-secondary rounded">
                    <div class="row">

                        <!-- topic start -->
                        <div class="col-12">
                            <label class="form-label  fs-1 fw-bolder text-success">Watchlist &heartsuit;</label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak1" />
                        </div>
                        <!-- topic close -->

                        <div class="col-12">
                            <div class="row">

                                <?php

                                $watch_product_res = connect::executer("SELECT * FROM `watchlist` INNER JOIN `product` ON watchlist.`product_id`=product.`id` WHERE `watchlist`.`user_email`='" . $user["email"] . "' AND `product`.`status_id`='1' AND  `product`.`approve_status`='1';");

                                if ($watch_product_res->num_rows == 0) {

                                ?>

                                    <!-- Search and button start -->

                                    <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in Watchlist" readonly />
                                    </div>
                                    <div class="col-12 col-lg-2 d-grid mb-3">
                                        <button class="btn btn-outline-success disabled">Search</button>
                                    </div>

                                <?php
                                } else {
                                ?>
                                    <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in Watchlist" id="watchlist_search" />
                                    </div>
                                    <div class="col-12 col-lg-2 d-grid mb-3">
                                        <button class="btn btn-outline-success" onclick="search_watchlist();">Search</button>
                                    </div>

                                <?php
                                }
                                ?>
                                <div class="col-12 ">
                                    <hr class="hrbreak1" />
                                </div>

                                <!-- Search and button close -->
                                <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary h-100">

                                    <!-- breadcrumb and  title -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav flex-column">
                                        <a class="nav-link  bg-success text-white" aria-current="page" href="#">My Watchlist</a>
                                        <a class="nav-link" href="cart.php">My Cart</a>

                                    </nav>
                                </div>

                                <!-- without items  start-->

                                <div class="col-9" id="watch_product_box">

                                    <!-- without items  close-->

                                    <!--items card start-->
                                    <?php



                                    if ($watch_product_res->num_rows == 0) {
                                    ?>
                                        <div class="col-12 col-lg-9 bg-white">
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

                                </div>
                                <!--items card close-->
                            </div>
                        </div>
                    </div>
                </div>

                <?php require "footer.php"; ?>
            </div>
        </div>


        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script src="sweetalert.min.js"></script>

    </body>

    </html>


<?php

} else {

?>
    <script src="script.js"></script>
    <script>
        goToHome();
    </script>

<?php




}

?>