<?php
session_start();


?>



<div class="offset-lg-1 col-12 col-lg-4 align-self-start">

<span class="text-start label1"><b>Welcome</b><?php

                                                if (isset($_SESSION["user"])) {

                                                    $user = $_SESSION["user"];

                                                ?>

    <?php


                                                    echo " " . $user["fname"];
                                                } else {

    ?>

        <a href="index.php">Register or Sign In</a>

    <?php








                                                }




    ?>







</span> |
<span class="text-start label2">Help and Contact</span> |
<?php
if (isset($_SESSION["user"])) {

?>

    <span class="text-start label2 sell" onclick="SignOut();">Sign Out</span>

<?php
}
?>


</div>