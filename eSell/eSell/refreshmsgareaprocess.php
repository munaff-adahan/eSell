<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $recever = $_POST["e"];
    $sender = $_SESSION["user"]["email"];

    $senderrs = connect::executer("SELECT * FROM `chat` WHERE `from`='" . $sender . "' AND `to`='" . $recever . "' OR `from`='" . $recever . "' AND `to`='" . $sender . "';");

    
    if($recever==$sender){


        $senderrs = connect::executer("SELECT * FROM `chat` WHERE `from`='" . $sender . "' OR `to`='" . $sender . "';");
    


    }
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


            if ($f["from"] == $sender) {
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
}

?>