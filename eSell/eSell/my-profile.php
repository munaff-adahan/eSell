<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

    $user = $_SESSION["user"];
?>



    <!DOCTYPE html>
    <html>

    <head>
        <title>eSell | My Profile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




    </head>


    <body class="bg-dark">

        <div class="container-fluid bg-dark round mt-5 mb-5">
            <div class="row">



                <div class="col-md-5 offset-lg-3 bg-white">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-content-center mb-3 text-center">
                            <h4 class="text-success offset-4">Profile Settings</h4>
                            <p class="text-danger text-center fw-bold" id="updateProfiletError"></p>
                            <p class="text-success text-center fw-bold" id="updateProfilesuccess"></p>
                        </div>
                        <div class=" ">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <?php
                                $img_result = connect::executer("SELECT * FROM `profile_img`  WHERE  `user_email`='" . $user["email"] . "';");



                                if ($img_result->num_rows == 1) {
                                    $img_fetch = $img_result->fetch_assoc();

                                ?>

                                    <img src="<?php echo $img_fetch["image_path"];  ?>" width="150px" class="rounded-circle" id="img_pro_prev" style="width: 120px;height: 120px;">

                                <?php
                                } else {
                                ?>
                                    <img src="user_images//demoProfileImg.jpg" width="150px" class="rounded-circle" id="img_pro_prev" style="width: 120px;height: 130px;" />
                                <?php
                                }
                                ?>
                                <span class="fw-bold"><?php echo $user["fname"] . " " . $user["lname"];  ?></span>
                                <span class="text-black-50"><?php echo $user["email"];  ?></span>
                                <input type="file" class="d-none" accept="img/*" id="profile_img_selector" />
                                <label for="profile_img_selector" class="btn btn-success mt-3" onclick="change_img_profile();">Update Profile Image</label>



                            </div>



                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="first name" value="<?php echo $user["fname"];  ?>" id="first_name_regis" />


                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Surname</label>
                                <input type="text" class="form-control" placeholder="last name" value="<?php echo $user["lname"];  ?>" id="last_name_regis" />


                            </div>

                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="enter phone number" value="<?php echo $user["mobile"];  ?>" id="mobile_regis" />


                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" placeholder="enter password" value="<?php echo $user["password"];  ?>" readonly />


                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" placeholder="enter email id" value="<?php echo $user["email"];  ?>" readonly />


                            </div>



                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registered Date</label>
                                <input type="email" class="form-control" placeholder="registered date" value="<?php echo $user["register_date"];  ?>" readonly />


                            </div>
                            <?php

                            $address_line1 = "";
                            $address_line2 = "";

                            $user_address_1 = connect::executer("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user["email"] . "';");

                            if ($user_address_1->num_rows == 1) {

                                $user_fetch_1 = $user_address_1->fetch_assoc();

                                $address_line1 = $user_fetch_1["line1"];
                                $address_line2 = $user_fetch_1["line2"];

                                $city_result = connect::executer("SELECT city.`id` AS `city_id` FROM `location` INNER JOIN city ON `location`.`city_id`=`city`.`id` WHERE `location`.`id`='" . $user_fetch_1["location_id"] . "';");

                                $city_fetch = $city_result->fetch_assoc();
                            }


                            ?>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address Line 01</label>
                                <input type="email" class="form-control" placeholder="enter address line 01" value="<?php echo $address_line1;  ?>" id="address_line_1" />


                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address Line 02</label>
                                <input type="email" class="form-control" placeholder="enter address line 02" value="<?php echo $address_line2; ?>" id="address_line2" />


                            </div>


                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <select class="form-select" id="city_pro">
                                    <option value="">City</option>
                                    <?php

                                    $city_value = "";

                                    if (isset($city_fetch["city_id"])) {
                                        $city_value = $city_fetch["city_id"];
                                    }

                                    $city_new_result = connect::executer("SELECT * FROM city;");

                                    for ($city_count = 0; $city_count < $city_new_result->num_rows; $city_count++) {
                                        $city_new_fetch = $city_new_result->fetch_assoc();


                                    ?>
                                        <option value="<?php echo $city_new_fetch["id"]; ?>" <?php
                                                                                                if ($city_value == $city_new_fetch["id"]) {
                                                                                                ?> selected <?php


                                                                                                        }

                                                                                                            ?>><?php echo $city_new_fetch["name"]; ?></option>
                                    <?php
                                    }
                                    ?>


                                </select>


                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <?php

                                $gender_result = connect::executer("SELECT * FROM gender;");



                                $gender_fetch = $gender_result->fetch_assoc();

                                ?>


                                <input type="text" class="form-control" readonly value="<?php echo $gender_fetch["name"]; ?>" />




                            </div>

                            <div class="mt-5 text-center">
                                <button class="btn btn-success" onclick="update_profile();">Update Profile</button>
                            </div>

                        </div>


                    </div>





                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">





                    </div>





                </div>














            </div>




        </div>





        </div>

        <?php

        require "footer.php";


        ?>






        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="sweetalert.min.js"></script>

    </body>









    </html>

<?php

} else {

?>
    <script src="script.js"></script>
    <script>
        window.location="home.php";
    </script>

<?php




}

?>