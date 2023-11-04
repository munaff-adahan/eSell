<?php

require "connection.php";
?>

<option value="">Select the model</option>


<?php

$model_result = connect::executer("SELECT * FROM `model`;");


while ($model_fetch = $model_result->fetch_assoc()) {

?>

    <option value="<?php echo $model_fetch["id"];   ?>"><?php echo $model_fetch["name"];   ?></option>

<?php

}

?>
