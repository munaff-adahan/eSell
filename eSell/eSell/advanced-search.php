<?php
session_start();
require "connection.php";


?>

<head>

    <title>eSell | Advanced Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="pagination.css">


</head>

<body class="bg-success">


    <div class="container-fluid">
        <div class="row">





            <div class="col-12 bg-dark">

                <div class="row">


                    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2  mt-2">


                                <div class=" logo"></div>



                            </div>
                            <div class="col-10">



                                <label class="text text-success mt-4 fs-2 fw-bold ">Advanced Search</label>





                            </div>





                        </div>










                    </div>










                </div>








            </div>


            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">

                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                                <div class="row">


                                    <div class="col-12 col-lg-10 offset-0 mt-3 mb-2">
                                        <input type="text" class="form-control fw-bold" placeholder="Type a keyword to search..." id="advanced_txt" />
                                    </div>


                                    <div class="col-12 col-lg-2 offset-0 mt-3 mb-2 d-grid">
                                        <button class="btn btn-success" onclick="advanced_search(1);">Search</button>
                                    </div>


                                    <div class="col-12">
                                        <hr class="border border-success border-3" />
                                    </div>





                                </div>










                            </div>








                        </div>









                    </div>


                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">

                        <div class="row">

                            <div class="col-12">

                                <div class="row">


                                    <div class="col-lg-4 col-12 mb-3">

                                        <select class="form-select" id="category_ad" onchange="advanced_search(1);">

                                            <option value="">Select Category</option>



                                            <?php

                                            $category_result = connect::executer("SELECT * FROM `category`;");

                                            while ($category_fetch = $category_result->fetch_assoc()) {


                                            ?>
                                                <option value="<?php echo $category_fetch["id"]; ?>"><?php echo $category_fetch["name"]; ?></option>
                                            <?php
                                            }
                                            ?>



                                        </select>


                                    </div>

                                    <div class="col-lg-4 col-12 mb-3">

                                        <select class="form-select" id="brand_ad"  onchange="advanced_search(1);">

                                            <option value="">Select Brand</option>


                                            <?php

                                            $brand_result = connect::executer("SELECT * FROM `brand`;");

                                            while ($brand_fetch = $brand_result->fetch_assoc()) {


                                            ?>
                                                <option value="<?php echo $brand_fetch["id"]; ?>"><?php echo $brand_fetch["name"]; ?></option>
                                            <?php
                                            }
                                            ?>









                                        </select>


                                    </div>


                                    <div class="col-lg-4 col-12 mb-3">

                                        <select class="form-select" id="model_ad"  onchange="advanced_search(1);">

                                            <option value="">Select Select Model</option>




                                            <?php

                                            $model_result = connect::executer("SELECT * FROM `model`;");

                                            while ($model_fetch = $model_result->fetch_assoc()) {


                                            ?>
                                                <option value="<?php echo $model_fetch["id"]; ?>"><?php echo $model_fetch["name"]; ?></option>
                                            <?php
                                            }
                                            ?>








                                        </select>


                                    </div>




                                </div>




                            </div>


                            <div class="col-12">
                                <div class="row">

                                    <div class="col-lg-6 col-12 mb-3">

                                        <select class="form-select" id="condition_ad"  onchange="advanced_search(1);">

                                            <option value="">Select Condition</option>


                                            <?php

                                            $condition_result = connect::executer("SELECT * FROM `condition`;");

                                            while ($condition_fetch = $condition_result->fetch_assoc()) {


                                            ?>
                                                <option value="<?php echo $condition_fetch["id"]; ?>"><?php echo $condition_fetch["name"]; ?></option>
                                            <?php
                                            }
                                            ?>




                                        </select>





                                    </div>



                                    <div class="col-lg-6 col-12 mb-3">

                                        <select class="form-select" id="color_ad"  onchange="advanced_search(1);">

                                            <option value="">Select Color</option>


                                            <?php

                                            $color_result = connect::executer("SELECT * FROM `color`;");

                                            while ($color_fetch = $color_result->fetch_assoc()) {


                                            ?>
                                                <option value="<?php echo $color_fetch["id"]; ?>"><?php echo $color_fetch["name"]; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>





                                    </div>





                                </div>










                            </div>


                            <div class="col-12">
                                <div class="row">

                                    <div class="col-lg-6 col-12 mb-3">


                                        <input type="text" class="form-control" placeholder="Price Form" id="pri_fro" onkeyup="advanced_search(1);"/>


                                    </div>



                                    <div class="col-lg-6 col-12 mb-3">


                                        <input type="text" class="form-control" placeholder="Price To" id="pri_to" onkeyup="advanced_search(1);"/>


                                    </div>




                                </div>



                            </div>





                        </div>







                    </div>




                </div>













            </div>



            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded bg-white" id="advanced_search_box">

              




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