<?php require "connection.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admins | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Manage All Products</label>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Product Image</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">Title</span>
                    </div>
                    <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">Quantity</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-white"></div>
                </div>
            </div>

            <?php


            $query = "SELECT * FROM `product`";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 20;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>

                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class="fs-6 fw-bold text-white"><?php echo $selected_data["id"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2" onclick="viewProductModel('<?php echo $selected_data['id']; ?>');">

                            <?php

                            $img_rs = Database::search("SELECT * FROM `images` WHERE  `product_id`='" . $selected_data["id"] . "'");
                            $img_num = $img_rs->num_rows;
                            if ($img_num == 1) {
                                $img_data = $img_rs->fetch_assoc();
                            ?>
                                <img src="<?php echo $img_data["code"]; ?>" style="height: 40px;margin-left: 80px;" />
                            <?php
                            } else {
                            ?>
                                <img src="resource/empty.svg" style="height: 40px;margin-left: 80px;" />
                            <?php
                            }

                            ?>


                        </div>
                        <div class="col-4 col-lg-2 bg-primary py-2">
                            <span class="fs-6 fw-bold text-white"><?php echo $selected_data["title"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                            <span class="fs-6 fw-bold">Rs. <?php echo $selected_data["price"]; ?> .00</span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-primary py-2">
                            <span class="fs-6 fw-bold text-white"><?php echo $selected_data["qty"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <span class="fs-6 fw-bold"><?php echo $selected_data["datetime_add"]; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                            <?php

                            if ($selected_data["status_id"] == 1) {
                            ?>
                                <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                            <?php

                            }

                            ?>
                        </div>
                    </div>
                </div>


                <!-- model_1 -->
                <div class="modal" tabindex="-1" id="viewProductModel<?php echo $selected_data["id"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $selected_data["title"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="offset-4 col-4">
                                    <img src="<?php echo $img_data["code"]; ?>" class="img-fluid" style="height:150px ;" alt="">
                                </div>
                                <div class="col-12">
                                    <span class="fs-5 fw-bold">Price : </span>&nbsp;
                                    <span class="fs-5">Rs. <?php echo $selected_data["price"]; ?>.00</span><br>
                                    <span class="fs-5 fw-bold">Quantity : </span>&nbsp;
                                    <span class="fs-5"><?php echo $selected_data["qty"]; ?> Product left</span><br>
                                    <?php

                                    $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                    $seller_data = $seller_rs->fetch_assoc();

                                    ?>
                                    <span class="fs-5 fw-bold">Seller : </span>&nbsp;
                                    <span class="fs-5"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br>
                                    <span class="fs-5 fw-bold">Description : </span>&nbsp;
                                    <span class="fs-5"><?php echo $selected_data["description"]; ?>.</span><br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- model_1 -->



            <?php

            }

            ?>

            <!--  -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--  -->

            <hr>

            <div class="col-12 text-center">
                <h3 class="text-black-50 fw-bold">Manage Categories</h3>
            </div>
            <div class="col-12 mb-3">
                <div class="row gap-1 justify-content-center">

                    <?php

                    $category_rs = Database::search("SELECT *FROM `category`");
                    $category_num = $category_rs->num_rows;

                    for ($x = 0; $x < $category_num; $x++) {
                        $category_data = $category_rs->fetch_assoc();
                    ?>
                        <div class="col-12 col-lg-3 border border-danger rounded" style="height:50px ;">
                            <div class="row">
                                <div class="col-8 mt-2">
                                    <label for="" class="form-label fw-bold fs-5"><?php echo $category_data["name"]; ?></label>
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2">
                                    <label for="" class=" form-label fs-4 text-danger"><i class="bi bi-trash3-fill"></i></label>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    ?>


                    <div class="col-12 col-lg-3 border border-success rounded" style="height:50px ;" onclick="addNewCategory();">
                        <div class="row">
                            <div class="col-8 mt-2">
                                <label for="" class="form-label fw-bold fs-5">Add new Category</label>
                            </div>
                            <div class="col-4 border-start border-secondary text-center mt-2">
                                <label for="" class=" form-label fs-4 text-success"><i class="bi bi-plus-square-fill"></i></i></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mode_2 -->

            <div class="modal" tabindex="-1" id="addCategoryModel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="" class="form-label">New Category Name :</label>
                                <input type="text" class="form-control" id="n">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Enter Your Email :</label>
                                <input type="email" class="form-control" id="e">
                            </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verifyCategory();">Save New category</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- mode_2 -->
            <!-- mode_3 -->

            <div class="modal" tabindex="-1" id="addCategoryVerificationModel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-label">Enter Your Verification Code : </div>
                            <input type="text" class="form-control" id="text">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify and save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mode_3 -->



        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>