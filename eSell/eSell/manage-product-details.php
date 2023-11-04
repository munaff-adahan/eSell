<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {



?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>eSell | Manage Product Details</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="pagination.css" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-dark text-center ">
                    <label class="form-label fs-2 fw-bold text-success">Manage Product Related Details</label>
                </div>

                <div class="row mt-3">

                    <div class="col-12 text-center text-secondary">

                        <h1>Add Categories</h1>

                    </div>

                    <div class="col-sm-6" id="category_box">

                        <table class="table table-striped table-hover">
                            <tr>

                                <th>#</th>
                                <th>Name</th>

                            </tr>
                            <?php

                            $category_count = 0;

                            $category_result = connect::executer("SELECT * FROM `category` LIMIT 3 OFFSET 0;");

                            while ($category_fetch = $category_result->fetch_assoc()) {

                            ?>
                                <tr>

                                    <td><?php echo $category_count += 1; ?></td>
                                    <td><?php echo $category_fetch["name"];  ?></td>

                                </tr>

                            <?php
                            }
                            ?>

                        </table>
                        <?php

                        $user_product_result = connect::executer("SELECT * FROM `category`;");


                        $divide = $user_product_result->num_rows / 3;


                        $product_full_amount = ceil($divide);

                        if ($product_full_amount != 1 && $user_product_result->num_rows != 0) {

                        ?>


                            <div class="col-12 mb-3 d-flex justify-content-center">

                                <div class="pagination  mt-2">


                                    <?php


                                    ?>

                                    <button class="frontlink ms-1">&laquo;</button>
                                    <?php



                                    ?>
                                    <?php
                                    for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                                        if ($paginate_count != 1) {
                                    ?>
                                            <button onclick="paginate_category(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                                        <?php
                                        } else {

                                        ?>
                                            <button onclick="paginate_category(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                                    <?php

                                        }
                                    }
                                    ?>


                                    <button onclick="paginate_category(2);" class="ms-1">&raquo;</button>


                                </div>



                            </div>
                        <?php
                        }

                        ?>





                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Enter the category name</h5>
                                <input type="text" class="form-control" id="category_txt" />
                                <a href="#" class="btn btn-primary mt-3" onclick="add_category();">Add Category</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="col-12 border-1 border border-primary" />


                <div class="row mt-3">

                    <div class="col-12 text-center text-secondary">

                        <h1>Add Brands</h1>

                    </div>

                    <div class="col-sm-6" id="brand_box">

                        <table class="table table-striped table-hover">
                            <tr>

                                <th>#</th>
                                <th>Name</th>

                            </tr>
                            <?php

                            $category_count = 0;

                            $category_result = connect::executer("SELECT * FROM `brand` LIMIT 3 OFFSET 0;");

                            while ($category_fetch = $category_result->fetch_assoc()) {

                            ?>
                                <tr>

                                    <td><?php echo $category_count += 1; ?></td>
                                    <td><?php echo $category_fetch["name"];  ?></td>

                                </tr>

                            <?php
                            }
                            ?>

                        </table>
                        <?php

                        $user_product_result = connect::executer("SELECT * FROM `brand`;");


                        $divide = $user_product_result->num_rows / 3;


                        $product_full_amount = ceil($divide);

                        if ($product_full_amount != 1 && $user_product_result->num_rows != 0) {

                        ?>


                            <div class="col-12 mb-3 d-flex justify-content-center">

                                <div class="pagination  mt-2">


                                    <?php


                                    ?>

                                    <button class="frontlink ms-1">&laquo;</button>
                                    <?php



                                    ?>
                                    <?php
                                    for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                                        if ($paginate_count != 1) {
                                    ?>
                                            <button onclick="paginate_brand(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                                        <?php
                                        } else {

                                        ?>
                                            <button onclick="paginate_brand(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                                    <?php

                                        }
                                    }
                                    ?>


                                    <button onclick="paginate_brand(2);" class="ms-1">&raquo;</button>


                                </div>



                            </div>
                        <?php
                        }

                        ?>





                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Enter the brand name</h5>
                                <input type="text" class="form-control" id="brand_txt" />
                                <a href="#" class="btn btn-primary mt-3" onclick="add_brand();">Add Brand</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="col-12 border-1 border border-primary" />





                <div class="row mt-3">

                    <div class="col-12 text-center text-secondary">

                        <h1>Add Models</h1>

                    </div>

                    <div class="col-sm-6" id="model_box">

                        <table class="table table-striped table-hover">
                            <tr>

                                <th>#</th>
                                <th>Name</th>

                            </tr>
                            <?php

                            $category_count = 0;

                            $category_result = connect::executer("SELECT * FROM `model` LIMIT 3 OFFSET 0;");

                            while ($category_fetch = $category_result->fetch_assoc()) {

                            ?>
                                <tr>

                                    <td><?php echo $category_count += 1; ?></td>
                                    <td><?php echo $category_fetch["name"];  ?></td>

                                </tr>

                            <?php
                            }
                            ?>

                        </table>
                        <?php

                        $user_product_result = connect::executer("SELECT * FROM `model`;");


                        $divide = $user_product_result->num_rows / 3;


                        $product_full_amount = ceil($divide);

                        if ($product_full_amount != 1 && $user_product_result->num_rows != 0) {

                        ?>


                            <div class="col-12 mb-3 d-flex justify-content-center">

                                <div class="pagination  mt-2">


                                    <?php


                                    ?>

                                    <button class="frontlink ms-1">&laquo;</button>
                                    <?php



                                    ?>
                                    <?php
                                    for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                                        if ($paginate_count != 1) {
                                    ?>
                                            <button onclick="paginate_model(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                                        <?php
                                        } else {

                                        ?>
                                            <button onclick="paginate_model(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                                    <?php

                                        }
                                    }
                                    ?>


                                    <button onclick="paginate_model(2);" class="ms-1">&raquo;</button>


                                </div>



                            </div>
                        <?php
                        }

                        ?>





                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Enter the model name</h5>
                                <input type="text" class="form-control" id="model_txt" />
                                <a href="#" class="btn btn-primary mt-3" onclick="add_model();">Add Model</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="col-12 border-1 border border-primary" />



                <div class="row mt-3">

                    <div class="col-12 text-center text-secondary">

                        <h1>Add Colours</h1>

                    </div>

                    <div class="col-sm-6" id="color_box">

                        <table class="table table-striped table-hover">
                            <tr>

                                <th>#</th>
                                <th>Name</th>

                            </tr>
                            <?php

                            $category_count = 0;

                            $category_result = connect::executer("SELECT * FROM `color` LIMIT 3 OFFSET 0;");

                            while ($category_fetch = $category_result->fetch_assoc()) {

                            ?>
                                <tr>

                                    <td><?php echo $category_count += 1; ?></td>
                                    <td><?php echo $category_fetch["name"];  ?></td>

                                </tr>

                            <?php
                            }
                            ?>

                        </table>
                        <?php

                        $user_product_result = connect::executer("SELECT * FROM `color`;");


                        $divide = $user_product_result->num_rows / 3;


                        $product_full_amount = ceil($divide);

                        if ($product_full_amount != 1 && $user_product_result->num_rows != 0) {

                        ?>


                            <div class="col-12 mb-3 d-flex justify-content-center">

                                <div class="pagination  mt-2">


                                    <?php


                                    ?>

                                    <button class="frontlink ms-1">&laquo;</button>
                                    <?php



                                    ?>
                                    <?php
                                    for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                                        if ($paginate_count != 1) {
                                    ?>
                                            <button onclick="paginate_color(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                                        <?php
                                        } else {

                                        ?>
                                            <button onclick="paginate_color(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                                    <?php

                                        }
                                    }
                                    ?>


                                    <button onclick="paginate_color(2);" class="ms-1">&raquo;</button>


                                </div>



                            </div>
                        <?php
                        }

                        ?>





                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Enter the colour name</h5>
                                <input type="text" class="form-control" id="color_txt" />
                                <a href="#" class="btn btn-primary mt-3" onclick="add_color();">Add Colour</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="col-12 border-1 border border-primary" />

                <div class="row mt-3">

                    <div class="col-12 text-center text-secondary">

                        <h1>Match brands and models</h1>

                    </div>

                    <div class="col-sm-6" id="match_box">

                        <table class="table table-striped table-hover">
                            <tr>

                                <th>#</th>
                                <th>Brand Name</th>
                                <th>Model Name</th>


                            </tr>
                            <?php

                            $category_count = 0;

                            $category_result = connect::executer("SELECT `model`.`name` AS `model_name`,`brand`.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` LIMIT 3 OFFSET 0;");

                            while ($category_fetch = $category_result->fetch_assoc()) {

                            ?>
                                <tr>

                                    <td><?php echo $category_count += 1; ?></td>
                                    <td><?php echo $category_fetch["brand_name"];  ?></td>
                                    <td><?php echo $category_fetch["model_name"];  ?></td>

                                </tr>

                            <?php
                            }
                            ?>

                        </table>
                        <?php

                        $user_product_result = connect::executer("SELECT * FROM `model_has_brand`;");


                        $divide = $user_product_result->num_rows / 3;


                        $product_full_amount = ceil($divide);

                        if ($product_full_amount != 1 && $user_product_result->num_rows != 0) {

                        ?>


                            <div class="col-12 mb-3 d-flex justify-content-center">

                                <div class="pagination  mt-2">


                                    <?php


                                    ?>

                                    <button class="frontlink ms-1">&laquo;</button>
                                    <?php



                                    ?>
                                    <?php
                                    for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                                        if ($paginate_count != 1) {
                                    ?>
                                            <button onclick="paginate_match(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                                        <?php
                                        } else {

                                        ?>
                                            <button onclick="paginate_match(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                                    <?php

                                        }
                                    }
                                    ?>


                                    <button onclick="paginate_match(2);" class="ms-1">&raquo;</button>


                                </div>



                            </div>
                        <?php
                        }

                        ?>





                    </div>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Match the brand and the model</h5>
                                <div class="row">
                                    <div class="col-12">


                                        <div class="row">

                                            <div class="col-6">

                                                <select class="form-select" id="brand_select">

                                                    <option value="">Select the brand</option>

                                                    <?php

                                                    $brand_result = connect::executer("SELECT * FROM `brand`;");


                                                    while ($brand_fetch = $brand_result->fetch_assoc()) {

                                                    ?>

                                                        <option value="<?php echo $brand_fetch["id"];   ?>"><?php echo $brand_fetch["name"];   ?></option>

                                                    <?php

                                                    }

                                                    ?>




                                                </select>

                                            </div>

                                            <div class="col-6">

                                                <select class="form-select" id="model_select">

                                                    <option value="">Select the model</option>


                                                    <?php

                                                    $model_result = connect::executer("SELECT * FROM `model`;");


                                                    while ($model_fetch = $model_result->fetch_assoc()) {

                                                    ?>

                                                        <option value="<?php echo $model_fetch["id"];   ?>"><?php echo $model_fetch["name"];   ?></option>

                                                    <?php

                                                    }

                                                    ?>




                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary mt-3" onclick="match_brand_model();">Match</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="col-12 border-1 border border-primary" />



                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="sweetalert.min.js"></script>
    </body>

    </html>





<?php

} else {


?>

    <script>
        window.location = "admin-signin.php";
    </script>


<?php


}

?>