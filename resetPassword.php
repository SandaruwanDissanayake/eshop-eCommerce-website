<?php



require "connection.php";

$email=$_POST["e"];
$np=$_POST["n"];
$rnp=$_POST["r"];
$vcode=$_POST["v"];

if(empty($email)){
    echo("Missing Email address");
}else if (empty($np)){
    echo("Please insert a New Password");
}else if(strlen($np)<5 || strlen($np)>20){
    echo("invalid your password");
}else if(empty($rnp)){
    echo("Please Re-type your New password");
}else if($np !=$rnp){
    echo("Password does not matched");
}else if (empty($vcode)){
    echo("pleace enter your verification code");
}else{
    $rs=Database::search("SELECT * FROM `user` WHERE `email`='".$email."'AND `verification_code`='".$vcode."'");
$n=$rs->num_rows;

if($n==1){
    Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email`='".$email."'");
    echo("success");
}else{
    echo("Invalid Email or Verification code");
}
}




?>