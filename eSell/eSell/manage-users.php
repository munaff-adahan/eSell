<?php
session_start();

require "connection.php";



if (isset($_SESSION["admin"])) {


    $admin = $_SESSION["admin"];

?>


    <!DOCTYPE html>

    <html>

    <head>

        <title>eSell | Manage Users</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="1249991_network_online_shopify_shopping_ecommerce_icon.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body >

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-dark text-center ">
                    <label class="form-label fs-2 fw-bold text-success">Manage All Users</label>
                </div>

                <div class="col-12 bg-dark">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" id="search_txt_manage_user" placeholder="Search by user email"/>
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn btn-success" onclick="search_manage_user();">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="manage_users_search_box">

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-lg-1 col-2 bg-success text-white fw-bold p-2">
                            <span>#</span>
                        </div>
                        <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                            <span>Profile Image</span>
                        </div>
                        <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                            <span>Email</span>
                        </div>
                        <div class="col-lg-2 col-10  bg-light fw-bold p-2">
                            <span>Username</span>
                        </div>
                        <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                            <span>Mobile</span>
                        </div>
                        <div class="col-lg-3 bg-light fw-bold p-2 d-none d-lg-block">
                            <span>Registered Date</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2 mb-3" id="viewProduct"></div>

                <?php

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $prs = connect::executer("SELECT * FROM `user` ;");
                $d = $prs->num_rows;

                $row = $prs->fetch_assoc();

                $results_per_page = 20;

                $number_of_pages = ceil($d / $results_per_page);

                $page_first_result = ((int)$pageno - 1) * $results_per_page;

                $selectedrs = connect::executer("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

                $srn = $selectedrs->num_rows;

                $count_prduct = 0;


                while ($srow = $selectedrs->fetch_assoc()) {

                    $count_prduct = $count_prduct + 1;

                ?>

                    <div class="col-12 mt-2 mb-3" id="userView">

                        <div class="row">
                            <div class="col-lg-1 col-2 bg-success text-white fw-bold p-2">
                                <span><?php echo $count_prduct;  ?></span>
                            </div>
                            <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">

                                <span class="text-center" data-bs-toggle="modal" data-bs-target="#message_modal<?php echo $count_prduct;  ?>" data-bs-whatever="@getbootstrap">
                                    <?php

                                    $image_result = connect::executer("SELECT * FROM `profile_img` WHERE `user_email`='" . $srow["email"] . "';");


                                    if ($image_result->num_rows == 0) {




                                    ?>




                                        <img src="user_images/demoProfileImg.jpg" class="rounded-circle ms-4" width="120px" height="120px" />


                                    <?php
                                    } else {

                                    ?>

                                        <img src="<?php echo $image_result->fetch_assoc()["image_path"];   ?>" class="rounded-circle ms-4" width="120px" height="120px" />


                                    <?php



                                    }
                                    ?>



                                </span>
                            </div>
                            <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                                <span><?php echo $srow["email"];   ?></span>
                            </div>
                            <div class="col-lg-2 col-10  bg-light fw-bold p-2">
                                <span><?php echo $srow["fname"] . " " . $srow["lname"];   ?></span>
                            </div>
                            <div class="col-lg-2 bg-success text-white fw-bold p-2 d-none d-lg-block">
                                <span><?php echo $srow["mobile"];   ?></span>
                            </div>
                            <div class="col-lg-3 bg-light fw-bold p-2 d-none d-lg-block">
                                <span><?php echo $srow["register_date"];   ?></span>
                                <?php

                                if ($srow["status_id"] == 1) {

                                ?>
                                    <button class="btn btn-danger" onclick="status_change_user('<?php echo $srow['email'];  ?>',<?php echo $count_prduct;  ?>);" id="user_status_change<?php echo $count_prduct;  ?>">Block</button>

                                <?php
                                } else if ($srow["status_id"] == 2) {

                                ?>
                                    <button class="btn btn-success" onclick="status_change_user('<?php echo $srow['email'];  ?>',<?php echo $count_prduct;  ?>);" id="user_status_change<?php echo $count_prduct;  ?>">Unblock</button>

                                <?php
                                }
                                ?>
                            </div>
                        </div>



                        <div class="modal fade" id="message_modal<?php echo $count_prduct;  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Messages of <?php echo $srow["fname"] . " " . $srow["lname"];   ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 py-5 px-4">
                                            <div class="row rounded-lg overflow-hidden shadow">

                                                <!-- massage box -->
                                                <div class="col-7 px-0">
                                                    <div class="row px-4 py-5 chat-box bg-white" id="chatrow">
                                                        <!-- massage load venne methana -->

                                                        <?php
                                                        $senderrs = connect::executer("SELECT * FROM `chat` WHERE `from`='" . $srow['email'] . "' OR `to`='" . $srow['email'] . "'");
                                                        // $receverrs =  Database::search("SELECT * FROM `chat` WHERE `from`='".$recever."' OR `to`='".$recever."'");

                                                        $n = $senderrs->num_rows;

                                                        if ($n == 0) {
                                                        ?>

                                                            <!-- empty message -->
                                                            <div class="col-12 mb-3 text-center">
                                                                <div class="msgbodyimg"></div>
                                                                <p class="fs-4 mt-3 fw-bold text-black-50">No Messages To Show.</p>
                                                            </div>
                                                            <!-- empty message -->

                                                            <?php
                                                        } else {
                                                            for ($x = 0; $x < $n; $x++) {

                                                                $f = $senderrs->fetch_assoc();


                                                                if ($f["from"] == $srow['email']) {
                                                                    // echo "me : ";

                                                                    // echo "<br/>";
                                                            ?>
                                                                    <!-- Reciever Message-->
                                                                    <div class="col-5"></div>
                                                                    <div class="col-7 media ml-auto mb-3">
                                                                        <div class="media-body">
                                                                            <div class="bg-success rounded py-2 px-3 mb-2">
                                                                                <p class="text-small mb-0 text-white"><?php echo $f["content"]; ?></p>
                                                                            </div>
                                                                            <p class="small text-muted"><?php echo $f["date"]; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Reciever Message -->



                                                                <?php
                                                                } else {
                                                                    // echo "you :";
                                                                    // echo $f["content"];
                                                                ?>

                                                                    <!-- sender message -->
                                                                    <div class="col-7 media mb-3">

                                                                        <?php
                                                                        $img_result = connect::executer("SELECT * FROM `profile_img`  WHERE  `user_email`='" . $f["from"] . "';");



                                                                        if ($img_result->num_rows == 1) {
                                                                            $img_fetch = $img_result->fetch_assoc();

                                                                        ?>



                                                                            <img src="<?php echo $img_fetch["image_path"];  ?>" alt="user" width="50" class="rounded-circle">

                                                                        <?php
                                                                        } else {
                                                                        ?>


                                                                            <img src="user_images//demoProfileImg.jpg" alt="user" width="50" class="rounded-circle">
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <div class="media-body ml-3">
                                                                            <div class="bg-light rounded py-2 px-3 mb-2">
                                                                                <p class="text-small mb-0 text-muted"><?php echo $f["content"]; ?></p>
                                                                            </div>
                                                                            <p class="small text-muted"><?php echo $f["date"]; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-5"></div>
                                                                    <!-- sender message -->

                                                        <?php
                                                                }
                                                            }
                                                        }

                                                        ?>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>


                <?php
                }

                if ($number_of_pages > 1) {
                ?>

                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="text-center">
                                <div class="pagination">
                                    <a href="<?php

                                                if ($pageno <= 1) {
                                                    echo "#";
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                }

                                                ?>">&laquo;</a>

                                    <?php

                                    for ($page = 1; $page <= $number_of_pages; $page++) {
                                        if ($page == $pageno) {
                                    ?>
                                            <a class="ms-1 active" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                    <?php
                                        }
                                    }

                                    ?>

                                    <a href="<?php

                                                if ($pageno >= $number_of_pages) {
                                                    echo "#";
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                }


                                                ?>">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>









                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php

} else {


?>

    <script>
        window.location = "admin-signin.php";
    </script>

<?php




}


?>