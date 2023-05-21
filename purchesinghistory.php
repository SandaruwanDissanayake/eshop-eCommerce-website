<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>purchesing History | eShop</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resource/logo.svg">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php";

            // require "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "'");
                $invoice_num = $invoice_rs->num_rows;
            ?>


                <div class="col-12 text-center mb-3">
                    <span class="fs-1 text-primary fw-bold">Purchasing History</span>
                </div>

                <?php

                if ($invoice_num == 0) {
                ?>
                    <div class="col-12 bg-body text-center" style="height:450px ;">
                        <span class="fs-1 fw-bolder text-black-50 d-block" style="margin-top: 200px;">
                            You have not purchased ane product yet...
                        </span>
                    </div>
                <?php
                } else {
                ?>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-1 bg-light">
                                        <label for="" class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3 bg-light">
                                        <label for="" class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-light">
                                        <label for="" class="form-label fw-bold">Quntity</label>
                                    </div>
                                    <div class="col-2 bg-light">
                                        <label for="" class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-light">
                                        <label for="" class="form-label fw-bold">Purchased Date & Time</label>
                                    </div>
                                    <div class="col-3 bg-light">
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <?php
                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                            ?>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-1 bg-info text-center text-lg-start">
                                            <label class="form-label text-white fs-6 py-5"><?php echo $invoice_data["id"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="card mx-0 mx-lg-3" style="max-width: 540px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">

                                                        <?php
                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();

                                                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                        $img_data = $img_rs->fetch_assoc();
                                                        ?>

                                                        <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">



                                                            <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                                            <?php
                                                            $seller_rs = Database::search("SELECT*FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                            $seller_data = $seller_rs->fetch_assoc();
                                                            ?>
                                                            <p class="card-text"><b>Seller: </b> <?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></p>
                                                            <p class="card-text"><small class="text-muted"><b>Price:</b> Rs.<?php echo $product_data["price"]; ?>.00</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-1 text-end   text-lg-end">
                                            <label class="form-label    fs-6 py-5"><?php echo $invoice_data["qty"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 bg-info text-end text-lg-end">
                                            <label class="form-label text-end  text-white fs-6 py-5">Rs.<?php echo $invoice_data["total"]; ?>.00</label>
                                        </div>
                                        <div class="col-12 col-lg-2 text-end  text-lg-end">
                                            <label class="form-label text-end  fs-6 py-5"><?php echo $invoice_data["date"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3  text-center text-lg-start">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-secondary mt-5" onclick='addFeedback(<?php echo $invoice_data["id"]; ?>);'><i class="bi bi-info-square"></i>&nbsp; Feedbak</button>
                                                </div>
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-danger mt-5"><i class="bi bi-trash-fill"></i>&nbsp; Delete</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                  <!-- model -->
                            <div class="modal" tabindex="-1" id="feedbackModl<?php echo $invoice_data["id"]; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="">Type</label>
                                                            </div>
                                                            
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="type1">
                                                                    <label class="form-check-label text-success fw-bold" for="type1">
                                                                        Positive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="type2">
                                                                    <label class="form-check-label text-warning fw-bold" for="type2">
                                                                        Neutral
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="type3">
                                                                    <label class="form-check-label text-danger fw-bold" for="type3">
                                                                        Negative
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label for="" class="form-label fw-bold">User's email</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" value="<?php echo $umail; ?>" name="" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label for="" class="form-label fw-bold">
                                                                        Feedback
                                                                    </label>
                                                                   
                                                                </div>
                                                                <div class="col-9">
                                                                        <textarea class="form-control" cols="50" rows="8" id="textarea"></textarea>
                                                                    </div>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);" class="btn btn-primary">Save Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- model -->

                            <?php
                            }
                            ?>


                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class=" offset-lg-10 col-12 col-lg-2 d-grid mb-3">
                                        <button class=" btn btn-danger "><i class="bi bi-trash-fill"></i>&nbsp; Delete</button>
                                    </div>


                                </div>
                            </div>

                          


                        </div>
                    </div>

                <?php
                }

                ?>



            <?php
            }

            ?>


            <?php include "footer.php"; ?>

        </div>
    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>