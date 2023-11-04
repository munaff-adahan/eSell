<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

?>


    <!DOCTYPE html>
    <html>

    <head>

        <title>eSell | Add Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    </head>

    <body>
        <div class="container-fluid">
            <div class="row gy-3">


                <div class="col-12 mb-2 bg-dark">



                    <div class=" logo"></div>




                    <h3 class="h2 text-center text-success">Product Listing</h3>
                    <p class="text-danger text-center fw-bold" id="productListError"></p>
                    <p class="text-success text-center fw-bold" id="productListsuccess"></p>
                </div>


                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">

                                    <label class="form-label lbl1">Select Product Category</label>

                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="category">
                                        <option value="">All Categories</option>

                                        <?php
                                        $category_result = connect::executer("SELECT * FROM category;");

                                        for ($category_count = 0; $category_count < $category_result->num_rows; $category_count++) {

                                            $category_fetch = $category_result->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $category_fetch["id"];  ?>"><?php echo $category_fetch["name"];  ?></option>

                                        <?php
                                        }
                                        ?>


                                    </select>




                                </div>





                            </div>









                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">

                                    <label class="form-label lbl1">Select Product Brand</label>

                                </div>
                                <div class="col-12 mb-3">



                                    <select class="form-select" id="brand">

                                        <option value="">All Brands</option>
                                        <?php
                                        $brand_result = connect::executer("SELECT * FROM brand;");

                                        for ($brand_count = 0; $brand_count < $brand_result->num_rows; $brand_count++) {

                                            $brand_fetch = $brand_result->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $brand_fetch["id"];  ?>"><?php echo $brand_fetch["name"];  ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>




                                </div>





                            </div>









                        </div>


                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">

                                    <label class="form-label lbl1">Select Product Model</label>

                                </div>
                                <div class="col-12 mb-3">
                                    <select class="form-select" id="model">

                                        <option value="">All Models</option>
                                        <?php
                                        $model_result = connect::executer("SELECT * FROM model;");

                                        for ($model_count = 0; $model_count < $model_result->num_rows; $model_count++) {

                                            $model_fetch = $model_result->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $model_fetch["id"];  ?>"><?php echo $model_fetch["name"];  ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>




                                </div>





                            </div>









                        </div>




                    </div>





                </div>















                <hr class="hrbreak1" />

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add a Title to Your Product</label>
                        </div>
                        <div class="offset-lg-2 col-12 col-lg-8">

                            <input type="text" class="form-control" id="product_title" />



                        </div>


                    </div>
                </div>

                <hr class="hrbreak1" />

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Condition</label>
                                </div>
                                <div class="offset-lg-1 col-11 offset-1 col-lg-3 form-check">

                                    <input class="form-check-input" type="radio" value="" name="c" id="condition1" />
                                    <label class="form-check-label" for="flexRadioDefault">
                                        Brandnew
                                    </label>



                                </div>
                                <div class="offset-lg-1 col-11 offset-1 col-lg-3 form-check">

                                    <input class="form-check-input" type="radio" value="" name="c" id="condition2" />
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Used
                                    </label>



                                </div>





                            </div>



                        </div>



                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-check-label lbl1">
                                        Select Product Color
                                    </label>

                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <?php

                                        $color_result = connect::executer("SELECT * FROM `color`;");


                                        $color_count = 0;


                                        while ($color_fetch = $color_result->fetch_assoc()) {

                                            $color_count += 1;

                                        ?>
                                            <div class="col-lg-4 form-check offset-1 offset-lg-0 col-5 ">
                                                <input class="form-check-input" type="radio" id="color<?php echo $color_count; ?>" name="colour_add_produ" value="<?php echo  $color_fetch["id"]; ?>">
                                                <label class="form-check-label" for="color<?php echo $color_count; ?>">
                                                    <?php echo  $color_fetch["name"]; ?>
                                                </label>
                                            </div>

                                        <?php
                                        }

                                        ?>





                                    </div>





                                </div>


                            </div>






                        </div>


                        <div class="col-12 col-lg-4 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Quantity</label>
                                    <input type="number" class="form-control" value="0" min="0" id="qty" />


                                </div>

                            </div>


                        </div>

                        <hr class="hrbreak1" />


                        <div class="col-12">
                            <div class="row">
                                <div class="offset-lg-2 col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12">

                                            <label class="form-label lbl1">Cost Per Item</label>

                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost_p_i">
                                            <span class="input-group-text">.00</span>
                                        </div>



                                    </div>



                                </div>


                            </div>




                        </div>


                    </div>






                </div>

                <hr class="hrbreak1" />

                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12">

                            <label class="form-label lbl1">Delivery Costs</label>

                        </div>

                        <div class="col-12">

                            <label class="form-label">Delivary Cost Within Colombo</label>

                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="pwc">
                            <span class="input-group-text">.00</span>
                        </div>









                    </div>



                </div>




                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12">

                            <label class="form-label lbl1">&nbsp;&nbsp;&nbsp;&nbsp;</label>

                        </div>


                        <div class="col-12">

                            <label class="form-label">Delivary Cost Out Of Colombo</label>

                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="poc">
                            <span class="input-group-text">.00</span>
                        </div>









                    </div>



                </div>


                <hr class="hrbreak1" />

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">

                            <label class="form-label lbl1">Product Description</label>


                        </div>
                        <div class="col-12">

                            <textarea class="form-control" cols="100" rows="30" id="description"></textarea>


                        </div>




                    </div>





                </div>

                <hr class="hrbreak1" />


                <div class="col-12">
                    <div class="row">
                        <div class="col-12">

                            <label class="form-label lbl1">Add Product Image</label>

                        </div>

                        <img class="col-5 col-lg-2 ms-2 productimg img-thumbnail border-success" src="Custom-Icon-Design-Flatastic-4-Add-item.ico" id= "img_preview" />

                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <input type="file" id="upload_image" accept="img/*" class="d-none" multiple="" />
                                            <label for="upload_image" class="btn btn-success col-5 col-lg-8" onclick="change_img();">Upload</label>


                                        </div>





                                    </div>




                                </div>




                            </div>





                        </div>




                    </div>






                </div>


                <hr class="hrbreak1" />



                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid">

                    <button class="btn btn-success searchbtn" onclick="add_product();">Add Product</button>

                </div>

                <?php

                require "footer.php";

                ?>



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