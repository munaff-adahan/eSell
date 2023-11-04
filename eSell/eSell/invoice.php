<?php
session_start();
require "connection.php";



if (isset($_GET["order_id"])) {

    $order_id = $_GET["order_id"];


    $invoice_result = connect::executer("SELECT * FROM `invoice` WHERE `order_id`='" . $order_id . "';");


    $invoice_fetch = $invoice_result->fetch_assoc();

    $user_result = connect::executer("SELECT * FROM `user` WHERE `email`='" . $invoice_fetch["user_email"] . "';");

    $user_fetch = $user_result->fetch_assoc();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>eSell | Invoice</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg" />
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">


    </head>

    <body class="mt-2">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12 bg-dark">
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
                <div class="col-12">

                    <hr />


                </div>

                <div class="col-12 btn-toolbar justify-content-end">


                    <button class="btn btn-danger me-2" onclick="print_invoice();">Print <i class="bi bi-printer-fill"></i></button>




                </div>

                <div class="col-12">

                    <hr />


                </div>


                <div class="col-12">
                    <div class="row">
                        <div class="col-6">

                            <div class="invoice_header_img"></div>


                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-end text-decoration-underline text-success">

                                    <h2>eSell</h2>

                                </div>

                                <div class="col-12 text-end fw-bold">
                                    <span>Maradana, Colombo 10, Sri Lanka</span><br />
                                    <span>+94112546978</span><br />
                                    <span>eshop@gmail.com</span>

                                </div>


                            </div>



                        </div>



                    </div>




                </div>

                <div class="col-12">

                    <hr class="border border-1 border-success" />


                </div>

                <div id="invoice_box">

                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-6">
                                <h5>INVOICE TO :</h5>
                                <h2><?php echo $user_fetch["fname"] . " " . $user_fetch["lname"];  ?></h2>
                                <?php
                                $address_line1 = "";
                                $address_line2 = "";

                                $user_address_1 = connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user_fetch["email"] . "';");

                                if ($user_address_1->num_rows == 1) {

                                    $user_fetch_1 = $user_address_1->fetch_assoc();

                                    $address_line1 = $user_fetch_1["line1"];
                                    $address_line2 = $user_fetch_1["line2"];

                                    $city_result = connect::executer("SELECT city.`id` AS `city_id` FROM `location` INNER JOIN city ON `location`.`city_id`=`city`.`id` WHERE `location`.`id`='" . $user_fetch_1["location_id"] . "';");

                                    $city_fetch = $city_result->fetch_assoc();
                                }


                                ?>
                                <span class="d-block"><?php echo $address_line1 . " " . $address_line2; ?></span>
                                <span class="fw-bold text-success text-decoration-underline mb-5"><?php echo $user_fetch["email"]; ?></span>




                            </div>

                            <div class="col-12 text-end mt-4">
                                <h1 class="text-success">INVOICE <?php echo $invoice_fetch["id"]; ?></h1>
                                <span class="fw-bold">Date and Time of Invoice</span>&nbsp;
                                <span class="fw-bold"><?php echo $invoice_fetch["date_time"]; ?></span>
                            </div>



                        </div>



                    </div>


                    <div class="col-12">
                        <table class="table">
                            <thead>

                                <tr class="border border-1 border-white">
                                    <th>#</th>
                                    <th>Order Id & Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>


                            </thead>
                            <?php

                            $total = 0;

                            $invoice_result2 = connect::executer("SELECT * FROM `invoice` WHERE `order_id`='" . $order_id . "';");

                            $delivery_fee = 0;


                            for ($invoice_count = 1; $invoice_count <= $invoice_result2->num_rows; $invoice_count++) {

                                $invoice_fetch2 = $invoice_result2->fetch_assoc();

                                $delivery_fee = $delivery_fee + $invoice_fetch2["delivery_fee"];

                                $product_result = connect::executer("SELECT * FROM `product` WHERE `id`='" . $invoice_fetch2["product_id"] . "';");

                                $product_fetch = $product_result->fetch_assoc();

                                $total = $total + $invoice_fetch2["unit_price"] * $invoice_fetch2["qty"];

                            ?>
                                <tbody>


                                    <tr style="height: 70px;">
                                        <td class="bg-success text-white fs-3"><?php echo $invoice_count;  ?></td>
                                        <td>
                                            <a href="#" class="fs-6 fw-bold p-2"><?php echo $invoice_fetch2["order_id"]; ?></a>
                                            <a href="#" class="fs-6 fw-bold p-2"><?php echo $product_fetch["title"];   ?></a>
                                        </td>
                                        <td class="fs-6 text-end pt-3" style="background-color: rgb(199,199,199);">Rs.<?php echo $invoice_fetch2["unit_price"]; ?></td>
                                        <td class="fs-6 text-end pt-3"><?php echo $invoice_fetch2["qty"]; ?></td>
                                        <td class="bg-success text-white fs-6 text-end pt-3">Rs.<?php echo $invoice_fetch2["unit_price"] * $invoice_fetch2["qty"]; ?></td>
                                    </tr>



                                </tbody>

                            <?php

                            }

                            ?>

                            <tfoot>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end">SUBTOTAL</td>
                                    <td colspan="2" class="fs-5 text-end">Rs.<?php echo $total;  ?></td>

                                </tr>


                                <?php

                                if ($delivery_fee != 0) {

                                ?>

                                    <tr>
                                        <td colspan="2" class="border-0"></td>
                                        <td colspan="2" class="fs-5 text-end text-secondary border-0">DELIVERY FEE</td>
                                        <td colspan="2" class="fs-5 text-end text-secondary border-0">Rs.<?php echo $delivery_fee;  ?></td>

                                    </tr>

                                <?php
                                }
                                ?>

                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end text-success border-0">GRAND TOTAL</td>
                                    <td colspan="2" class="fs-5 text-end text-success border-0">Rs.<?php echo $total + $delivery_fee;  ?></td>

                                </tr>






                            </tfoot>



                        </table>


                    </div>

                    <div class="col-4 text-center" style="margin-top: -100px;margin-bottom: 50px;">

                        <span class="fs-1">Thank You!</span>



                    </div>



                </div>

                <?php require "footer.php"; ?>


            </div>





        </div>


        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="sweetalert.min.js"></script>
        <script src="script.js"></script>
    </body>


    </html>


<?php

}

?>