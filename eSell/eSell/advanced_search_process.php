<?php
require "connection.php";
session_start();


$pro_view_offset = 0;

$pro_view_page = 1;


if (isset($_POST["p"])) {


    $pro_view_page = $_POST["p"];




    $pro_view_offset = 4 * ($pro_view_page - 1);
}



if (!empty($_POST["search_txt"])) {

    $search_txt = addslashes($_POST["search_txt"]);

?>

    <?php
    $product_result = connect::executer("SELECT * FROM `product` WHERE   `title` LIKE '%" . $search_txt . "%' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1'  AND `product`.`approve_status`='1'  LIMIT 4 OFFSET " . $pro_view_offset . ";");

    if ($product_result->num_rows == 0) {
    ?>
        <div class="alert alert-danger col-12" role="alert">
            No results found!
        </div>

    <?php
    }








    ?>

    <div class="row">

        <div class="offset-0 offset-lg-0 col-12 col-lg-12 text-center">

            <div class="row">
                <?php

                while ($product_fetch = $product_result->fetch_assoc()) {

                    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                    $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");



                ?>
                    <div class="card mb-3 col-12 col-lg-6 mb-3 mt-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $image_result->fetch_assoc()["code"];  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $product_fetch["title"]; ?></h5>

                                    <span class="card-text text-primary fw-bold">Rs.<?php echo $product_fetch["price"]; ?></span>
                                    <br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_fetch["qty"]; ?> items left</span>

                                    <?php

                                    $qty_status = "";


                                    if ($product_fetch["qty"] != 0) {

                                    ?>


                                        <input type="number" value="1" class="form-control " min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector_advanced<?php echo $product_fetch['id']; ?>" />


                                    <?php
                                    } else {

                                        $qty_status = "disabled";
                                    ?>
                                        <input type="number" value="0" class="form-control " readonly />
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-success d-grid" onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>




                                            </div>
                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-primary d-grid fs-6" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add To Cart</a>




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










    $user_product_result = connect::executer("SELECT * FROM `product` WHERE  `title` LIKE '%" . $search_txt . "%'  AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1' ;");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="advanced_search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

                <?php

                } else {

                ?>

                    <button class="frontlink ms-1">&laquo;</button>
                <?php


                }
                ?>
                <?php
                for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                    if ($paginate_count != $pro_view_page) {
                ?>
                        <button onclick="advanced_search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="advanced_search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="advanced_search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

                <?php
                } else {

                ?>
                    <button class="frontlink ms-1">&raquo;</button>
                <?php


                }
                ?>
            </div>



        </div>
    <?php
    }
    ?>
<?php

} else if (!empty($_POST["category"])) {

    $category =  addslashes($_POST["category"]);

?>

    <?php
    $product_result = connect::executer("SELECT * FROM `product` WHERE   `category_id` = '" . $category . "'  AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1'   LIMIT 4 OFFSET " . $pro_view_offset . ";");

    if ($product_result->num_rows == 0) {
    ?>
        <div class="alert alert-danger col-12" role="alert">
            No results found!
        </div>

    <?php
    }








    ?>

    <div class="row">

        <div class="offset-0 offset-lg-0 col-12 col-lg-12 text-center">

            <div class="row">
                <?php

                while ($product_fetch = $product_result->fetch_assoc()) {

                    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                    $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");



                ?>
                    <div class="card mb-3 col-12 col-lg-6 mb-3 mt-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $image_result->fetch_assoc()["code"];  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $product_fetch["title"]; ?></h5>

                                    <span class="card-text text-primary fw-bold">Rs.<?php echo $product_fetch["price"]; ?></span>
                                    <br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_fetch["qty"]; ?> items left</span>

                                    <?php

                                    $qty_status = "";


                                    if ($product_fetch["qty"] != 0) {

                                    ?>


                                        <input type="number" value="1" class="form-control " min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector_advanced<?php echo $product_fetch['id']; ?>" />


                                    <?php
                                    } else {

                                        $qty_status = "disabled";
                                    ?>
                                        <input type="number" value="0" class="form-control " readonly />
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-success d-grid" onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>




                                            </div>
                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-primary d-grid fs-6" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add To Cart</a>




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










    $user_product_result = connect::executer("SELECT * FROM `product` WHERE  `category_id` = '" . $category . "'  AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1' ;");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="advanced_search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

                <?php

                } else {

                ?>

                    <button class="frontlink ms-1">&laquo;</button>
                <?php


                }
                ?>
                <?php
                for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                    if ($paginate_count != $pro_view_page) {
                ?>
                        <button onclick="advanced_search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="advanced_search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="advanced_search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

                <?php
                } else {

                ?>
                    <button class="frontlink ms-1">&raquo;</button>
                <?php


                }
                ?>
            </div>



        </div>
    <?php
    }
    ?>
<?php

} else if (!empty($_POST["brand"])) {

    $brand =  addslashes($_POST["brand"]);

?>

    <?php
    $product_result = connect::executer("SELECT * FROM `product` WHERE   `product`.`model_has_brand_id`  IN  (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "') AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active')  AND `product`.`status_id`='1' AND `product`.`approve_status`='1'  LIMIT 4 OFFSET " . $pro_view_offset . ";");

    if ($product_result->num_rows == 0) {
    ?>
        <div class="alert alert-danger col-12" role="alert">
            No results found!
        </div>

    <?php
    }
    ?>
    <div class="row">

        <div class="offset-0 offset-lg-0 col-12 col-lg-12 text-center">

            <div class="row">

                <?php
                while ($product_fetch = $product_result->fetch_assoc()) {

                    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                    $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");



                ?>
                    <div class="card mb-3 col-12 col-lg-6 mb-3 mt-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $image_result->fetch_assoc()["code"];  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $product_fetch["title"]; ?></h5>

                                    <span class="card-text text-primary fw-bold">Rs.<?php echo $product_fetch["price"]; ?></span>
                                    <br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_fetch["qty"]; ?> items left</span>

                                    <?php

                                    $qty_status = "";


                                    if ($product_fetch["qty"] != 0) {

                                    ?>


                                        <input type="number" value="1" class="form-control " min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector_advanced<?php echo $product_fetch['id']; ?>" />


                                    <?php
                                    } else {

                                        $qty_status = "disabled";
                                    ?>
                                        <input type="number" value="0" class="form-control " readonly />
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-success d-grid" onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>




                                            </div>
                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-primary d-grid fs-6" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add To Cart</a>




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










    $user_product_result = connect::executer("SELECT * FROM `product` WHERE  `product`.`model_has_brand_id`  IN  (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "') AND `product`.`status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1'  ;");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="advanced_search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

                <?php

                } else {

                ?>

                    <button class="frontlink ms-1">&laquo;</button>
                <?php


                }
                ?>
                <?php
                for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                    if ($paginate_count != $pro_view_page) {
                ?>
                        <button onclick="advanced_search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="advanced_search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="advanced_search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

                <?php
                } else {

                ?>
                    <button class="frontlink ms-1">&raquo;</button>
                <?php


                }
                ?>
            </div>



        </div>
    <?php
    }
    ?>
<?php

} else if (!empty($_POST["model"])) {

    $model =  addslashes($_POST["model"]);

?>

    <?php
    $product_result = connect::executer("SELECT * FROM `product` WHERE   `product`.`model_has_brand_id`  IN  (SELECT `id` FROM `model_has_brand` WHERE `model_id`='" . $model . "')  AND `product`.`status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1'  LIMIT 4 OFFSET " . $pro_view_offset . ";");

    if ($product_result->num_rows == 0) {
    ?>
        <div class="alert alert-danger col-12" role="alert">
            No results found!
        </div>

    <?php
    }








    ?>

    <div class="row">

        <div class="offset-0 offset-lg-0 col-12 col-lg-12 text-center">

            <div class="row">
                <?php

                while ($product_fetch = $product_result->fetch_assoc()) {

                    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                    $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");



                ?>
                    <div class="card mb-3 col-12 col-lg-6 mb-3 mt-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $image_result->fetch_assoc()["code"];  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $product_fetch["title"]; ?></h5>

                                    <span class="card-text text-primary fw-bold">Rs.<?php echo $product_fetch["price"]; ?></span>
                                    <br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_fetch["qty"]; ?> items left</span>

                                    <?php

                                    $qty_status = "";


                                    if ($product_fetch["qty"] != 0) {

                                    ?>


                                        <input type="number" value="1" class="form-control " min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector_advanced<?php echo $product_fetch['id']; ?>" />


                                    <?php
                                    } else {

                                        $qty_status = "disabled";
                                    ?>
                                        <input type="number" value="0" class="form-control " readonly />
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-success d-grid" onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>




                                            </div>
                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-primary d-grid fs-6" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add To Cart</a>




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










    $user_product_result = connect::executer("SELECT * FROM `product` WHERE  `product`.`model_has_brand_id`  IN  (SELECT `id` FROM `model_has_brand` WHERE `model_id`='" . $model . "') AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1' ;");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="advanced_search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

                <?php

                } else {

                ?>

                    <button class="frontlink ms-1">&laquo;</button>
                <?php


                }
                ?>
                <?php
                for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                    if ($paginate_count != $pro_view_page) {
                ?>
                        <button onclick="advanced_search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="advanced_search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="advanced_search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

                <?php
                } else {

                ?>
                    <button class="frontlink ms-1">&raquo;</button>
                <?php


                }
                ?>
            </div>



        </div>
    <?php
    }
    ?>
<?php

} else if (!empty($_POST["condition"])) {

    $condition =  addslashes($_POST["condition"]);

?>

    <?php
    $product_result = connect::executer("SELECT * FROM `product` WHERE   `condition_id` = '" . $condition . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1'  LIMIT 4 OFFSET " . $pro_view_offset . ";");

    if ($product_result->num_rows == 0) {
    ?>
        <div class="alert alert-danger col-12" role="alert">
            No results found!
        </div>

    <?php
    }








    ?>

    <div class="row">

        <div class="offset-0 offset-lg-0 col-12 col-lg-12 text-center">

            <div class="row">

                <?php
                while ($product_fetch = $product_result->fetch_assoc()) {

                    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                    $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");



                ?>
                    <div class="card mb-3 col-12 col-lg-6 mb-3 mt-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $image_result->fetch_assoc()["code"];  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $product_fetch["title"]; ?></h5>

                                    <span class="card-text text-primary fw-bold">Rs.<?php echo $product_fetch["price"]; ?></span>
                                    <br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_fetch["qty"]; ?> items left</span>

                                    <?php

                                    $qty_status = "";


                                    if ($product_fetch["qty"] != 0) {

                                    ?>


                                        <input type="number" value="1" class="form-control " min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector_advanced<?php echo $product_fetch['id']; ?>" />


                                    <?php
                                    } else {

                                        $qty_status = "disabled";
                                    ?>
                                        <input type="number" value="0" class="form-control " readonly />
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-success d-grid" onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>




                                            </div>
                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-primary d-grid fs-6" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add To Cart</a>




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










    $user_product_result = connect::executer("SELECT * FROM `product` WHERE   `condition_id` = '" . $condition . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1' ;");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="advanced_search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

                <?php

                } else {

                ?>

                    <button class="frontlink ms-1">&laquo;</button>
                <?php


                }
                ?>
                <?php
                for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                    if ($paginate_count != $pro_view_page) {
                ?>
                        <button onclick="advanced_search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="advanced_search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="advanced_search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

                <?php
                } else {

                ?>
                    <button class="frontlink ms-1">&raquo;</button>
                <?php


                }
                ?>
            </div>



        </div>
    <?php
    }
    ?>
<?php

} else if (!empty($_POST["color"])) {

    $color =  addslashes($_POST["color"]);

?>

    <?php
    $product_result = connect::executer("SELECT * FROM `product` WHERE   `color_id` = '" . $color . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1'   LIMIT 4 OFFSET " . $pro_view_offset . ";");

    if ($product_result->num_rows == 0) {
    ?>
        <div class="alert alert-danger col-12" role="alert">
            No results found!
        </div>

    <?php
    }








    ?>

    <div class="row">

        <div class="offset-0 offset-lg-0 col-12 col-lg-12 text-center">

            <div class="row">
                <?php

                while ($product_fetch = $product_result->fetch_assoc()) {

                    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                    $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");



                ?>
                    <div class="card mb-3 col-12 col-lg-6 mb-3 mt-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $image_result->fetch_assoc()["code"];  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $product_fetch["title"]; ?></h5>

                                    <span class="card-text text-primary fw-bold">Rs.<?php echo $product_fetch["price"]; ?></span>
                                    <br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_fetch["qty"]; ?> items left</span>

                                    <?php

                                    $qty_status = "";


                                    if ($product_fetch["qty"] != 0) {

                                    ?>


                                        <input type="number" value="1" class="form-control " min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector_advanced<?php echo $product_fetch['id']; ?>" />


                                    <?php
                                    } else {

                                        $qty_status = "disabled";
                                    ?>
                                        <input type="number" value="0" class="form-control " readonly />
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-success d-grid" onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>




                                            </div>
                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-primary d-grid fs-6" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add To Cart</a>




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










    $user_product_result = connect::executer("SELECT * FROM `product` WHERE   `color_id` = '" . $color . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1' ;");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="advanced_search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

                <?php

                } else {

                ?>

                    <button class="frontlink ms-1">&laquo;</button>
                <?php


                }
                ?>
                <?php
                for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                    if ($paginate_count != $pro_view_page) {
                ?>
                        <button onclick="advanced_search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="advanced_search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="advanced_search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

                <?php
                } else {

                ?>
                    <button class="frontlink ms-1">&raquo;</button>
                <?php


                }
                ?>
            </div>



        </div>
    <?php
    }
    ?>
<?php

} else if (!empty($_POST["price_from"]) && !empty($_POST["price_to"]) && $_POST["price_from"] < $_POST["price_to"]) {

    $price_from =  addslashes($_POST["price_from"]);
    $price_to = addslashes($_POST["price_to"]);

?>

    <?php
    $product_result = connect::executer("SELECT * FROM `product` WHERE   `price` BETWEEN  '" . $price_from . "'  AND '" . $price_to . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1'  LIMIT 4 OFFSET " . $pro_view_offset . ";");

    if ($product_result->num_rows == 0) {
    ?>
        <div class="alert alert-danger col-12" role="alert">
            No results found!
        </div>

    <?php
    }








    ?>

    <div class="row">

        <div class="offset-0 offset-lg-0 col-12 col-lg-12 text-center">

            <div class="row">
                <?php

                while ($product_fetch = $product_result->fetch_assoc()) {

                    $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $product_fetch["model_has_brand_id"] . "';");

                    $modal_brand_fetch = $modal_brand_result->fetch_assoc();


                    $image_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $product_fetch["id"] . "';");



                ?>
                    <div class="card mb-3 col-12 col-lg-6 mb-3 mt-2">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $image_result->fetch_assoc()["code"];  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $product_fetch["title"]; ?></h5>

                                    <span class="card-text text-primary fw-bold">Rs.<?php echo $product_fetch["price"]; ?></span>
                                    <br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_fetch["qty"]; ?> items left</span>

                                    <?php

                                    $qty_status = "";


                                    if ($product_fetch["qty"] != 0) {

                                    ?>


                                        <input type="number" value="1" class="form-control " min="1" max="<?php echo $product_fetch["qty"]; ?>" id="qty_selector_advanced<?php echo $product_fetch['id']; ?>" />


                                    <?php
                                    } else {

                                        $qty_status = "disabled";
                                    ?>
                                        <input type="number" value="0" class="form-control " readonly />
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-success d-grid" onclick="goToSingle(<?php echo $product_fetch['id']; ?>);">Buy Now</a>




                                            </div>
                                            <div class="col-12 col-lg-12 mt-2">


                                                <a class="btn btn-primary d-grid fs-6" onclick="addToCart('<?php echo $product_fetch['id'];  ?>');">Add To Cart</a>




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










    $user_product_result = connect::executer("SELECT * FROM `product` WHERE   `price` BETWEEN  '" . $price_from . "'  AND '" . $price_to . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`status_id`='1' AND `product`.`approve_status`='1' ;");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="advanced_search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

                <?php

                } else {

                ?>

                    <button class="frontlink ms-1">&laquo;</button>
                <?php


                }
                ?>
                <?php
                for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                    if ($paginate_count != $pro_view_page) {
                ?>
                        <button onclick="advanced_search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="advanced_search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="advanced_search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

                <?php
                } else {

                ?>
                    <button class="frontlink ms-1">&raquo;</button>
                <?php


                }
                ?>
            </div>



        </div>
    <?php
    }
    ?>
<?php

}



?>