<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $mail = $_SESSION["user"]["email"];

    $chatrs = connect::executer("SELECT * FROM `chat` WHERE `from` NOT IN ('" . $mail . "')  AND `to`='".$mail."'  ORDER BY `date` DESC LIMIT 1");
    $n = $chatrs->num_rows;

    for ($x = 0; $x < $n; $x++) {

        $r = $chatrs->fetch_assoc();
        $u = array_unique($r);
        

?>

        <a class="list-group-item list-group-item-action active text-white rounded-0 bg-success" onclick="goToChat('<?php echo $u['from']; ?>');">
            <div class="media">
                
            <?php
                    $img_result = connect::executer("SELECT * FROM `profile_img`  WHERE  `user_email`='" . $r["from"] . "';");



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
                <div class="media-body ml-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <h6 class="mb-0"><?php echo $u["from"]; ?></h6><small class="small font-weight-bold"><?php echo $u["date"]; ?></small>
                    </div>
                    <p class="font-italic mb-0 text-small"><?php echo $u["content"]; ?></p>
                </div>
            </div>
        </a>

<?php

    }
}

?>