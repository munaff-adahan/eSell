<?php
session_start();

require "connection.php";



if (isset($_SESSION["admin"])) {


    $admin = $_SESSION["admin"];

?>



    <!DOCTYPE html>
    <html>

    <head>
        <title>eSell | Admin</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="font&hr.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>

    <body class="bg-dark">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="align-items-start bg-secondary col-12 text-center">
                            <div class="row g-1">
                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo   $admin["fname"] . " " . $admin["lname"];   ?></h4>
                                    <hr class="hrbreak1" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                        <a class="nav-link bg-success text-white fs-5" aria-current="page" href="#">Dashboard</a>
                                        <a class="nav-link fs-5 text-success" href="manage-users.php">Manage Users</a>
                                        <a class="nav-link fs-5 text-success" href="manage-products.php">Manage Products</a>
                                        <a class="nav-link fs-5 text-success" href="manage-product-details.php">Add Product Related Details</a>
                                         <a class="nav-link fs-5 text-success" href="approve-products.php">Approve Products</a>
                                    </nav>
                                </div>
                                <div class="col-12 mt-2">
                                    <hr class="hrbreak1" />
                                    <h4 class="text-white">Selling History</h4>
                                    <hr class="hrbreak1" />
                                </div>
                                <div class="col-12 mt-2 d-grid">
                                    <label class="form-label text-white fw-bold">From Date</label>
                                    <input type="date" class="form-control" id="fil_f_date" />
                                    <label class="form-label text-white fs-6 mt-2">To Date</label>
                                    <input type="date" class="form-control" id="fil_t_date" />
                                    <button class="btn btn-primary d-grid mt-2" onclick="fil_date_sell();">Search</button>

                                    &nbsp;
                                    <br />
                                    <button class="btn btn-danger" onclick="sign_out_admin();">Sign Out</button>
                                    &nbsp;

                                    <br />
                                    &nbsp;

                                    <br />

                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10 ">
                    <div class="row">

                        <div class="col-12 mt-3 mb-3 text-success">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>


                        <?php


                        $date = new DateTime();
                        $timeZone = new DateTimeZone("Asia/Colombo");
                        $date->setTimezone($timeZone);
                        $invoi_date_date = $date->format("Y-m-d");


                        $invoi_date_final = explode(" ", $invoi_date_date);



                        $invoice_result_new = connect::executer("SELECT * FROM `invoice` WHERE `date_time` LIKE '%" . $invoi_date_date . "%';");


                        $daily_earnings = 0;


                        for ($invoice_count = 0; $invoice_count < $invoice_result_new->num_rows; $invoice_count++) {


                            $invoice_fetch_date = $invoice_result_new->fetch_assoc();





                            $daily_earnings = $daily_earnings + $invoice_fetch_date["unit_price"] * $invoice_fetch_date["qty"];
                        }






                        $invoi_date_date_monthly = $date->format("Y-m");


                        // $invoi_date_final=explode(" ",$invoi_date_date);



                        $invoice_result_new_monthly = connect::executer("SELECT * FROM `invoice` WHERE `date_time` LIKE '%" . $invoi_date_date_monthly . "%';");


                        $monthly_earnings = 0;


                        for ($invoice_count_monthly = 0; $invoice_count_monthly < $invoice_result_new_monthly->num_rows; $invoice_count_monthly++) {


                            $invoice_fetch_date_monthly = $invoice_result_new_monthly->fetch_assoc();





                            $monthly_earnings = $monthly_earnings + $invoice_fetch_date_monthly["unit_price"] * $invoice_fetch_date_monthly["qty"];
                        }






                        ?>

                        <div class="col-12 col-lg-6">
                            <div class="row g-1">

                                <div class="col-6 col-lg-12 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $daily_earnings;  ?></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-12 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $monthly_earnings;  ?></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-12 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-info text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $invoice_result_new->num_rows;  ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-12 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $invoice_result_new_monthly->num_rows;  ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-12 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo connect::executer("SELECT * FROM `invoice`;")->num_rows;  ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-12 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />

                                            <?php

                                            $user_new_result = connect::executer("SELECT * FROM `user`;");

                                            $user_name = "Users";

                                            if ($user_new_result->num_rows == 1) {

                                                $user_name = "User";
                                            }


                                            ?>
                                            <span class="fs-5"><?php echo $user_new_result->num_rows . " " . $user_name; ?></span>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>




                        <?php

                        $invoice_result = connect::executer("SELECT `product_id`, COUNT(`product_id`) AS `value_occurence` FROM `invoice` GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1;");


                        $invoice_fetch = $invoice_result->fetch_assoc();



                        $product_result = connect::executer("SELECT * FROM `product` WHERE `id`='" . $invoice_fetch["product_id"] . ";'");


                        $product_fetch = $product_result->fetch_assoc();


                        $product_img_result = connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $invoice_fetch["product_id"] . "';");


                        $product_img_fetch = $product_img_result->fetch_assoc();



                        $user_result = connect::executer("SELECT * FROM `user` WHERE `email`='" . $product_fetch["user_email"] . "';");

                        $user_fetch = $user_result->fetch_assoc();


                        $image_result = connect::executer("SELECT * FROM `profile_img` WHERE `user_email`='" . $product_fetch["user_email"] . "';");

                        $image_fetch = $image_result->fetch_assoc();


                        $qty_status = $product_fetch["qty"];


                        if ($product_fetch["qty"] == 0) {


                            $qty_status = "No";
                        }

                        $qty_status_item="items";


                        if ($product_fetch["qty"] == 1) {


                            $qty_status_item = "item";
                        }




                        ?>

                        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                            <div class="row">


                                <div class="col-6 ">

                                    <div class="row">

                                        <div class="card text-center" style="width: 18rem; height: 700px;">
                                            <h1>Most Sold Item</h1>
                                            <img src="<?php echo  $product_img_fetch["code"];  ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold"><?php echo  $product_fetch["title"];  ?></h5>
                                                <p class="card-text"><?php echo  $qty_status." ".$qty_status_item;  ?> left</p>

                                                <p class="card-text">Rs. <?php echo  $product_fetch["price"];  ?></p>

                                                <img src="2530838_award_champion_general_office_prize_icon.png" height="50px">
                                            </div>
                                        </div>





                                    </div>





                                </div>




                                <div class="col-6 ">

                                    <div class="row">

                                        <div class="card text-center" style="width: 18rem; height: 700px;">
                                            <h1>Most Popular Seller</h1>
                                            <img src="<?php echo $image_fetch["image_path"];  ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold"><?php echo $user_fetch["fname"] . " " . $user_fetch["lname"];  ?></h5>
                                                <p class="card-text"><?php echo $user_fetch["email"];  ?></p>

                                                <p class="card-text"><?php echo $user_fetch["mobile"];  ?></p>

                                                <img src="2530838_award_champion_general_office_prize_icon.png" height="50px">
                                            </div>
                                        </div>





                                    </div>





                                </div>











                            </div>



                        </div>




                    </div>
                </div>

                <div>





                </div>
                <?php
                require "footer.php";
                ?>
            </div>
        </div>


        <script src="script.js"></script>

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