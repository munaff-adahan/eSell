<?php
session_start();

require "connection.php";



if (isset($_SESSION["admin"])) {


    $admin = $_SESSION["admin"];

?>


    <!DOCTYPE html>

    <html>

    <head>

        <title>eSell | Manage Products</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-dark text-center ">
                    <label class="form-label fs-2 fw-bold text-success">Manage All Products</label>
                </div>

                <div class="col-12 bg-dark ">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" id="searchtxt_manage_product" placeholder="Search by product title" />
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn btn-success" onclick="search_manage_product();">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="m_p_box">

                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-lg-1 col-2 bg-success text-white fw-bold p-2">
                                <span>#</span>
                            </div>
                            <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                <span>Products Image</span>
                            </div>
                            <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                                <span>Title</span>
                            </div>
                            <div class="col-lg-2 col-10  bg-light fw-bold p-2">
                                <span>Price</span>
                            </div>
                            <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                                <span>Qunatity</span>
                            </div>
                            <div class="col-lg-3 bg-light fw-bold p-2 d-none d-lg-block">
                                <span>Registered Date</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2 mb-3" id="viewProduct"></div>

                    <?php

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $prs = connect::executer("SELECT * FROM `product` WHERE `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';");
                    $d = $prs->num_rows;

                    $row = $prs->fetch_assoc();

                    $results_per_page = 20;

                    $number_of_pages = ceil($d / $results_per_page);

                    $page_first_result = ((int)$pageno - 1) * $results_per_page;

                    $selectedrs = connect::executer("SELECT `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`, `product`.`condition_id`, `product`.`status_id` AS `product_status`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`product`.`status_delete`,`user`.`fname`,`user`.`lname` FROM `product` INNER JOIN `user` ON `product`.`user_email`=`user`.`email` WHERE  `product`.`status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ;");

                    $srn = $selectedrs->num_rows;

                    $count_prduct = 0;


                    while ($srow = $selectedrs->fetch_assoc()) {

                        $count_prduct = $count_prduct + 1;

                    ?>

                        <div class="col-12 mt-2 mb-3" id="userView">

                            <div class="row">
                                <div class="col-lg-1 col-2 bg-success text-white fw-bold p-2">
                                    <span><?php echo $count_prduct;  ?></span>
                                </div>
                                <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span data-bs-toggle="modal" data-bs-target="#single_product_model<?php echo $count_prduct;  ?>" data-bs-whatever="@getbootstrap"><img src="<?php echo connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $srow["id"] . "';")->fetch_assoc()["code"]; ?>" /></span>
                                </div>
                                <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                                    <span><?php echo $srow["title"];   ?></span>
                                </div>
                                <div class="col-lg-2 col-10  bg-light fw-bold p-2">
                                    <span><?php echo $srow["price"];   ?></span>
                                </div>
                                <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                                    <span><?php echo $srow["qty"];   ?></span>
                                </div>
                                <div class="col-lg-3 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span><?php echo $srow["datetime_added"];   ?></span>
                                    <?php

                                      

                                    if ($srow["product_status"] == 1) {


                                    ?>
                                        <button class="btn btn-danger" onclick="status_change_product(<?php echo $srow['id'];  ?>,<?php echo $count_prduct;  ?>);" id="product_status_change<?php echo $count_prduct;  ?>">Block</button>

                                    <?php
                                    } else if ($srow["product_status"] == 2) {

                                     

                                    ?>
                                        <button class="btn btn-success" onclick="status_change_product(<?php echo $srow['id'];  ?>,<?php echo $count_prduct;  ?>);" id="product_status_change<?php echo $count_prduct;  ?>">Unblock</button>

                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>



                        </div>


                        <div class="modal fade" id="single_product_model<?php echo $count_prduct;  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $srow["title"];   ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="mb-3 text-center">
                                                <span><img src="<?php echo connect::executer("SELECT * FROM `image` WHERE `product_id`='" . $srow["id"] . "';")->fetch_assoc()["code"]; ?>" /></span>
                                            </div>

                                            <?php

                                              $qty_status=$srow["qty"];

                                              if($srow["qty"]==0){

                                                $qty_status="No";


                                              }

                                              $item_items="Items";

                                              if($srow["qty"]==1){

                                                $item_items="Item";


                                              }



                                            ?>


                                            <div class="mb-3">
                                                <span class="fw-bold">Price :</span>&nbsp;<span>Rs.<?php echo $srow["price"];   ?></span>
                                                <br />
                                                <span class="fw-bold">Quantity :</span>&nbsp;<span><?php echo $qty_status;   ?> <?php echo $item_items;   ?> Left</span>
                                                <br />
                                                <span class="fw-bold">Seller :</span>&nbsp;<span><?php echo $srow["fname"] . " " . $srow["lname"];   ?> </span>
                                                <br />
                                                <span class="fw-bold">Description :</span>&nbsp;<span><?php echo $srow["description"];   ?> </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }

                    if ($number_of_pages > 1) {
                    ?>

                        <div class="col-12 mt-3 mb-3">
                            <div class="row">
                                <div class="text-center">
                                    <div class="pagination">
                                        <a href="<?php

                                                    if ($pageno <= 1) {
                                                        echo "#";
                                                    } else {
                                                        echo "?page=" . ($pageno - 1);
                                                    }

                                                    ?>">&laquo;</a>

                                        <?php

                                        for ($page = 1; $page <= $number_of_pages; $page++) {
                                            if ($page == $pageno) {
                                        ?>
                                                <a class="ms-1 active" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                            <?php
                                            } else {
                                            ?>
                                                <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                        <?php
                                            }
                                        }

                                        ?>

                                        <a href="<?php

                                                    if ($pageno >= $number_of_pages) {
                                                        echo "#";
                                                    } else {
                                                        echo "?page=" . ($pageno + 1);
                                                    }


                                                    ?>">&raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>

                <hr />



                <!-- <div class="col-12">
                    <h3 class="text-primary">Manage Categories</h3>
                </div>



                <hr>

                <div class="col-12 mb-3">
                    <div class="row g-1">

                        <?php

                        $categoryrs = connect::executer("SELECT * FROM `category`");
                        $num = $categoryrs->num_rows;

                        for ($i = 0; $i < $num; $i++) {

                            $row = $categoryrs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3">
                                <div class="row g-1 px-1">
                                    <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                        <label class="form-label fs-4 fw-bold py-3"><?php echo $row["name"]; ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }


                        ?>



                        <div class="col-12 col-lg-3" onclick="add_category_model();">
                            <div class="row g-1 px-1">
                                <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                    <div class="row">
                                        <div class="col-3 mt-3 ms-1 text-center ms-5 addnewimg"></div>
                                        <div class="col-9">
                                            <label class="form-label fs-4 fw-bold py-3 text-black-50">Add New Category</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="category_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add new category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">



                                            <div class="mb-3 col-12">
                                                <input type="text" class="form-control" id="category_txt" />
                                            </div>





                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="add_category();">Save Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div> -->


                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
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