<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {


    $user = $_SESSION["user"];

?>
    <!DOCTYPE html>

    <html>

    <head>

        <title>eSell | Transaction History</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="bg-dark">

        <div class="container-fluid">
            <div class="row">

                <!-- <?php require "header.php"; ?> -->

                <div class="col-12  text-center mb-3">
                    <span class="fs-1 fw-bold text-success">Transaction History</span>
                </div>

                <?php

                $history_result = connect::executer("SELECT `invoice`.`id` AS `invoice_id`,  `invoice`.`user_email`,  `invoice`.`product_id`,  `invoice`.`date_time`,  `invoice`.`qty`, `invoice`.`order_id`,  `invoice`.`unit_price`,`product`.`title`,`product`.`user_email` AS `seller_email`  FROM `invoice` INNER JOIN `product` ON `invoice`.`product_id`=`product`.`id`  WHERE `invoice`.`user_email`='" . $user["email"] . "' AND `invoice`.`status_id` IN (SELECT `status`.`id` FROM `status` WHERE `status`.`name`='Active');");


                if ($history_result->num_rows == 0) {





                ?>




                    <div class="col-12 text-center bg-light" style="height: 450px;">
                        <span class="fs-1 fw-bold text-black-50  d-block" style="margin-top: 200px;">You have no items in your Transaction History..........</span>
                    </div>
                <?php
                } else {

                ?>


                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-1 bg-light">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3 bg-light">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-light text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Purchase Date & Time</label>
                                    </div>
                                    <div class="col-3 bg-light"></div>
                                    <div class="col-12">
                                        <hr>
                                    </div>


                                </div>
                            </div>


                            <?php

                            $history_count = 0;

                            while ($history_fetch = $history_result->fetch_assoc()) {


                                $history_count = $history_count + 1;



                                $seller_res = connect::executer("SELECT * FROM `user` WHERE `email`='" . $history_fetch["seller_email"] . "';");


                                $seller_fetch = $seller_res->fetch_assoc();

                            ?>


                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-1 bg-danger text-center text-lg-start">
                                            <label class="form-label text-white fs-5  py-5"><?php echo $history_count;  ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3 ">
                                            <div class="row">
                                                <div class="card  mx-0 mx-lg-3 my-3" style="max-width: 540px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <img src="<?php echo connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $history_fetch["product_id"] . "';")->fetch_assoc()["code"]; ?>" class="img-fluid rounded-start">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $history_fetch["title"];  ?></h5>
                                                                <p class="card-text"><b>Seller : </b><?php echo $seller_fetch["fname"]; ?></p>
                                                                <p class="card-text"><b>price</b>: Rs.<?php echo $history_fetch["unit_price"];  ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-1 text-center text-lg-end">
                                            <label class="form-label  fs-4 pt-5"><?php echo $history_fetch["qty"];  ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center text-lg-end bg-info ">
                                            <label class="form-label fs-5 py-5 text-white">Rs.<?php echo $history_fetch["unit_price"] * $history_fetch["qty"];  ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center text-lg-end">
                                            <label class="form-label fs-5 px-3 py-5 text-white"><?php echo $history_fetch["date_time"];  ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5" onclick="open_feedback_model(<?php echo $history_count; ?>);"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                </div>
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-danger rounded  mt-5 fs-5" onclick="delete_from_history(<?php echo $history_fetch['invoice_id'];  ?>);"><i class="bi bi-trash-fill"></i> Delete</button>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="feedback_modal<?php echo $history_count; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Feedback for <?php echo $history_fetch["title"];  ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">



                                                    <div class="mb-3 col-12">
                                                        <textarea id="feedback_txt<?php echo $history_count; ?>" cols="100" rows="10" class="form-control"></textarea>
                                                    </div>





                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="send_feedback(<?php echo $history_fetch['product_id'];  ?>,<?php echo $history_count; ?>);">Send Feedback</button>
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
                        <hr>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-lg-10 d-none d-lg-block"></div>
                            <div class="col-12 col-lg-2 d-grid">
                                <button class="btn btn-danger rounded  fs-6" onclick="delete_all_history();"><i class="bi bi-trash-fill"></i> Clear All Records</button>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

                <?php require "footer.php";  ?>

            </div>
        </div>



        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
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