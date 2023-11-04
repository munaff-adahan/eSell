<?php
session_start();
require "connection.php";

$user=$_SESSION["user"];


$pro_view_offset = 0;

$pro_view_page = 1;


if (isset($_GET["p"])) {


    $pro_view_page = $_GET["p"];


    $pro_view_offset = 6 * ($pro_view_page - 1);
}

?>


    <div class="row">

        <div class="col-10 offset-1 text-center">
            <div class="row justify-content-center" >

                <?php

                $search_result = connect::executer("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') LIMIT 6 OFFSET " . $pro_view_offset . ";"); //methana mage connection class eka poddak wenas
 



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

    $user_product_result = connect::executer("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "';");


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

