<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | eShop</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="resource/logo.svg">

</head>

<body>
    <div class="container-fluid">
        <div class="row gy-3">
            <?php
            include "header.php";
            // require "connection.php";

            if (isset($_SESSION["u"])) {

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="h2 text-primary fw-bold">Add New Product</h2>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="" class="form-label fw-bold" style="font-size:20px ;">Select Category</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select text-center" onchange="loadbrand();" id="category">
                                                <option value="0">--Select Category--</option>
                                                <?php
                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo ($category_data["name"]); ?></option>
                                                <?php
                                                }


                                                ?>

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
                                            <select class="form-select text-center" onchange="loadmodel();" id="brand">
                                                <option value="0">--Select Brand--</option>
                                                <?php
                                                $brand_rs = Database::search("SELECT *FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;
                                                for ($y = 0; $y < $brand_num; $y++) {
                                                    $brand_data = $brand_rs->fetch_assoc(); 
                                                ?>
                                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                <?php
                                                }

                                                ?>


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
                                            <select class="form-select text-center" id="model">
                                                <option value="0">--Select Model--</option>
                                                <?php
                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;
                                                for ($z = 0; $z < $model_num; $z++) {
                                                    $model_data = $model_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                <?php
                                                }

                                                ?>

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
                                            <input class="form-control" type="text" id="tittle">
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
                                            <div class="col-12">
                                                <div class="form-check form-check-inline offset-1 col-5">
                                                    <input class="form-check-input" type="radio" id="b" name="c" checked>
                                                    <label class="form-check-label fw-bold" for="b">Brand New</label>
                                                </div>
                                                <div class="form-check form-check-inline col-5">
                                                    <input class="form-check-input" type="radio" id="u" name="c">
                                                    <label class="form-check-label fw-bold" for="u" >used</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="row border-end">
                                                <div class="col-12 ">
                                                    <label class="form-label fw-bold" style="font-size:20px ;" for="">Select Product color</label>
                                                </div>
                                                <div class="col-12">
                                                    
                                                        <select name="" class="form-select p-3" id="clr">
                                                            <option value="0">--Select--</option>

                                                            <?php
                                                             $clr_rs = Database::search("SELECT * FROM `colour`");
                                                            $clr_num = $clr_rs->num_rows;

                                                            for ($a = 0; $a < $clr_num; $a++) {
                                                                $clr_data = $clr_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["name"]; ?></option>

                                                             
                                                            <?php

                                                            }

                                                            ?>
                                                        </select>
                                                   


                                                </div>


                                            </div>
                                            <div class="col-12">
                                                <div class="input-group mb-3 mt-3">
                                                    <input type="text" class="form-control" placeholder="Add New color">
                                                    <button class="btn btn-outline-secondary" id="clr_in" type="button" id="button-addon2">+ Add</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size:20px ;">Add Product Quntity</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="number" id="qty" class="form-control" value="0" min="0">
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

                                    <div class="col-6 border-end border-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size:20px ;">Cost Per Item</label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <div class="input-group">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" id="cost" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
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
                                                    <input type="text" id="dwc" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
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
                                                    <input type="text" id="doc" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
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
                                        <textarea name="" id="desc" cols="30" rows="15" class="form-control"></textarea>
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
                                        <div class="row">
                                            <div class="col-4 border border-primary rounded">
                                                <img src="resource/addproductimg.svg" class="img-fluid" style="width:250px ;" id="i0" >
                                            </div>
                                            <div class="col-4 border border-primary rounded">
                                                <img src="resource/addproductimg.svg" class="img-fluid" style="width:250px ;" id="i1" >
                                            </div>
                                            <div class="col-4 border border-primary rounded">
                                                <img src="resource/addproductimg.svg" class="img-fluid" style="width:250px ;" id="i2" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                        <input type="file" class="d-none" id="imageuploder" multiple>
                                        <label for="imageuploder" class="col-12 btn btn-primary" onclick="changeProductImage();">Uplode Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr class="border-success" style="border-width:3px ;">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Notice....</label><br>
                                <label for="" class="form-label">We are taking 5% of the products from price from every
                                    product as a service charge.
                                </label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    <?php

            } else {

                header("Location:home.php");
            }
    ?>



    <?php include "footer.php"; ?>

    </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>