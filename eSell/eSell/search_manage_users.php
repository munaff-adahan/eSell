<?php

require "connection.php";

$search_txt = $_POST["search_txt"];


$selectedrs = connect::executer("SELECT * FROM `user` WHERE `user`.`email` LIKE '%" . addslashes($search_txt) . "%';");

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
                                                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                                                <p class="text-small mb-0 text-white"><?php echo $f["content"]; ?></p>
                                                            </div>
                                                            <p class="small text-muted">12:00 PM | 2021-10-01</p>
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
                                                            <p class="small text-muted">12:00 PM | 2021-10-01</p>
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

?>