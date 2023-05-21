<?php
// $h=$_POST["t"];
// echo($h);
// echo("hello");


session_start();
require "connection.php";

$msg_txt = $_POST["t"];
$sender = $_POST["e"];
$resrever = $_SESSION["au"]["email"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");





Database::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES
    ('" . $msg_txt . "','" . $date . "','0','" . $sender . "','" . $resrever . "')");

echo ("sucsess1");
?>