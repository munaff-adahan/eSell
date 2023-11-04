<?php
session_start();
require "connection.php";


if (isset($_GET["product_id"])) {


    $product_id = $_GET["product_id"];


    $product_res = connect::executer("SELECT * FROM `product` INNER JOIN `user` ON `product`.`user_email`=`user`.`email` WHERE `id`='" . $product_id . "' AND `product`.`status_id`='1' AND `product`.`status_delete`='1' AND `product`.`approve_status`='1';");





    if ($product_res->num_rows == 1) {



        $product_fetch = $product_res->fetch_assoc();



        $modal_brand_result = connect::executer("SELECT   * FROM `model_has_brand`   WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

        $modal_brand_fetch = $modal_brand_result->fetch_assoc();


?>


        <!DOCTYPE html>
        <html>

        <head>
            <title>eSell | View Products</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />


            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">




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

                    <hr class="hrbreak1" />

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">
                            <div class="bg-dark" style="padding: 11px;">

                                <div class="row">
                                    <div class="col-lg-2 order-lg-1 order-2">




                                        <?php


                                        $main_img1 = "211634_camera_icon.png";
                                        $main_img2 = "211634_camera_icon.png";
                                        $main_img3 = "211634_camera_icon.png";


                                        $new_img_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");


                                        for ($new_img_count = 0; $new_img_count < $new_img_result->num_rows; $new_img_count++) {

                                            $new_img_fetch = $new_img_result->fetch_assoc();

                                            if ($new_img_count == 0) {



                                                $main_img1 = $new_img_fetch["code"];
                                            } else if ($new_img_count == 1) {

                                                $main_img2 = $new_img_fetch["code"];
                                            } else if ($new_img_count == 2) {


                                                $main_img3 = $new_img_fetch["code"];
                                            }
                                        }



                                        ?>

                                        <ul>


                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary bg-white" onclick="chage_single('single1');">



                                                <img src="<?php echo $main_img1;  ?>" height="150px" class="mt-1 mb-1" id="single1" />





                                            </li>

                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary bg-white" onclick="chage_single('single2');">



                                                <img src="<?php echo $main_img2;  ?>" height="150px" class="mt-1 mb-1" id="single2" />





                                            </li>

                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary bg-white" onclick="chage_single('single3');">



                                                <img src="<?php echo $main_img3;  ?>" height="150px" class="mt-1 mb-1" id="single3" />





                                            </li>





                                        </ul>







                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none  d-lg-block ">


                                        <div class="d-flex  flex-column  align-items-lg-center border border-1 border-secondary pt-5 bg-white" style="height: 480px;" id="main_img_div">



                                            <img src="<?php echo $main_img1;  ?>" id="main_single" width="200px" />



                                        </div>






                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">

                                            <div class="col-12 pe-0">

                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb d-flex flex-wrap mb-0 list-unstyled bg-secondary rounded">
                                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                                                        <li class="breadcrumb-item active text-white" aria-current="page">Single View</li>
                                                    </ol>
                                                </nav>




                                            </div>

                                            <div class="col-12">


                                                <label class="form-label fs-4 fw-bold mt-0 text-white"><?php echo $product_fetch["title"];   ?></label>




                                            </div>



                                            <div class="col-12">

                                                <label class="d-inline-block fw-bold mt-1 fs-4 text-white">Rs.<?php echo $product_fetch["price"];   ?></label>

                                            </div>


                                            <hr class="hrbreak1" />

                                            <div class="col-12">

                                                <label class="text-primary fs-5"><b>Brand : </b><?php echo connect::executer("SELECT * FROM `brand` WHERE `id`='" . $modal_brand_fetch["brand_id"] . "';")->fetch_assoc()["name"];  ?> </label>
                                                <br />
                                                <label class="text-primary fs-5"><b>Model : </b><?php echo connect::executer("SELECT * FROM `model` WHERE `id`='" . $modal_brand_fetch["model_id"] . "';")->fetch_assoc()["name"];  ?></label>
                                                <br />
                                                <label class="text-primary fs-5"><b>Colour : </b><?php echo connect::executer("SELECT * FROM `color` WHERE `id`='" . $product_fetch["color_id"] . "';")->fetch_assoc()["name"]; ?></label>
                                                <br />
                                                <label class="text-primary fs-5"><b>Condtion : </b><?php echo connect::executer("SELECT * FROM `condition` WHERE `id`='" . $product_fetch["condition_id"] . "';")->fetch_assoc()["name"]; ?></label>

                                                <br />



                                                <?php

                                                $item_qty_status = $product_fetch["qty"];

                                                $item_status = "Items";

                                                $qty_class = "primary";

                                                if ($product_fetch["qty"] == 0) {

                                                    $item_qty_status = "No";

                                                    $qty_class = "danger";
                                                }


                                                if ($product_fetch["qty"] == 1) {

                                                    $item_status = "Item";
                                                }



                                                ?>



                                                <label class="text-<?php echo $qty_class;  ?> fs-5"><b>In Stock : </b><?php echo $item_qty_status . " " . $item_status; ?> available </label>


                                            </div>

                                            <hr class="hrbreak1" />


                                            <div class="col-12">

                                                <label class=" fs-2"><b>Seller Details </b></label>
                                                <br />
                                                <label class="text-success fs-5"><?php echo $product_fetch["fname"] . " " . $product_fetch["lname"];   ?></label>
                                                <br />
                                                <label class="text-success fs-5"><?php echo $product_fetch["email"]; ?></label>
                                                <br />
                                                <label class="text-success fs-5"><?php echo $product_fetch["mobile"]; ?></label>



                                            </div>

                                            <hr class="hrbreak1" />

                                            <div class="col-12">
                                                <div class="row">


                                                    <?php
                                                    if (isset($_SESSION["user"])) {
                                                    ?>

                                                        <button class="btn btn-secondary mt-2 col-3" onclick="goToChat('<?php echo $product_fetch['email']; ?>');">Contact Seller</button>

                                                    <?php
                                                    }
                                                    ?>

                                                </div>



                                            </div>


                                            <div class="col-12">

                                                <div class="row">
                                                    <div class="col-md-6 " style="margin-top: 15px;">

                                                        <div class="row">
                                                            <span>QTY :</span>
                                                            <div class=" overflow-hidden float-start product_qty pt-2">


                                                                <?php

                                                                $buy_qty = 1;

                                                                if (isset($_GET["qty"])) {

                                                                    $buy_qty = $_GET["qty"];
                                                                }

                                                                if ($product_fetch["qty"] != 0) {

                                                                ?>


                                                                    <input type="number" value="<?php echo $buy_qty; ?>" class="form-control mb-1" id="buy_now_qty" min="1" max="<?php echo $product_fetch["qty"];  ?>">


                                                                <?php

                                                                } else {

                                                                ?>

                                                                    <input type="number" value="0" class="form-control mb-1" readonly>


                                                                <?php
                                                                }

                                                                ?>

                                                            </div>




                                                        </div>






                                                    </div>







                                                </div>






                                            </div>

                                            <div class="col-12 ">
                                                <div class="row">

                                                    <div class="col-12 ">



                                                        <button class="btn btn-primary col-3" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add to cart</button>

                                                        <button class="btn btn-success col-3" onclick="buy_now(<?php echo $product_fetch['id'];  ?>,'single_buy_now');" type="submit" id="single_buy_now">Buy now</button>


                                                        <button class="btn btn-danger col-3" onclick="addToWhichlist('<?php echo $product_fetch['id'];  ?>');"><i class="bi bi-heart"></i></button>





                                                    </div>





                                                </div>




                                            </div>






                                        </div>





                                    </div>





                                </div>

                                <?php

                                $suggesion_result = connect::executer("SELECT `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`,`product`.`condition_id`,  `product`.`status_id`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other` FROM `product` JOIN `model_has_brand` ON `product`.`model_has_brand_id`=`model_has_brand`.`id` WHERE `model_has_brand`.`brand_id`='" . $modal_brand_fetch["brand_id"] . "' AND `product`.`id`<>'" . $product_fetch["id"] . "' AND   `product`.`status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1' AND `product`.`category_id`='".$product_fetch["category_id"]."'  ORDER BY `product`.`datetime_added` DESC LIMIT 4 OFFSET 0;");

                                if ($suggesion_result->num_rows != 0) {

                                ?>

                                    <div class="col-12">

                                        <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0  border-end-0 border-top-0 border-primary">


                                            <div class="col-md-6">

                                                <span class="text-white">Related Items</span>


                                            </div>





                                        </div>



                                    </div>

                                <?php
                                }

                                ?>

                                <div class="col-12">

                                    <div class="row">


                                        <?php





                                        while ($suggesion_fetch = $suggesion_result->fetch_assoc()) {
                                        ?>

                                            <div class="col-md-3 ">
                                                <div class="row p-2">

                                                    <div class="card">
                                                        <img src="<?php echo connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $suggesion_fetch["id"] . "';")->fetch_assoc()["code"]; ?>" class="card-img-top" alt="...">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $suggesion_fetch["title"]; ?></h5>
                                                            <p class="card-text">Rs.<?php echo $suggesion_fetch["price"]; ?></p>
                                                            <?php

                                                            $qty_status = "";


                                                            if ($suggesion_fetch["qty"] != 0) {

                                                            ?>


                                                                <input type="number" value="1" class="form-control mb-1" min="1" max="<?php echo $suggesion_fetch["qty"]; ?>" id="qty_selector_single<?php echo $suggesion_fetch['id']; ?>" />


                                                            <?php
                                                            } else {

                                                                $qty_status = "disabled";
                                                            ?>
                                                                <input type="number" value="0" class="form-control mb-1" readonly />
                                                            <?php
                                                            }
                                                            ?>
                                                            <a href="#" class="btn btn-success col-12 mt-2 " onclick="goToSingle(<?php echo $suggesion_fetch['id']; ?>);">Buy Now</a>
                                                            <a href="#" class="btn btn-danger mt-2 col-12 <?php echo $qty_status;  ?>" onclick="addToCart2('<?php echo $suggesion_fetch['id'];  ?>');">Add To Cart</a>
                                                            <a href="#" class="btn btn-secondary mt-2 col-12" onclick="addToWhichlist('<?php echo $suggesion_fetch['id'];  ?>');"><i class="bi bi-heart"></i></a>
                                                        </div>
                                                    </div>




                                                </div>



                                            </div>

                                        <?php
                                        }

                                        ?>





                                    </div>





                                </div>




                                <div class="col-12">

                                    <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0  border-end-0 border-top-0 border-primary">


                                        <div class="col-md-6">

                                            <span class="text-white">Product Details</span>


                                        </div>





                                    </div>



                                </div>




                                <div class="col-12">

                                    <div class="row">
                                        <div class="col-md-5 ">
                                            <div class="row p-2">

                                                <span class="text-white">Description</span>


                                                <textarea name="" id="" cols="100" rows="10" class="form-control" readonly><?php echo $product_fetch["description"]; ?></textarea>



                                            </div>



                                        </div>


                                    </div>





                                </div>






                                <div class="col-12">

                                    <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0  border-end-0 border-top-0 border-primary">


                                        <div class="col-md-6">

                                            <span class="text-white">Feedbacks</span>


                                        </div>





                                    </div>



                                </div>
                                <?php

                                $feed_result = connect::executer("SELECT * FROM  `feedback` JOIN `user` ON `feedback`.`user_email`=`user`.`email`  WHERE `product_id`='" . $product_id . "';");

                                if ($feed_result->num_rows == 0) {

                                ?>
                                    <div class="col-12 text-center">

                                        <div class="row">

                                            <h1 class="mt-1 text-secondary">This product has not got any feedbacks.</h1>


                                        </div>





                                    </div>

                                <?php

                                } else {

                                ?>
                                    <div class="col-12">
                                        <div class="row">


                                            <?php


                                            while ($feed_fetch = $feed_result->fetch_assoc()) {

                                            ?>

                                                <div class="col-6 border border-2 border-danger rounded d-inline-block">

                                                    <div class="row">

                                                        <h5 class="mt-1 text-primary"><?php echo $feed_fetch["fname"] . " " . $feed_fetch["lname"]; ?></h5>
                                                        <br />
                                                        <h6 class="mt-1 text-success"><?php echo $feed_fetch["feedback_txt"]; ?></h6>

                                                    </div>





                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>




                            </div>


                            <?php
                            require "footer.php";
                            ?>

                        </div>




                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                    <script src="bootstrap.js"></script>
                    <script src="bootstrap.bundle.js"></script>
                    <script src="script.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
                    <script src="sweetalert.min.js"></script>

                    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


        </body>




        </html>


<?php
    }
}

?>