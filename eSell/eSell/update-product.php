<?php
session_start();
require "connection.php";


if (isset($_SESSION["user"])) {

?>


    <!DOCTYPE html>
    <html>

    <head>

        <title>eSell | Update Product</title>
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
                    <h3 class="h2 text-center text-success">Product Update</h3>
                    <p class="text-danger text-center fw-bold" id="productListError"></p>
                    <p class="text-success text-center fw-bold" id="productListsuccess"></p>
                    <div class="col-12 mb-2 mt-2">
                        <div class="row">
                            <div class="col-12 col-md-6  mt-1 mt-md-0">

                                <input type="text" class="form-control" placeholder="Search for a product with the product code..." id="product_update_name" />


                            </div>
                            <div class="col-12 col-md-6 mt-1 d-grid mt-3 mt-md-0">

                                <button class="btn btn-success" onclick="find_update_details();">Search</button>


                            </div>


                        </div>



                    </div>
                </div>


                <hr class="hrbreak1" />


                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">

                                    <label class="form-label lbl1">Product Category</label>

                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" readonly placeholder="category" id="update_category" />


                                </div>





                            </div>









                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">

                                    <label class="form-label lbl1">Product Brand</label>

                                </div>
                                <div class="col-12 mb-3">


                                    <input type="text" class="form-control" readonly placeholder="brand" id="update_brand" />




                                    </select>




                                </div>





                            </div>









                        </div>


                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">

                                    <label class="form-label lbl1">Product Model</label>

                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" readonly placeholder="model" id="update_model" />




                                </div>





                            </div>









                        </div>




                    </div>





                </div>















                <hr class="hrbreak1" />

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Update Product Title</label>
                        </div>
                        <div class="offset-lg-2 col-12 col-lg-8">

                            <input type="text" class="form-control" id="title_update" />



                        </div>


                    </div>
                </div>

                <hr class="hrbreak1" />

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Product Condition</label>
                                </div>
                                <div class="offset-lg-1 col-11 offset-1 col-lg-3 form-check">

                                    <input class="form-check-input" type="radio" value="" name="c" id="condition1_update" disabled />
                                    <label class="form-check-label" for="flexRadioDefault">
                                        Brandnew
                                    </label>



                                </div>
                                <div class="offset-lg-1 col-11 offset-1 col-lg-3 form-check">

                                    <input class="form-check-input" type="radio" value="" name="c" id="condition2_update" disabled />
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
                                        Product Color
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
                                                <input class="form-check-input" type="radio" id="color<?php echo $color_count; ?>_update" name="colour_update_produ" value="<?php echo  $color_fetch["id"]; ?>" disabled>
                                                <label class="form-check-label" for="color<?php echo $color_count; ?>_update">
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
                                    <label class="form-label lbl1">Update Product Quantity</label>
                                    <input type="number" class="form-control" value="0" min="0" id="qty_update" />


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

                                        <div class="input-group mb-3 ">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control " aria-label="Amount (to the nearest rupee)" id="cost_p_i_update">
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
                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="pwc_update">
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
                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="poc_update">
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

                            <textarea class="form-control" cols="100" rows="30" id="description_update"></textarea>


                        </div>




                    </div>





                </div>

                <hr class="hrbreak1" />


                <div class="col-12">
                    <div class="row">
                        <div class="col-12">

                            <label class="form-label lbl1">Add Product Image</label>

                        </div>

                        <img class="col-5 col-lg-2 ms-2 productimg img-thumbnail border-success" src="Custom-Icon-Design-Flatastic-4-Add-item.ico" id="img_preview_update" />

                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <input type="file" id="upload_image_update" accept="img/*" class="d-none" />
                                            <label for="upload_image_update" class="btn btn-success col-5 col-lg-8" onclick="change_img_update();">Upload</label>


                                        </div>





                                    </div>




                                </div>




                            </div>





                        </div>




                    </div>






                </div>


                <hr class="hrbreak1" />




                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid">

                    <button class="btn btn-success searchbtn" onclick="" id="update_btn_product">Update Product</button>

                </div>

                <?php

                require "footer.php";

                ?>



            </div>







        </div>



        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
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