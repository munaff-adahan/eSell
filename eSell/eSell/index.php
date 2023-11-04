<?php

session_start();

require "connection.php";

if (!isset($_SESSION["user"])) {


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


    <body class="">
        <div class="container-fluid  d-flex justify-content-center">
            <div class="row align-content-center ">

                <!-- header -->
                <div class="col-12 ">
                    <div class="row">
                        <div class="col-12 logo mt-5"></div>
                        <div class="col-12">
                            <p class="text-center title1">Hi, Welcome to eSell</p>
                        </div>
                    </div>

                </div>
                <!-- header -->
                <!-- content -->
                <div class="col-12 pt-5">
                    <div class="row">
                        <div class="col-6 d-none d-lg-block background">




                        </div>


                        <div class="col-12 col-lg-6 " id="signUpBox">
                            <div class="row g-3">
                                <div class="col-12 fw-bold">

                                    <p class="title2">Create New Account</p>
                                    <p class="text-danger" id="signUpError"></p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">First Name</label>

                                    <input type="text" class="form-control" id="fname" />


                                </div>

                                <div class="col-6">
                                    <label class="form-label">Last Name</label>

                                    <input type="text" class="form-control" id="lname" />


                                </div>

                                <div class="col-12">
                                    <label class="form-label">Email</label>

                                    <input type="email" class="form-control" id="email" />


                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>

                                    <input type="password" class="form-control" id="password" />


                                </div>
                                <div class="col-6">
                                    <label class="form-label">Mobile</label>

                                    <input type="text" class="form-control" id="mobile" />


                                </div>
                                <div class="col-6">
                                    <label class="form-label">Gender</label>


                                    <select class="form-select" id="gender">
                                        <?php

                                        $genderResult = connect::executer("SELECT * FROM `gender`;");

                                        for ($genderCount = 0; $genderCount < $genderResult->num_rows; $genderCount++) {
                                            $genderFetch = $genderResult->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $genderFetch["id"]; ?>"><?php echo $genderFetch["name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>


                                </div>

                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary" onclick="signUp();">Sign Up</button>

                                </div>
                                <div class="col-12 col-lg-6 d-grid">


                                    <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In</button>


                                </div>

                            </div>

                        </div>

                        <div class="col-6 col-12 col-lg-6 d-none" id="signInBox">
                            <?php
                            $email = "";
                            $password = "";


                            if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {

                                $email = $_COOKIE["email"];
                                $password = $_COOKIE["password"];
                            }

                            ?>
                            <div class="row g-3">
                                <div class="col-12 fw-bold">

                                    <p class="title2">Sign In To Your Account</p>
                                    <p class="text-danger" id="signInError"></p>
                                </div>


                                <div class="col-12">
                                    <label class="form-label">Email</label>

                                    <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>" />


                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>

                                    <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>" />


                                </div>
                                <div class="col-6">
                                    <div class="form-check">


                                        <input class="form-check-input" type="checkbox" value="" id="remember" <?php
                                                                                                                if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {

                                                                                                                ?> checked <?php
                                                                                                                        }
                                                                                                                            ?>>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember me
                                        </label>
                                    </div>

                                </div>
                                <div class="col-6">

                                    <a href="#" class="link-primary" onclick="forgot_password();">Forgot Password?</a>


                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary" onclick="SignIn();">Sign In</button>

                                </div>


                                <div class="col-12 col-lg-6 d-grid">


                                    <button class="btn btn-danger" onclick="changeView();">New to eSell? Sign Up</button>


                                </div>

                            </div>

                        </div>


                    </div>





                </div>
                <!-- content -->

                <!-- footer -->
                <div class="col-12  mt-lg-3 text-center">
                    <p>&copy; eSell.lk All Rights Reserved</p>
                </div>
                <!-- footer -->

            </div>




        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="resetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Password Reset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="mb-3 col-6">
                                <label for="recipient-name" class="col-form-label">New Password</label>
                                <input type="password" class="form-control" id="new-password">
                            </div>

                            <div class="mb-3 col-6">
                                <label for="recipient-name" class="col-form-label">Re-type New Password</label>
                                <input type="password" class="form-control" id="confirm-password">
                            </div>


                            <div class="mb-3 col-12">
                                <label for="recipient-name" class="col-form-label">Verification Code</label>
                                <input type="text" class="form-control" id="verification_code">
                            </div>





                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="ResetPassword();">Reset</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="script.js"></script>
        <!-- <script src="bootstrap.js"></script> -->


        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>




    </html>


<?php

} else {

?>

    <script>
        window.location = "home.php";
    </script>


<?php



}

?>