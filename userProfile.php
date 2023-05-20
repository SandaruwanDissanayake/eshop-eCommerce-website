<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | eShop</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="resource/logo.svg">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>

            <?php 
            // require "connection.php"; 




            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                // $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_image` 
                // ON user.email=profile_image.user_email1 
                // INNER JOIN `user_has_address` 
                // ON user.email=user_has_address.user_email INNER JOIN `city` 
                // ON user_has_address.city_id=city.id INNER JOIN `distric` 
                // ON city.distric_id=distric.id INNER JOIN `province` 
                // ON distric.province_id=province.id INNER JOIN `gender` 
                // ON gender.id=user.gender_id 
                // WHERE `email`='" . $email . "'");

                $details_rs=Database::search("SELECT * FROM `user` INNER JOIN `gender` 
                ON gender.id=user.gender_id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email1`='".$email."'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_id=city.id INNER JOIN `distric` 
                ON city.distric_id=distric.id INNER JOIN `province` 
                ON distric.province_id=province.id WHERE `user_email`='".$email."'");

                $details_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();




            ?>

                <div class="col-12 bg-primary">
                    <div class="row">
                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div class="row g-2">
                                <div class="col-md-3 border-end border-start">
                                    <div class="d-flex flex-column align-items-center p-3 py-5">

                                        <?php

                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resource/profile-user.png" class="rounded mt-5" id="viweImage" style="width: 150px;" alt="">
                                            <br>
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo ($image_data["path"]); ?>" class="rounded mt-5" id="viweImage" style="width: 150px;" alt="">
                                            <br>
                                        <?php


                                        }

                                        ?>


                                        <div>
                                            <span class="fw-bold"><?php echo ($details_data ["fname"]); ?></span>
                                            <span class="fw-bold"><?php echo ($details_data ["lname"]); ?></span>
                                        </div>
                                        <span class="fw-bold text-black-50"><?php echo ($details_data ["email"]); ?></span>

                                        <input type="file" class="d-none" id="profileimg" iaccept="image/*">
                                        <label for="profileimg" class="btn btn-primary mt-5" onclick="changeImage();">Update Profile Image</label>

                                    </div>
                                </div>
                                <div class="col-md-5 border-end border-lg-start-d-none border-start">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Setting</h4>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6 ">
                                                <label class="form-label">Frist name</label>
                                                <input class="form-control" value="<?php echo ($details_data ["fname"]); ?>" id="fname" type="text">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Last name</label>
                                                <input class="form-control" value="<?php echo ($details_data ["lname"]); ?>" id="lname" type="text">
                                            </div>

                                            <div class="col-12 mt-2">
                                                <label class="form-label">Mobile</label>
                                                <input class="form-control" value="<?php echo ($details_data ["mobile"]); ?>" id="mobile" type="text">
                                            </div>

                                            <div class="col-12 mt-2">
                                                <label class="form-label">Email</label>
                                                <input class="form-control" value="<?php echo ($details_data ["email"]); ?>" type="email" readonly>
                                            </div>
                                            <br>
                                            <div class="col-12 mt-2">
                                                <label class="form-label">Password</label>

                                                <div class="input-group mb-3">
                                                    <input  readonly type="password" class="form-control" value="<?php echo ($details_data ["password"]); ?>" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <span class="input-group-text btn btn-primary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-12 mt-2">
                                                <label class="form-label">Rejisterd Date</label>
                                                <input class="form-control" value="<?php echo ($details_data ["joined_date"]); ?>" disabled type="text">
                                            </div><br>
                                            <?php
                                            if (!empty($address_data["line1"])) {
                                            ?>
                                                <div class="col-12 mt-2">
                                                    <label class="form-label">Address line 1</label>
                                                    <input id="line1" class="form-control" value="<?php echo ($address_data["line1"]); ?>" type="text">
                                                </div><br>
                                            <?php


                                            } else {
                                            ?>
                                                <div class="col-12 mt-2">
                                                    <label class="form-label">Address line 1</label>
                                                    <input class="form-control" id="line1" type="text">
                                                </div><br>
                                            <?php
                                            }


                                            if (!empty($address_data["line2"])) {
                                            ?>
                                                <div class="col-12 mt-2">
                                                    <label class="form-label">Address line 2</label>
                                                    <input id="line2" class="form-control" value="<?php echo ($address_data["line2"]); ?>" type="text">
                                                </div><br>
                                            <?php


                                            } else {
                                            ?>
                                                <div class="col-12 mt-2">
                                                    <label class="form-label">Address line 2</label>
                                                    <input id="line2" class="form-control" type="text">
                                                </div><br>
                                            <?php
                                            }
                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $distric_rs = Database::search("SELECT * FROM `distric`");
                                            

                                            ?>


                                            <div class="col-6 mt-2">
                                                <label for="form-lable">Province</label>
                                                <select class="form-select mt-2" id="Province" aria-label="Default select example">
                                                    <option value="0" selected>Select Province</option>
                                                    <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["id"]; ?>" <?php  if(!empty ($address_data["province_id"])){
                                                            if($province_data["id"]==$address_data["province_id"]){
                                                                ?>selected <?php
                                                            }

                                                        }?>>
                                                            <?php echo $province_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                            
                                                </select>
                                            </div><br>
                                            <div class="col-6 mt-2">
                                                <label for="form-lable">Distric</label>
                                                <select class="form-select mt-2" id="distric" aria-label="Default select example">
                                                    <option value="0" selected>Select Distric</option>
                                                    <?php
                                                    $distric_num = $distric_rs->num_rows;
                                                    for ($x = 0; $x < $distric_num; $x++) {
                                                        $distric_data = $distric_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $distric_data["id"]; ?>" <?php  if(!empty ($address_data["distric_id"])){
                                                            if($distric_data["id"]==$address_data["province_id"]){
                                                                ?>selected <?php
                                                            }

                                                        }?>>
                                                            <?php echo $distric_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                            
                                                </select>
                                            </div><br>
                                            <div class="col-6 mt-2">
                                                <label for="form-lable mt-2">City</label>
                                                <select class="form-select" id="city" aria-label="Default select example">
                                                    <option value="0" selected>select city</option>
                                                    <?php
                                                    $city_rs = Database::search("SELECT * FROM `city`");
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $distric_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["id"]; ?>" <?php  if(!empty ($address_data["city_id"])){
                                                            if($city_data["id"]==$address_data["province_id"]){
                                                                ?>selected <?php
                                                            }

                                                        }?>>
                                                            <?php echo $city_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                         
                                                </select>
                                            </div><br>
                                            <?php
                                            if(!empty($address_data["postal_code"])){
                                                ?>
                                                
                                                <div class="col-6 mt-2">
                                                <label class="form-label">Postal code</label>
                                                <input id="pcode" class="form-control" value="<?php echo ($address_data["postal_code"]); ?>" type="text">
                                            </div><br><br>
                                            <?php

                                            }else{?>
                                                <div class="col-6 mt-2">
                                                <label class="form-label">Postal code</label>
                                                <input id="pcode" class="form-control"  type="text">
                                            </div><br><br>
                                            <?php
                                            }
                                            
                                            ?>

                                            
                                            <div class="col-12 mt-2">
                                                <label class="form-label">Gender</label>
                                                <input class="form-control" type="text" value="<?php echo ($details_data["gender_name"]); ?>" disabled>
                                            </div>
                                            <div class="col-12 d-grid mt-3">
                                                <button class="btn btn-primary" onclick="updateMyProfile();">Update My Profile</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h1 class="mt-5 fw-bold text-black-50">Show ads</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php

            } else {

                header("location:http://localhost/eshop/home.php");
            }

            ?>





            <?php include "footer.php" ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>