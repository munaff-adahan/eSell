<?php
session_start();
require "connection.php";

if(!isset($_SESSION["admin"])){

?>
<!DOCTYPE html>
<html>


<head>
    <title>eSell</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>


<body class="" >
    <div class="container-fluid  d-flex justify-content-center">
        <div class="row align-content-center ">

            <!-- header -->
            <div class="col-12 ">
                <div class="row">
                    <div class="col-12 logo mt-5"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to eSell Admins</p>
                    </div>
                </div>

            </div>
            <!-- header -->
            <!-- content -->
            <div class="col-12 pt-5">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background">




                    </div>


                    <div class="col-12 col-lg-6 " W>
                        <div class="row g-3">
                            <div class="col-12 fw-bold">

                                <p class="title2">Sign In to you account</p>
                                <p class="text-danger" id="signUpError"></p>
                            </div>
                            <div class="col-12">
                                <label class="form-label">  Email</label>

                                <input type="text" class="form-control" id="admin_email" />


                            </div>

                            
                           
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="admin_sign_in();">Send Verification Code</button>

                            </div>
                            <div class="col-12 col-lg-6 d-grid" >


                                <button class="btn btn-danger" onclick="goToIndex();">Back To User Login</button>


                            </div>

                        </div>

                    </div>

                   


                </div>





            </div>
            <!-- content -->

            <!-- footer -->
            <div class="col-12 d-none d-lg-block mt-3 text-center  mt-2">
                <p>&copy; eSell.lk All Rights Reserved</p>
            </div>
            <!-- footer -->

        </div>




    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="admin_signin_model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Admin Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                    


                        <div class="mb-3 col-12">
                            <label for="recipient-name" class="col-form-label">Verification Code</label>
                            <input type="text" class="form-control" id="verification_code_admin">
                        </div>





                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="verify_admin();">Verify Code</button>
                </div>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>




</html>

<?php

}else{

?>

<script>window.location="admin.php";</script>


<?php




}

?>