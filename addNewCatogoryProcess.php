<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";


use PHPMailer\PHPMailer\PHPMailer;

session_start();

if (isset($_POST["email"]) && isset($_POST["name"])) {
    if ($_SESSION["au"]["email"] == $_POST["email"]) {
        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%" . $cname . "%'");
        $category_num = $category_rs->num_rows;

        if ($category_num == 0) {

            $code = uniqid();
            Database::iud("UPDATE `admin` SET `validation_code`='" . $code . "' WHERE `email`='" . $umail . "'");
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
            $mail->addAddress($umail);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Verification Code add new category';
            $bodyContent = '<h1 style="color:green"> Your Verification code is ' . $code . '</h1>>';
            $mail->Body    = $bodyContent;
            if (!$mail->send()) {
                echo 'verification code sending failed';
            } else {


                echo 'success';
            }
        } else {
            echo ("This Category Alredy Exists");
        }
    } else {
        echo ("Invalid User");
    }
} else {
    echo ("Somthing Missing");
}
