<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resource/logo.svg">

    <title>Single Product view | eShop</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php
            require "header.php";
            ?>
            <?php

            // require "connection.php";

            if (isset($_GET["id"])) {
                $pid = $_GET["id"];
                $product_rs = Database::search("SELECT product.category_id,product.id,product.brand_has_model_id,product.colour_id,
    product.price,product.qty,product.description,product.title,product.condition_id,
    product.status_id,product.user_email,product.datetime_add,product.delivery_fee_colombo,
    product.delivery_fee_other,model.name AS mname,brand.name AS bname FROM `product` 
    INNER JOIN `brand_has_model` ON brand_has_model.id=product.brand_has_model_id 
    INNER JOIN `brand` ON brand.id=brand_has_model.brand_id INNER JOIN
    `model` ON model.id=brand_has_model.model_id WHERE product.id='" . $pid . "'");

                $product_num = $product_rs->num_rows;

                if ($product_num == 1) {
                    $product_data = $product_rs->fetch_assoc();
                    // echo($pid);
            ?>

                    <div class="col-12-12 mt-0 bg-white singleProduct">
                        <div class="row">
                            <div class="col-12 " style="padding: 10px;">
                                <div class="row">
                                    <div class="col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {

                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["code"];

                                            ?>


                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img["$x"]; ?>" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);">
                                                    </li>

                                                <?php
                                                }
                                            } else {


                                                ?>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1">
                                                </li>
                                            <?php

                                            }


                                            ?>


                                        </ul>
                                    </div>
                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <div class="main-img" id="main_img">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row border-bottom border-dark">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Singal Product View</li>
                                                        </ol>
                                                    </nav>

                                                </div>
                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-success fw-bold"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>
                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            &nbsp;&nbsp;
                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews & Ratings</label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                                $price = $product_data["price"];
                                                $adding_price = ($price / 100) * 5;
                                                $new_price = $price + $adding_price;
                                                $differnt_price = $new_price - $price;
                                                $percentage = ($differnt_price / $price) * 100;

                                                ?>
                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-dark fw-bold">Rs.<?php echo $price ?>.00</span>
                                                        &nbsp; &nbsp; | &nbsp; &nbsp;
                                                        <span class="fs-4 text-danger fw-bold text-decoration-line-through">Rs.<?php echo $new_price ?>.00</span>
                                                        &nbsp; &nbsp; | &nbsp; &nbsp;
                                                        <span class="fs-4 text-black-50 fw-bold">Save Rs.<?php echo $differnt_price ?> .00 (<?php echo $percentage ?>%) </span>

                                                    </div>
                                                </div>
                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-5 text-primary"><b>Warrenty : </b> 6 Months Warranty</span><br>
                                                        <span class="fs-5 text-primary"><b>Return Policy : </b> 1 Months Return Policy</span><br>
                                                        <span class="fs-5 text-primary"><b>In Stock : </b> <?php echo $product_data["qty"]; ?> Item Available</span>

                                                    </div>
                                                </div>
                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row g-2">
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary">Seller Email : <?php echo $product_data["user_email"] ?></span>
                                                            </div>
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary"><b>Sold:</b>10 Item</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-3  col-lg-2 border-end border-2 border-danger">
                                                                        <img src="resource/pricetag.png" alt="">
                                                                    </div>
                                                                    <div class="col-9  col-lg-10">
                                                                        <span class="fs-5 text-danger fw-bold">Stand a chance to get 5% discount by using ViSA or MASTER</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty" style="width:100% ;">
                                                                        <div class="col-12">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>)' />

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-inc">
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec(<?php echo $product_data["qty"]; ?>);'></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-5">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-success" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-primary">Add To Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-secondary">
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>


                            <?php
                            $related_rs = Database::search("SELECT * FROM `product`  WHERE `title` LIKE '%" . $product_data["title"] . "%' LIMIT 4 OFFSET 0");
                            $related_num = $related_rs->num_rows;

                            for ($x = 0; $x < $related_num; $x++) {
                                $related_data = $related_rs->fetch_assoc();

                            ?>
                                <div class="col-3 m-0">
                                    <div class="row ">
                                        <div class="col-12 bg-white">
                                            <div class="row g-2 ">
                                                <div class="offset- offset-lg-0 col-4 col-lg-2">
                                                    <div class="card text-center" style="width: 18rem;">

                                                        <?php

                                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $related_data["id"] . "'");
                                                        $image_data = $image_rs->fetch_assoc();


                                                        ?>
                                                        <img src="<?php echo $image_data_data["code"]; ?>" style="height: 180px;" class="card-img-top img-thumbnail mt-2" />
                                                        <div class="card-body">

                                                            <h5 class="card-title"><?php echo $related_data["title"]; ?></h5>
                                                            <span class="card-text text-primary">Rs <?php echo $related_data["price"]; ?>.00</span><br>

                                                            <?php
                                                            if ($related_data["qty"] > 0) {

                                                            ?>
                                                                <span class="card-text text-warning fw-bold">In Stoke</span><br>
                                                                <span class="cart-text text-success fw-bold"><?php echo $related_data["qty"]; ?> Item Available</span><br><br>
                                                                <a class="btn btn-success col-12 mt-2" href='<?php echo "singelProductViwe.php?id=" . $related_data["id"]; ?>'>Buy Now</a>
                                                                <button class="col-12 btn btn bg-danger mt-2">Add to cart</button><br>
                                                            <?php

                                                            } else {

                                                            ?>
                                                                <span class="card-text text-warning fw-bold">Out of Stoke</span><br>
                                                                <span class="cart-text text-success fw-bold">00 Item Available</span><br><br>
                                                                <button class="col-12 btn btn-success disabled">Buy Now</button><br>
                                                                <button class="col-12 btn btn bg-danger mt-2 disabled">Add to cart</button><br>
                                                            <?php

                                                            }

                                                            ?>
                                                            <button class="col-12 btn btn-outline-light mt-2 border border-info"><i class="bi bi-heart-fill text-danger fs-5"></i></button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            <?php
                            }

                            ?>





                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                            <div class="col-12">
                                <span class="fs-3 fw-bold">Product Details</span>
                            </div>
                            <div class="col-6 bg-white">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="form-label fs-4 fw-bold text-bg-danger">Brand : </label>
                                            </div>
                                            <div class="col-8">
                                                <label class="form-label fs-4 text-success text-start"><?php echo $product_data["bname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="form-label fs-4 fw-bold text-bg-danger">Model : </label>
                                            </div>
                                            <div class="col-8">
                                                <label class="form-label fs-4 text-success"><?php echo $product_data["mname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Product Description : </label>
                                            </div>
                                            <div>
                                                <textarea cols="60" rows="10" class="form-control" readonly><?php echo $product_data["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Feedbacks</span>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="row border border-1 border-dark rounded me-0 overflow-scroll " style="height: 300px;">

                                            <?php
                                            $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                            $feedback_num = $feedback_rs->num_rows;

                                            if ($feedback_num !== "0") {

                                                for ($x = 0; $x < $feedback_num; $x++) {
                                                    $feedback_data = $feedback_rs->fetch_assoc();

                                            ?>
                                                    <div class="col-12 mt-1 mb-1 mx-1">
                                                        <div class="row border border-1 border-dark rounded me-0">
                                                            <div class="col-10 mt-1 mb-1 ms-0">

                                                                <?php
                                                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                                                $user_data = $user_rs->fetch_assoc();
                                                                ?>

                                                                <span class="fw-bold"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span>
                                                            </div>
                                                            <?php
                                                            if ($feedback_data["type"] == "1") {
                                                            ?>
                                                                <div class="col-2 mt-1 mb-1 me-0">
                                                                    <span class="badge bg-success">Positive</span>
                                                                </div>
                                                            <?php
                                                            } else if ($feedback_data["type"] == "2") {
                                                            ?>
                                                                <div class="col-2 mt-1 mb-1 me-0">
                                                                    <span class="badge bg-warning">Natural</span>
                                                                </div>
                                                            <?php
                                                            } else if ($feedback_data["type"] == "3") {
                                                            ?>
                                                                <div class="col-2 mt-1 mb-1 me-0">
                                                                    <span class="badge bg-danger">Negative</span>

                                                                </div>
                                                            <?php
                                                            }
                                                            ?>


                                                            <div class="col-12">
                                                                <hr>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-text-center fw-bold text-black-50"><?php echo $feedback_data["feedback"]; ?></p>
                                                            </div>
                                                            <div class="offset-6 col-6 text-end">
                                                                <label for="" class="form-label fs-6"><?php echo $feedback_data["date"]; ?></label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php
                                                }
                                                ?>


                                            <?php
                                            } else if ($feedback_data == "0") {
                                            ?>
                                                <p class="text-center">No feedback</p>
                                            <?php
                                            }


                                            ?>


                                        </div>
                                    </div>
                                </div>
                            </div>








                        </div>
                    </div>
                    <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>

<?php
                }
            } else {
                echo ("somthing went wrong");
            }

?>