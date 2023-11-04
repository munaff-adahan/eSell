<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {



?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>eSell | Approve Products</title>

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
                    <label class="form-label fs-2 fw-bold text-success">Approve Products</label>
                </div>

                <div class="col-12">
                    <div class="row">
                        <?php

                        $watch_product_res = connect::executer("SELECT * FROM `product` WHERE `approve_status`='2';");

                        if ($watch_product_res->num_rows == 0) {
                        ?>

                            <div class="alert alert-danger col-12 mt-5" role="alert">
                                No unchecked products found!
                            </div>

                        <?php


                        }

                        for ($watch_product_count = 0; $watch_product_count < $watch_product_res->num_rows; $watch_product_count++) {





                            $watch_product_fetch = $watch_product_res->fetch_assoc();

                            $modal_brand_result = connect::executer("SELECT model.`name` AS `model_name`,brand.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN  `model`  ON  `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` WHERE `model_has_brand`.`id`='" . $watch_product_fetch["model_has_brand_id"] . "';");

                            $modal_brand_fetch = $modal_brand_result->fetch_assoc();





                        ?>


                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row g-2">
                                    <!-- card -->

                                    <div class="card mb-3 col-12">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="<?php echo connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $watch_product_fetch["id"] . "';")->fetch_assoc()["code"]; ?>" class="img-fluid rounded-start"  data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $watch_product_fetch["title"];  ?>" data-bs-content="<?php echo $watch_product_fetch["description"];  ?>">
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card-body">
                                                    <h3 class="card-title"><?php echo $watch_product_fetch["title"]; ?></h3>
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
                                                    <a href="#" class="btn btn-outline-success fw-bold mb-2" onclick="approve_product(<?php echo $watch_product_fetch['id']; ?>);">Approve</a>
                                                    <a href="#" class="btn btn-outline-danger fw-bold mb-2" onclick="unapprove_product(<?php echo $watch_product_fetch['id']; ?>);">Reject</a>
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



                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="sweetalert.min.js"></script>
        <div class="col-12 bg-white">
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript">
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {

                    return new bootstrap.Popover(popoverTriggerEl)

                })
            </script>
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