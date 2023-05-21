<?php

// echo("hello");

session_start();
require "connection.php";

if (isset($_SESSION["p"])) {
    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["desc"];

    // echo($title);
    // echo($qty);
    // echo($dwc);
    // echo($doc);
    // echo($description);

    Database::iud("UPDATE `product` SET `title`='" . $title . "', `qty`='" . $qty . "', `delivery_fee_colombo`='" . $dwc . "', 
    `delivery_fee_other`='" . $doc . "', `description`='" . $description . "' WHERE `id`='" . $pid . "' ");

    echo ("success");

    $length = sizeof($_FILES);
    $allowded_img_extention = array("image/jpeg", "image/jpeg", "image/png", "image/svg+xml");
    Database::iud("DELETE FROM `images` WHERE `product_id`='".$pid."' ");
    if ($length <= 3 && $length > 0) {

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["i" . $x])) {
                $img_file = $_FILES["i" . $x];
                $file_type = $img_file["type"];

                if (in_array($file_type, $allowded_img_extention)) {
                    $new_image_extention;

                    if ($file_type == "image/jpg") {
                        $new_image_extention = ".jpg";
                    } else if ($file_type == "image/jpeg") {
                        $new_image_extention = ".jpeg";
                    }else if ($file_type == "image/png") {
                        $new_image_extention = ".ppg";
                    }else if ($file_type == "image/svg+xml") {
                        $new_image_extention = ".svg";
                    }

                    $file_name="resource//mobile//".$title."_".$x."_".uniqid().$new_image_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                  

                    Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('".$file_name."','".$pid."')");

                    echo("success");
                } else {
                    echo ("File type not allowed!");
                }
            }
        }
    } else {
        echo ("Invalid image Count!");
    }
}
