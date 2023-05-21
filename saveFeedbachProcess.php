<?php 

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    $mail = $_SESSION["u"]["email"];
    $type=$_POST["t"];
    $pid=$_POST["p"];
    $feed=$_POST["f"];

    $d= new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date=$d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback` (`type`,`feedback`,`date`,`user_email`,`product_id`) VALUES
    ('".$type."','".$feed."','".$date."','".$mail."','".$pid."')");

    echo ("1");
}


// echo("hello");
?>