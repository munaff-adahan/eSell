<?php
session_start();
require "connection.php";

$pro_view_offset = 0;

$pro_view_page = 1;


if (isset($_POST["page"])) {


    $pro_view_page = $_POST["page"];




    $pro_view_offset = 3 * ($pro_view_page - 1);
}

?>

<table class="table table-striped table-hover">
    <tr>

        <th>#</th>
        <th>Brand Name</th>
        <th>Model Name</th>


    </tr>
    <?php

    $category_count = $pro_view_offset;

    $category_result = connect::executer("SELECT `model`.`name` AS `model_name`,`brand`.`name` AS `brand_name` FROM `model_has_brand` INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`id` INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`id` LIMIT 3 OFFSET " . $pro_view_offset . ";");

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

if ($product_full_amount != 1 && $category_result->num_rows != 0) {

?>


    <div class="col-12 mb-3 d-flex justify-content-center">

        <div class="pagination  mt-2">
            <?php
            if ($pro_view_page != 1) {
            ?>
                <button onclick="paginate_match(<?php echo  $pro_view_page - 1; ?>);" class="ms-1">&laquo;</button>

            <?php

            } else {

            ?>

                <button class="frontlink ms-1">&laquo;</button>
            <?php


            }
            ?>
            <?php
            for ($paginate_count = 1; $paginate_count <= $product_full_amount; $paginate_count++) {

                if ($paginate_count != $pro_view_page) {
            ?>
                    <button onclick="paginate_match(<?php echo  $paginate_count; ?>);" class="ms-1"><?php echo $paginate_count  ?></button>




                <?php
                } else {

                ?>
                    <button onclick="paginate_match(<?php echo  (int)$paginate_count; ?>);" class="active" class="ms-1"><?php echo $paginate_count  ?></button>

                <?php

                }
            }

            if ($pro_view_page != $product_full_amount) {
                ?>


                <button onclick="paginate_match(<?php echo  (int)$pro_view_page + 1; ?>);" class="ms-1">&raquo;</button>

            <?php
            } else {

            ?>
                <button class="frontlink ms-1">&raquo;</button>
            <?php


            }
            ?>
        </div>



    </div>
<?php
}

?>