<?php

// echo("hello");
session_start();
require "connection.php";

if(isset($_SESSION["u"])){
if(isset($_GET["id"])){

    $email = $_SESSION["u"]["email"];
    $pid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM  `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
    $cart_num = $cart_rs->num_rows;

    $product_rs=Database::search("SELECT *FROM `product` WHERE `id`='".$pid."'");
    $product_data=$product_rs->fetch_assoc();
    $product_qty=$product_data["qty"];

    if($cart_num==1){
        $car_data=$cart_rs->fetch_assoc();
        $current_qty=$cart_data["qty"];
        $new_qty=(int)$current_qty+1;
        if($product_qty >= $new_qty){

            Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `product_id`='".$pid."' AND `user_email`='".$email."' ");
            echo("Product update");

        }else{
            echo("Invalid quntity");
        }
    }else{
        Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES ('".$pid."','".$email."','1')");
        echo ("product added successfully");
    }

}else{
    echo("something went wrong");

}
}else{
    echo("pleace Sign In or Rejister.");
}
