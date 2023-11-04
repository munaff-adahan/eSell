<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

    $user = $_SESSION["user"];

?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>eSell | My Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">





    </head>


    <body class="bg-dark">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-primary">
                    <div class="row">


                        <div class="col-4 bg-secondary">
                            <div class="row">
                                <div class="col-12 col-lg-4  mt-1 mb-1 text-center">

                                    <?php

                                    $img_result = connect::executer("SELECT * FROM `profile_img`  WHERE  `user_email`='" . $user["email"] . "';");



                                    if ($img_result->num_rows == 1) {
                                        $img_fetch = $img_result->fetch_assoc();

                                    ?>

                                        <img src="<?php echo $img_fetch["image_path"];  ?>" width="90px" height="90px" class="rounded-circle" id="img_pro_prev" style="width: 120px;height: 120px;" />

                                    <?php
                                    } else {
                                    ?>
                                        <img src="user_images//demoProfileImg.jpg" width="90px" height="90px" class="rounded-circle" id="img_pro_prev" style="width: 30px;height: 30px;" />
                                    <?php
                                    }
                                    ?>


                                </div>


                                <div class="col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-3">


                                            <span class="fw-bold"><?php echo $user["fname"] . " " . $user["lname"]; ?></span>




                                        </div>
                                        <div class="col-12">


                                            <span class="text-white"><?php echo $user["email"]; ?></span>



                                        </div>




                                    </div>




                                </div>




                            </div>

                        </div>


                        <div class="col-8 bg-secondary">
                            <div class="row">
                                <div class="col-12 mt-3 my-lg-3">



                                    <h1 class="offset-6 offset-lg-2 fw-bold text-white fs-1">My Products</h1>



                                </div>






                            </div>




                        </div>


                    </div>

                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-11 col-lg-2 mx-3 my-3 rounded bg-body border border-primary">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">
                                        <div class="co-12">

                                            <label class="form-label fw-bold fs-3">Filters</label>




                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">


                                                    <input type="text" class="form-control" placeholder="Search..." id="search_fil" />



                                                </div>

                                                <div class="col-1">


                                                    <label class="form-label bi bi-search"></label>



                                                </div>




                                            </div>




                                        </div>

                                        <div class="col-12">

                                            <label class="form-label fw-bold">Active Time</label>



                                        </div>

                                        <div class="col-12">


                                            <hr width="80%" />



                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" value="" id="age1_fil" name="t">
                                                <label class="form-check-label fs-5">
                                                    Newer To Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" value="" id="age2_fil" name="t">
                                                <label class="form-check-label fs-5">
                                                    Oldest To Newer
                                                </label>
                                            </div>


                                        </div>



                                        <div class="col-12">

                                            <label class="form-label fw-bold">By Quantity</label>



                                        </div>

                                        <div class="col-12">


                                            <hr width="80%" />



                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" value="" id="qty1_fil" name="lh">
                                                <label class="form-check-label fs-5">
                                                    Low To High
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" value="" id="qty2_fil" name="lh">
                                                <label class="form-check-label fs-5">
                                                    High To Low
                                                </label>
                                            </div>



                                        </div>



                                        <div class="col-12">

                                            <label class="form-label fw-bold">By Condition</label>



                                        </div>

                                        <div class="col-12">


                                            <hr width="80%" />



                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" value="" id="condition1_fil" name="c">
                                                <label class="form-check-label fs-5">
                                                    Brand New
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" value="" id="condition2_fil" name="c">
                                                <label class="form-check-label fs-5">
                                                    Used
                                                </label>
                                            </div>



                                        </div>


                                        <div class="col-12 text-center mb-3 mt-3">

                                            <button class="btn btn-primary col-12" onclick="filterProduct();">Search</button>
                                            <button class="btn btn-success mt-2 col-12" onclick="clear_filter();">Clear Filters</button>


                                        </div>





                                    </div>




                                </div>








                            </div>









                        </div>


                        <?php



                        $pro_view_offset = 0;

                        $pro_view_page = 1;


                        if (isset($_GET["p"])) {


                            $pro_view_page = $_GET["p"];


                            $pro_view_offset = 6 * ($pro_view_page - 1);
                        }

                        ?>

                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white" id="product_box_fil">
                            <div class="row">

                                <div class="col-10 offset-1 text-center">
                                    <div class="row justify-content-center" >

                                        <?php

                                        $search_result = connect::executer("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1'  LIMIT 6 OFFSET " . $pro_view_offset . ";"); //methana mage connection class eka poddak wenas




                                        while ($search_fetch = $search_result->fetch_assoc()) {

                                            


                                            
                                        ?>
                                                <div class="col-12 col-md-6 d-inline-block mt-3">
                                                    <div class="card mb-3">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <?php
                                                                $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $search_fetch["id"] . "' ;");
                                                                ?>
                                                                <img src="<?php echo $image_result->fetch_assoc()["code"]; ?>" class="img-fluid rounded-start" alt="...">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $search_fetch["title"];  ?></h5>
                                                                    <span class="card-text fw-bold text-primary">Rs.<?php echo $search_fetch["price"];  ?></span>
                                                                    <br />
                                                                    <span class="card-text fw-bold text-success"><?php echo $search_fetch["qty"];  ?> items left</span>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault<?php echo $search_fetch['id'];    ?>" onchange="changeStatus(<?php echo $search_fetch['id'];    ?>);" <?php if ($search_fetch['status_id'] == 1) {


                                                                                                                                                                                                                                                            ?> checked="" <?php



                                                                                                                                                                                                                                                                        } ?>>
                                                                        <label class="form-check-label text-info" for="flexSwitchCheckDefault<?php echo $search_fetch['id'];    ?>" id="status_txt<?php echo $search_fetch['id'];    ?>"><?php if ($search_fetch['status_id'] == 1) {
                                                                                                                                                                                        echo "Your product is active.";
                                                                                                                                                                                    } else {

                                                                                                                                                                                        echo "Your product is deactive.";
                                                                                                                                                                                    } ?></label>
                                                                    </div>

                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row pb-3">

                                                                        <div class="col-12 col-md-6 d-grid">

                                                                            <button class="btn btn-success" onclick="update_product_redirect();">Update Product</button>



                                                                        </div>
                                                                        <div class="col-12 col-md-6 d-grid pe-3 mt-1 mt-md-0">

                                                                            <button class="btn btn-danger" onclick="delete_prev(<?php echo $search_fetch['id'];  ?>,<?php echo $pro_view_page;  ?>);">Delete Product</button>

                                                                            <!-- Methana oyaage widihata daanna magee poddak wenas wenna athi -->

                                                                        </div>




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




                                </div>





                            </div>

                            <?php

                            $user_product_result = connect::executer("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `status_id`='1' AND `status_delete`='1' AND `approve_status`='1';");


                            $divide = $user_product_result->num_rows / 6;


                            $product_full_amount = ceil($divide);

                            if ($product_full_amount != 1) {

                            ?>


                                <div class="col-12 mb-3 d-flex justify-content-center">

                                    <div class="pagination">
                                        <?php
                                        if ($pro_view_page != 1) {
                                        ?>
                                            <a href="?p=<?php echo $pro_view_page - 1;  ?>">&laquo;</a>

                                        <?php

                                        } else {

                                        ?>

                                            <a class="frontlink">&laquo;</a>
                                        <?php


                                        }
                                        ?>
                                        <?php
                                        for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                                            if ($paginate_count != $pro_view_page) {
                                        ?>
                                                <a href="?p=<?php echo $paginate_count;  ?>"><?php echo $paginate_count  ?></a>


                                            <?php
                                            } else {

                                            ?>
                                                <a href="?p=<?php echo $paginate_count;  ?>" class="active"><?php echo $paginate_count  ?></a>

                                            <?php

                                            }
                                        }

                                        if ($pro_view_page != $product_full_amount) {
                                            ?>


                                            <a href="?p=<?php echo $pro_view_page + 1;  ?>">&raquo;</a>

                                        <?php
                                        } else {

                                        ?>
                                            <a class="frontlink">&raquo;</a>
                                        <?php


                                        }
                                        ?>
                                    </div>



                                </div>
                            <?php
                            }

                            ?>




                        </div>








                    </div>





                </div>



             <?php  require "footer.php";  ?>




            </div>

        </div>



        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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