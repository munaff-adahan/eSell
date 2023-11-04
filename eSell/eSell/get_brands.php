<?php

require "connection.php";
?>

<option value="">Select the brand</option>

<?php

$brand_result = connect::executer("SELECT * FROM `brand`;");


while ($brand_fetch = $brand_result->fetch_assoc()) {

?>

    <option value="<?php echo $brand_fetch["id"];   ?>"><?php echo $brand_fetch["name"];   ?></option>

<?php

}

?>



