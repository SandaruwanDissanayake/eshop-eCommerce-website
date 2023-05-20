<?php
require "connection.php";
session_start();
// require "connection.php";

if (isset($_SESSION["u"]["email"])) {
    $email = $_SESSION["u"]["email"];
    $pageno;
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MyProducts | eshop</title>
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

        <link rel="icon" href="resource/logo.svg">

    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!--header-->
                <?php



                ?>
                <div class="col-12 bg-primary">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 mb-1 text-center">

                                    <?php

                                    $profile_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email1`='" . $email . "'");
                                    $Profile_image_num = $profile_image_rs->num_rows;
                                    $profile_image_data = $profile_image_rs->fetch_assoc();

                                    if ($Profile_image_num == 1) {

                                    ?>

                                        <img src="<?php echo $profile_image_data["path"]; ?>" width="90px" height="90px" class="rounded-circle" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resource/profile-user.png" width="90px" height="90px" class="rounded-circle" />
                                    <?php
                                    }

                                    ?>


                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="row text-lg-start text-center">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="text-white fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                        </div>
                                        <div class="col-12 ">
                                            <span class="text-black-50 fw-bold"><?php echo $email; ?></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 mt-2 col-lg-10 my-lg-4">
                                    <h1 class="offset-4 offset-lg-2 text-white fw-bold">My Product</h1>
                                </div>
                                <div class="col-12 col-lg-2 my-lg-4 mb-2 mx-2 my-lg-4 mx-lg-0 d-grid">
                                    <button class="btn btn-warning fw-bold" onclick="window.location='addProduct.php'">Add Product</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--header-->

                <!--body-->

                <div class="col-12">
                    <div class="row">
                        <!--filter-->
                        <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Stor Product</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="s" placeholder="Search....">
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label for="" class="form-label"><i  onclick="sort1(0);" style="cursor: pointer;" class="bi bi-search fs-5"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="" class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width:80%;">
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="from-lable fw-bold" for="">By quntitiy </label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;">

                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="from-lable fw-bold" for="">By condition </label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;">

                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="b">
                                            <label class="form-check-label" for="b">
                                                Brand new
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="u">
                                            <label class="form-check-label" for="u">
                                                Used
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3 mb-3">
                                        <div class="row g-2">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-success fw-bold" onclick="sort1(0);">Sort</button>
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-primary fw-bold" onclick="deletsort();">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--filter-->
                        <!--product-->
                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white">
                            <div class="row" id="sort">
                                <div class="offset-1 col-10 text-center " >
                                    <div class="row justify-content-center">

                                        <?php
                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }
                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'");
                                        $product_num = $product_rs->num_rows;

                                        $results_per_page = 4;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        // echo("hello1");

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'
                                        LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        // echo ("hello");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();
                                        ?>
                                            <!--card-->
                                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">
                                                        <?php

                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                        $product_img_data = $product_img_rs->fetch_assoc();

                                                        ?>
                                                        <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-primary"><?php echo $selected_data["price"]; ?></span>
                                                            <br>
                                                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Item left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?> " <?php if ($selected_data["status_id"] == 2) { ?> checked<?php } ?> onclick="statusChange(<?php echo $selected_data['id']; ?>);">
                                                                <label class="form-check-label fw-bold text-info" for="fd<?php echo $selected_data["id"]; ?> ">
                                                                    <?php if ($selected_data["status_id"] == 2) {
                                                                    ?> Make your product Active<?php
                                                                                            } else {
                                                                                                ?>
                                                                        Make your product deactive

                                                                    <?php
                                                                                            } ?>
                                                                </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row g-1 mt-2 mb-2">
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a onclick="sendId(<?php echo $selected_data['id']; ?>);" class="btn btn-success">Update</a>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <button class="btn btn-danger" >Delet</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--card-->


                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <!-- cut -->
                                </div>
                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item ">
                                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                echo "#";
                                                                            } else {
                                                                                echo "?page=" . ($pageno - 1);
                                                                            } ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php
                                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                                if ($x == $pageno) {
                                            ?>
                                                    <li class="page-item bg-primary"><a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item bg-primary"><a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a></li>
                                            <?php
                                                }
                                            }

                                            ?>

                                            <li class="page-item">
                                                <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                echo "#";
                                                                            } else {
                                                                                echo "?page=" . ($pageno + 1);
                                                                            } ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!--product-->
                    </div>
                </div>




            </div>
        </div>

        <!--body-->

        <?php
        include "footer.php";
        ?>

        </div>
        </div>


    <?php
} else {
    header("location:home.php");
}

    ?>





    <script src="script.js"></script>
    </body>

    </html>