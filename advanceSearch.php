<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Advance Search | eShop</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resource/logo.svg">
</head>

<body class="bg-info">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-body mb-2">
                <?php
                include "header.php";
                ?>
            </div>
            <div class="col-12 bg-body mb-2">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2">
                                <div class="mt-2 mb-2 logo" style="height:80px ;">

                                </div>

                            </div>
                            <div class="col-10 text-center">
                                <p class="fs-1 text-black-50 fw-bold mt-3 pt-2">Advance Search</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-2">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 mb-1">
                                <input type="text" class="form-control" placeholder="Type Keyword To Search...." id="t">
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-3 border-primary">
                            </div>
                        </div>
                    </div>
                    <div class="offset-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12 col-lg-4 mb-2">
                                <select class="form-select" name="" id="c1">
                                    <option value="0">--Select category--</option>

                                    <?php
                                    // require "connection.php";

                                    $category_rs = Database::search("SELECT *FROM `category`");
                                    $category_num = $category_rs->num_rows;

                                    for ($x = 0; $x < $category_num; $x++) {
                                        $category_data = $category_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 mb-2">
                                <select class="form-select" name="" id="b">
                                    <option value="0">--Select Brand--</option>

                                    <?php


                                    $Brand_rs = Database::search("SELECT *FROM `brand`");
                                    $Brand_num = $Brand_rs->num_rows;

                                    for ($x = 0; $x < $Brand_num; $x++) {
                                        $Brand_data = $Brand_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $Brand_data["id"]; ?>"><?php echo $Brand_data["name"]; ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 mb-2">
                                <select class="form-select" name="" id="m">
                                    <option value="0">--Select Model--</option>

                                    <?php


                                    $Model_rs = Database::search("SELECT *FROM `model`");
                                    $Model_num = $Model_rs->num_rows;

                                    for ($x = 0; $x < $Model_num; $x++) {
                                        $Model_data = $Model_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $Model_data["id"]; ?>"><?php echo $Model_data["name"]; ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-2">
                                <select class="form-select" name="" id="c2">
                                    <option value="0">--Select Condition--</option>

                                    <?php


                                    $Condition_rs = Database::search("SELECT *FROM `condition`");
                                    $Condition_num = $Condition_rs->num_rows;

                                    for ($x = 0; $x < $Condition_num; $x++) {
                                        $Condition_data = $Condition_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $Condition_data["id"]; ?>"><?php echo $Condition_data["name"]; ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-2">
                                <select class="form-select" name="" id="c3">
                                    <option value="0">--Select Colour--</option>

                                    <?php


                                    $Color_rs = Database::search("SELECT *FROM `colour`");
                                    $Color_num = $Color_rs->num_rows;

                                    for ($x = 0; $x < $Color_num; $x++) {
                                        $Color_data = $Color_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $Color_data["id"]; ?>"><?php echo $Color_data["name"]; ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <input type="text" class="form-control" id="pf" placeholder="Price From.....">
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <input type="text" class="form-control" id="pt" placeholder="Price To.....">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-2">
                <div class="row">
                    <div class="offset-4 col-8 mt-2 mb-2 offset-lg-8 col-lg-4">
                        <select name="" class="form-select border border-start-0 border-top-0 border-end-0 border-2 border-primary shadow-none" id="s">
                            <option value="0">SORT BY</option>
                            <option value="1">PRICE HIGH TO LOW</option>
                            <option value="2">PRICE LOW TO HIGH</option>
                            <option value="3">QUNTITY HIGH TO LOW</option>
                            <option value="4">QUNTITY LOW TO HIGH</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-2">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center ">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search" style="font-size:100px ;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">No Item Searched Yet..</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>


    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>