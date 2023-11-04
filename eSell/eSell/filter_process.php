<?php
session_start();
require "connection.php";

$user = $_SESSION["user"]; 

$search =  addslashes($_POST["search"]);
$age = $_POST["age"];
$qty = $_POST["qty"];
$condition = $_POST["condition"]; 

if (empty($search)) {


    echo "Please type the keyword.";
} else {



    if (!empty($search) && $age == 1) { 

        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' ORDER BY `datetime_added` ASC;"); 

        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }
?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php

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
    } else if (!empty($search) && $age == 2) {


        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1'  ORDER BY `datetime_added` DESC;"); 

        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }

    ?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php


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
    } else if (!empty($search) && $qty == 1) {


        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' ORDER BY `qty` ASC;"); 



        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }

    ?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php




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
    } else if (!empty($search) && $qty == 1) {


        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' ORDER BY `qty` ASC;"); 
        
        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }


    ?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php



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
    } else if (!empty($search) && $qty == 2) {


        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1' ORDER BY `qty` DESC;"); 


        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }

    ?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php


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
    } else if (!empty($search) && $condition == 1) {


        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `condition_id`='1'  AND `user_email`='" . $user["email"] . "'  AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';"); 

        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }
    ?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php




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
    } else if (!empty($search) && $condition == 2) {


        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `condition_id`='2'  AND `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';"); 


        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }

    ?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php




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
    } else if (!empty($search)) {


        $search_result = connect::executer("SELECT * FROM  `product` WHERE `title` LIKE '%" . $search . "%' AND `user_email`='" . $user["email"] . "' AND `status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';"); 


        if($search_result->num_rows==0){

             
            echo "<b class='text-danger'>No results found!</b>";


        }
    ?>
        <div class="row">

            <div class="col-10 offset-1 text-center">
                <div class="row justify-content-center">
                    <?php


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
    }
}

?>