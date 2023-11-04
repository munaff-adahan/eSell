<?php
session_start();
require "connection.php";


?>

<head>

    <title>eSell | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="pagination.css">


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
            <div class="col-12 col-md-10 offset-md-2">
                <div class="row">
                    <div class="offset-lg-1 col-1 ms-3 logoimg" style="background-position: center;"></div>
                    <div class="col-8 col-md-6">
                        <div class="input-group mt-2 mt-md-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="search_txt_basic" placeholder="Search...">

                            <select class="form-select" id="search_filter">
                                <option value="">Select Categories</option>
                                <?php
                                $category_drop = connect::executer("SELECT * FROM category;");

                                for ($category_drop_count = 0; $category_drop_count < $category_drop->num_rows; $category_drop_count++) {

                                    $category_fetch = $category_drop->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_fetch["id"]; ?>"><?php echo $category_fetch["name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>


                        </div>




                    </div>

                    <div class="col-12 col-lg-2 d-grid mb-3 h-50 mt-3">
                        <button class="btn btn-outline-success" onclick="search(1);">Search</button>
                    </div>



                    <div class="col-2 mt-md-3">
                        <a class="link-secondary link1 sell" onclick="goToAdvanced();">Advanced</a>


                    </div>






                </div>






            </div>
            <hr class="hrbreak1 mt-3" />

            <div id="search_result_basic_box">
                <div class="col-10 offset-md-1 d-none d-md-block">
                    <div class="row">
                        <div id="carouselExampleCaptions" class="carousel slide h-2" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="Slider_images/eCommerce-Cartoon.png" class="d-block w-100 img-fluid" alt="...">
                                    <div class="carousel-caption d-none d-md-block postercaption text-success">
                                        <h5 class="postertitle text-success">Welcome to eSell</h5>
                                        <p class="postertxt text-success">The World's Best Online Store By One Click.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="Slider_images/slideshow-examples-webdesign.png" class="d-block w-100 img-fluid" alt="...">
                                    <div class="carousel-caption d-none d-md-block">

                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="Slider_images/360_F_300723453_obetA0TWGOY4AmLKTs5xC7DoJWkQfqiJ.jpg" class="d-block w-100 img-fluid" alt="...">
                                    <div class="carousel-caption d-none d-md-block postercaption me-5" style="margin-left: -30px;">
                                        <h5 class="postertitle text-success">Be Free.....</h5>
                                        <p class="postertxt text-success">Experience the Lowest Delivery Costs With Us.</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>





                    </div>


                </div>

                <?php
                $category_result = connect::executer("SELECT * FROM category;");

                for ($category_count = 0; $category_count < $category_result->num_rows; $category_count++) {

                    $category_fetch = $category_result->fetch_assoc();

                    $product_result = connect::executer("SELECT * FROM `product` WHERE `category_id`='" . $category_fetch["id"] . "' AND `status_id` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0;");
                    if ($product_result->num_rows != 0) {
                ?>

                    <div class="">

                        <a href="#" class="link-dark link2 text-light"><?php echo $category_fetch["name"]; ?></a>&nbsp;&nbsp;
                       


                    </div>

                    <div class="col-12   ">
                        <div class="row border border-primary pe-2">
                            <?php
                       

                            if ($product_result->num_rows == 0) {
                            ?>
                                <div class="alert alert-danger col-12" role="alert">
                                    The category <b><?php echo $category_fetch["name"];  ?></b> has not got any products.
                                </div>

                            <?php
                            }

                            for ($product_count = 0; $product_count < $product_result->num_rows; $product_count++) {

                                $product_fetch = $product_result->fetch_assoc();


                                $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                                $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                                $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");
                            ?>
                                <div class=" col-md-3 d-inline-block ">
                                    <div class="row px-5 px-md-0">
                                        <div class="card col-12 col-lg-12  mt-1 mx-1 h-100">
                                            <img src="<?php echo $image_result->fetch_assoc()["code"]; ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $product_fetch["title"]; ?><span class="badge bg-info">New</span></h5>
                                                <span class="card-text text-primary"><?php echo "Rs." . $product_fetch["price"];  ?></span>
                                                <br />
                                                <?php
                                                $status = "";
                                                if ($product_fetch["qty"] != 0) {
                                                ?>
                                                    <span class="card-text text-warning">In Stock</span>
                                                <?php
                                                } else {

                                                    $status = "disabled";

                                                ?>
                                                    <span class="card-text text-danger">Out Of Stock</span>
                                                <?php
                                                }
                                                ?>


                                                <?php

                                                if ($product_fetch["qty"] != 0) {

                                                ?>


                                                    <input type="number" value="1" class="form-control mb-1" min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector<?php echo $product_fetch['id']; ?>" />


                                                <?php
                                                } else {
                                                ?>
                                                    <input type="number" value="0" class="form-control mb-1" readonly/>
                                                <?php
                                                }
                                                ?>
                                                <a href="#" class="btn btn-success col-12 " onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>
                                                <a href="#" class="btn btn-danger mt-2 col-12 <?php echo $status; ?>" onclick="addToCart(<?php echo $product_fetch['id']; ?>);">Add To Cart</a>
                                                <a href="#" class="btn btn-secondary mt-2 col-12 " onclick="addToWhichlist(<?php echo $product_fetch['id']; ?>);"><i class="bi bi-heart"></i></a>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            <?php
                            }

                            ?>





                        </div>





                    </div>
                <?php
                    }
                }
                ?>
            </div>
            <?php
            require "footer.php";

            ?>

        </div>







    </div>



    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="sweetalert.min.js"></script>
    <script src="script.js"></script>
</body>






</html>