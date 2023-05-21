<?php

require "connection.php";

$fname=$_POST["f"];
$lname=$_POST["l"];
$email=$_POST["e"];
$password=$_POST["p"];
$mobile=$_POST["m"];
$gender=$_POST["g"];

if(empty($fname)){
    echo("please enter your Frist Name!!!");
}else if(strlen($fname)>50){
    echo ("Frist Name must have less than 50 characters");
}else if(empty($lname)){
    echo("please enter your Lrist Name!!!");
}else if(strlen($lname)>50){
    echo ("Lrist Name must have less than 50 characters");
}else if(empty($email)){
    echo("please enter your email!!!");
}else if(strlen($email)>=100){
    echo ("Lrist Name must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid email");
}else if(empty($password)){
    echo("please enter your password!!!");
}else if(strlen($password)<5 || strlen($password)>20){
    echo ("Password must be between 5-20 characters");
}else if(empty($mobile)){
    echo("Please enter your mobile number");
}else if(strlen($mobile)!=10){
    echo("Mobile must have 10 charactors");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo("invalid mobile");
}else{
   $rs=Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
   $n=$rs->num_rows;

   if($n>0){
    echo("User with the same email or mobile already exists.");
   }else{
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`mobile`,`password`,`gender_id`,`joined_date`,`status`)
    VALUES ('".$fname."','".$lname."','".$email."','".$mobile."','".$password."','".$gender."','".$date."','1')");

    echo("success");

   }
}



?>