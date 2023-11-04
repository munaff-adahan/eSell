<?php
session_start();
require "connection.php";
$search_txt =  addslashes($_GET["search_txt"]);
$search_filter =  addslashes($_GET["search_filter"]);





$pro_view_offset = 0;

$pro_view_page = 1;


if (isset($_GET["p"])) {


    $pro_view_page = $_GET["p"];




    $pro_view_offset = 4 * ($pro_view_page - 1);
}



if (!empty($search_txt) && !empty($search_filter)) {




?>

    <?php


    ?>



    <div class="col-12   ">
        <div class="row border border-primary pe-2">
            <?php
            $product_result = connect::executer("SELECT * FROM `product` WHERE  `category_id`='" . $search_filter . "' AND `title` LIKE '%" . $search_txt . "%' AND `status_id`='1' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' LIMIT 4 OFFSET " . $pro_view_offset . ";");

            if ($product_result->num_rows == 0) {
            ?>
                <div class="alert alert-danger col-12" role="alert">
                    No results found!
                </div>

                <?php
            }

            for ($product_count = 0; $product_count < $product_result->num_rows; $product_count++) {

                $product_fetch = $product_result->fetch_assoc();


                if ($product_fetch != null) {


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
                                        <input type="number" value="0" class="form-control mb-1" readonly />
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
            }

            ?>





        </div>





    </div>


    <?php

    $user_product_result = connect::executer("SELECT * FROM `product` WHERE `category_id`='" . $search_filter . "' AND `title` LIKE '%" . $search_txt . "%'  AND `status_id`='1' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

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
                        <button onclick="search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

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
} else if (!empty($search_txt)) {


?>







    <div class="col-12   ">
        <div class="row border border-primary pe-2">
            <?php
            $product_result = connect::executer("SELECT * FROM `product` WHERE   `title` LIKE '%" . $search_txt . "%' AND `status_id`='1' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' LIMIT 4 OFFSET " . $pro_view_offset . ";");

            if ($product_result->num_rows == 0) {
            ?>
                <div class="alert alert-danger col-12" role="alert">
                    No results found!
                </div>

                <?php
            }

            for ($product_count = 0; $product_count < $product_result->num_rows; $product_count++) {

                $product_fetch = $product_result->fetch_assoc();


                if ($product_fetch != null) {


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
                                        <input type="number" value="0" class="form-control mb-1" readonly />
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
            }

            ?>





        </div>





    </div>


    <?php

    $user_product_result = connect::executer("SELECT * FROM `product` WHERE  `title` LIKE '%" . $search_txt . "%'  AND `status_id`='1' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

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
                        <button onclick="search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

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
} else if (!empty($search_filter)) {

?>


    <?php


    ?>



    <div class="col-12   ">
        <div class="row border border-primary pe-2">
            <?php
            $product_result = connect::executer("SELECT * FROM `product` WHERE  `category_id`='" . $search_filter . "' AND `status_id`='1' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' LIMIT 4 OFFSET " . $pro_view_offset . ";");

            if ($product_result->num_rows == 0) {
            ?>
                <div class="alert alert-danger col-12" role="alert">
                    No results found!
                </div>

                <?php
            }

            for ($product_count = 0; $product_count < $product_result->num_rows; $product_count++) {

                $product_fetch = $product_result->fetch_assoc();


                if ($product_fetch != null) {


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
                                        <input type="number" value="0" class="form-control mb-1" readonly />
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
            }

            ?>





        </div>





    </div>


    <?php

    $user_product_result = connect::executer("SELECT * FROM `product` WHERE `category_id`='" . $search_filter . "'  AND `status_id`='1' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';");


    $divide = $user_product_result->num_rows / 4;


    $product_full_amount = ceil($divide);

    if ($product_full_amount != 1 && $product_result->num_rows != 0) {

    ?>


        <div class="col-12 mb-3 d-flex justify-content-center">

            <div class="pagination  mt-2">
                <?php
                if ($pro_view_page != 1) {
                ?>
                    <button onclick="search(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

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
                        <button onclick="search(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                    <?php
                    } else {

                    ?>
                        <button onclick="search(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                    <?php

                    }
                }

                if ($pro_view_page != $product_full_amount) {
                    ?>


                    <button onclick="search(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

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