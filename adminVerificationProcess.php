<?php

// echo "success";

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_POST["e"])) {
    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `validation_code`='" . $code . "' WHERE `email`='" . $email . "' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sandaruwandissanayake9@gmail.com';
        $mail->Password = 'vsdsbxtfntbksiva';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sandaruwandissanayake9@gmail.com', 'Reset Password');
        $mail->addReplyTo('sandaruwandissanayake9@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Forgot Password Verification Code';
        $bodyContent = '<h1 style="color:green"> Your Verification code is '.$code.'</h1>>';
        $mail->Body    = $bodyContent;
        if(!$mail->send()){
            echo'verification code sending failed';
        }else{
           
            
            echo'success';
        }
    } else {
        echo ("You are not a valid user");
    }
} else {
    echo ("Email field Should not be empty");
}
