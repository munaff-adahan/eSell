<?php
require "connection.php";

$search_txt = $_POST["search_txt"];


$selectedrs = connect::executer("SELECT `product`.`id`,  `product`.`category_id`,  `product`.`model_has_brand_id`,  `product`.`title`,  `product`.`color_id`,  `product`.`price`,  `product`.`qty`,`product`.`description`, `product`.`condition_id`, `product`.`status_id` AS `product_status`,  `product`.`user_email`,  `product`.`datetime_added`,  `product`.`delivery_fee_colombo`,  `product`.`delivery_fee_other`,`product`.`status_delete`,`user`.`fname`,`user`.`lname` FROM `product` INNER JOIN `user` ON `product`.`user_email`=`user`.`email`  WHERE `product`.`title` LIKE '%" . addslashes($search_txt) . "%' AND `product`.`status_delete` IN (SELECT `id` FROM `status` WHERE `name`='Active') AND `product`.`approve_status`='1';");

$srn = $selectedrs->num_rows;

$count_prduct = 0;


if ($srn != 0) {


?>

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
<?php
} else {
?>
    <div class="alert alert-danger col-12 mt-3" role="alert">
        No results found!
    </div>


<?php




}

?>

<div class="col-12 mt-2 mb-3" id="viewProduct"></div>

<?php





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

                        $qty_status = $srow["qty"];

                        if ($srow["qty"] == 0) {

                            $qty_status = "No";
                        }

                        $item_items = "Items";

                        if ($srow["qty"] == 1) {

                            $item_items = "Item";
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


?>