<?php

session_start();

if (isset($_SESSION["user"])) {

    $customer = $_SESSION["user"]["email"];

    $email = $customer;

    if (isset($_GET["email"])) {

        $email = $_GET["email"];
    }


?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>eSell | Messages</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body onload="refresher('<?php echo $email; ?>');">
        <div class="container-fluid">
            <div class="row">
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

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 py-5 px-4">
                    <div class="row rounded-lg overflow-hidden shadow">
                        <div class="col-5 px-0">
                            <div class="bg-white">

                                <div class="bg-gray px-4 py-2 bg-light">
                                    <p class="h5 mb-0 py-1">Recent</p>
                                </div>

                                <div class="messages-box">
                                    <div class="list-group rounded-0" id="rcv">



                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- massage box -->
                        <div class="col-7 px-0">
                            <div class="row px-4 py-5 chat-box bg-white" id="chatrow">
                                <!-- massage load venne methana -->


                            </div>
                        </div>

                        <div class="offset-5 col-7">
                            <div class="row bg-white">

                                <!-- text -->

                                <?php

                                if ($customer != $email) {

                                ?>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="input-group">
                                                <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                                <div class="input-group-append">
                                                    <button id="button-addon2" class="btn btn-link fs-1" onclick="sendmessage('<?php echo $email; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                                <!-- text -->

                            </div>
                        </div>

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

}else{

?>

<script>window.location="home.php";</script>

<?php
}

?>