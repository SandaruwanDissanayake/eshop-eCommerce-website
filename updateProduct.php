<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update My Product | eShop</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="resource/logo.svg">

</head>

<body>
    <div class="container-fluid">
        <div class="row gy-3">
            <?php include "header.php";

            // require "connection.php";

            if (isset($_SESSION["u"])) {
                if (isset($_SESSION["p"])) {
            ?>




                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="h2 text-primary fw-bold">Update My Product</h2>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size:20px ;">Select Product</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-center " disabled>
                                                    <?php
                                                    $product = $_SESSION["p"];
                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();
                                                    ?>
                                                    <option value=""><?php echo $category_data["name"]; ?></option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size:20px ;">select Product Brand</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <?php

                                                    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN 
                                                    (SELECT `brand_id` FROM `brand_has_model` WHERE `id`='" . $product["brand_has_model_id"] . "')");
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                    ?>
                                                    <option value=""><?php echo $brand_data["name"]; ?></option>

                                                    <!-- <option value="">--Select Model--</option>
                                                    <option value="">Apple</option>
                                                    <option value="">Sony</option>
                                                    <option value="">Samsung</option> -->

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size:20px ;">select Product model</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <?php

                                                    $brand_rs = Database::search("SELECT * FROM `model` WHERE `id` IN 
                                                   (SELECT `model_id` FROM `brand_has_model` WHERE `id`='" . $product["brand_has_model_id"] . "')");
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                    ?>
                                                    <option value=""><?php echo $brand_data["name"]; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr style="border-width:3px ;">
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size:20px ;" for="">Add a titile your product</label>
                                            </div>
                                            <div class="col-12 col-lg-8 offset-12 offset-lg-2">
                                                <input class="form-control" value="<?php echo $product["title"]; ?>" id="t" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr style="border-width:3px ;">
                                    </div>
                                    <div class="col-12">
                                        <div class="row border-end">
                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <label class="form-label fw-bold" style="font-size:20px ;" for="">Select Product Condition</label>
                                                </div>
                                                <?php
                                                if ($product["condition_id"] == 1) {
                                                ?>
                                                    <div class="col-12">
                                                        <div class="form-check form-check-inline offset-1 col-5">
                                                            <input class="form-check-input" type="radio" id="b" name="c" checked disabled>
                                                            <label class="form-check-label fw-bold" for="b">Brand New</label>
                                                        </div>
                                                        <div class="form-check form-check-inline col-5">
                                                            <input class="form-check-input" type="radio" id="u" name="c" disabled>
                                                            <label class="form-check-label fw-bold" for="u">used</label>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                    ?>
                                                    <div class="col-12">
                                                        <div class="form-check form-check-inline offset-1 col-5">
                                                            <input class="form-check-input" type="radio" id="b" name="c"  disabled>
                                                            <label class="form-check-label fw-bold" for="b">Brand New</label>
                                                        </div>
                                                        <div class="form-check form-check-inline col-5">
                                                            <input class="form-check-input" type="radio" id="u" name="c" checked disabled>
                                                            <label class="form-check-label fw-bold" for="u">used</label>
                                                        </div>
                                                    </div>
                                                <?php
                                                }

                                                ?>

                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="row border-end">
                                                    <div class="col-12 ">
                                                        <label class="form-label fw-bold" style="font-size:20px ;" for="">Select Product color</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <?php
                                                        $color_rs=Database::search("SELECT * FROM `colour` WHERE `id`='".$product["colour_id"]."'");
                                                        $color_data=$color_rs->fetch_assoc();
                                                        ?>
                                                        <select name="" class="form-select" disabled id="">
                                                            <option value=""><?php echo $color_data["name"]; ?></option>
                                                        </select>
                                                    </div>
                                                   
                                                    <div class="col-12">
                                                        <div class="input-group mb-3 mt-3">
                                                            <input type="text" class="form-control" placeholder="Add New color" disabled>
                                                            <button class="btn btn-outline-secondary" type="button" disabled id="button-addon2">+ Add</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size:20px ;">Add Product Quntity</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" id="q" class="form-control" value="<?php echo $product["qty"]; ?>" min="0">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border-success" style="border-width:3px ;">
                                    </div>
                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label fw-bold" style="font-size:20px ;">Cost Per Item</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" value="<?php echo $product["price"]; ?>" aria-label="Dollar amount (with dot and two decimal places)" disabled>
                                                            <span class="input-group-text">.00</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label fw-bold" style="font-size:20px ;">Approved payement method</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                            <div class=" col-2 pm pm2"></div>
                                                            <div class=" col-2 pm pm3"></div>
                                                            <div class=" col-2 pm pm4"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border-success" style="border-width:3px ;">
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size:20px ;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label for="" class="form-label">Delevery cost colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" id="dwc" value="<?php echo $product["delivery_fee_colombo"]; ?>" aria-label="Dollar amount (with dot and two decimal places)">
                                                            <span class="input-group-text">00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label for="" class="form-label">Delevery cost Out of colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" id="doc" value="<?php echo $product["delivery_fee_other"]; ?>" aria-label="Dollar amount (with dot and two decimal places)">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <hr class="border-success" style="border-width:3px ;">
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea name="" id="desc" cols="30" rows="15" class="form-control"><?php echo $product["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border-success" style="border-width:3px ;">
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Add Product Image</label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6">
                                                <?php
                                                $img=array();
                                                $img[0]="resource/addproductimg.svg";
                                                $img[1]="resource/addproductimg.svg";
                                                $img[2]="resource/addproductimg.svg";
                                                $images_rs=Database::search("SELECT * FROM `images` WHERE `product_id`='".$product["id"]."'");
                                                $images_num=$images_rs->num_rows;

                                                for($x=0; $x<$images_num;$x++){
                                                    $images_data=$images_rs->fetch_assoc();
                                                    $img[$x]=$images_data["code"];
                                                }


                                                ?>
                                                <div class="row">
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[0]; ?>" class="img-fluid" style="width:250px ;" id="i0">
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[1]; ?>" class="img-fluid" style="width:250px ;" id="i1">
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[2]; ?>"class="img-fluid" style="width:250px ;" id="i2">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                                <input type="file" class="d-none" id="imageuploder" multiple>
                                                <label for="imageuploder" onclick="changeProductImage();" class="col-12 btn btn-primary">Uplode Image</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border-success" style="border-width:3px ;">
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                        <button class="btn btn-success" onclick="updateProduct();">Update Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                } else {
                    header("location:myProduct.php");
                }
            } else {
                header("location:home.php");
            }

            ?>

            <?php include "footer.php" ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>