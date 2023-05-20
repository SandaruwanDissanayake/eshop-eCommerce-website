<?php

// echo("hello1");
require "connection.php";

if (isset($_GET["b"])) {
    $brand_id = $_GET["b"];

    echo($brand_id);

    $model_rs = Database::search("SELECT * FROM `model` WHERE `brand_id`='" . $brand_id . "'");
    $model_num = $model_rs->num_rows;
    ?>
    <option value="0">--Select Model--</option>
<?php

    if ($model_num > 0) {
        for ($y = 0; $y < $model_rs; $y++) {
            $model_data = $model_rs->fetch_assoc();
            echo("hello");
?>
            <option value="<?php echo $model_data["id"]; ?>"><?php echo ($model_data["name"]); ?></option>


        <?php
        }
    } else {
//         $all_model = Database::search("SELECT * FROM `model`");
//         $all_num = $all_model->num_rows;
//         for ($z = 0; $z < $all_num; $z++) {
//             $all_data = $all_model->fetch_assoc();
//       
//         }
echo("There are noo models related to the brand");
    }
}

?>