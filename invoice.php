<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice | eShop</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resource/logo.svg">
</head>

<body class="mt-2" style="background-color:#f7f7ff ;">
    <div class="container-fluid">
        <div class="row">
            <?php require "header.php";
            // require "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];
            ?>




                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="prinInvoice();"><i class="bi bi-printer-fill"></i>Print</button>
                    <button class="btn btn-danger me-2" onclick="exportPdf();"><i class="bi bi-filetype-pdf"></i>Export as PDF</button>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12" id="page">
                    <div class="row">
                        <div class="col-6">
                            <div class="ms-5 invoiceHedearImage"></div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-primary text-text-decoration-underline text-end">
                                    <h2>eShop</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Maradana, Colombo 10, Sri lanka</span><br>
                                    <span>+94 122 785694</span><br>
                                    <span>eshop@gmail.com</span>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="border border-1 border-primary">
                        </div>
                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>

                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                    $address_data = $address_rs->fetch_assoc();
                                    ?>

                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                    <span><?php echo $address_data["line1"] . ", " . $address_data["line2"]; ?></span><br>

                                    <span><?php echo $umail; ?></span>

                                </div>

                                <?php
                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                $invoice_data = $invoice_rs->fetch_assoc();
                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE 0<?php echo $invoice_data["id"]; ?></h1>
                                    <span>Date & Time of Invoice :</span>
                                    <span><?php echo $invoice_data["date"]; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table">

                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th>#</th>
                                        <th>Oder ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">quntity</th>
                                        <th class="text-end">Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height:72px ;">
                                        <td class="bg-primary text-white fs-3"><?php echo $invoice_data["id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-decoration-underline text-primary p-2"><?php echo $oid; ?></span><br>

                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            ?>

                                            <span class="fw-bold text-primary fs-4 p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs.<?php echo $product_data["price"]; ?>.00</td>
                                        <td class="fw-bold fs-6 text-end pt-4 "><?php echo $invoice_data["qty"]; ?></td>

                                        <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs.<?php echo $invoice_data["total"]; ?>.00</td>

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <?php

                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();
                                    $delivery = 0;
                                    if ($city_data["distric_id"] == 7) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }
                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;

                                    ?>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs.<?php echo $g; ?>.00</td>

                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary">Delivery fee</td>
                                        <td class="text-end border-primary">Rs.<?php echo $delivery; ?>.00</td>

                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">GROUND TOTAL</td>
                                        <td class="text-end border-primary text-primary">Rs.<?php echo $t; ?>.00</td>

                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                        <div class="col-4 text-center" style="margin-top:-80px;">
                            <span class="fs-1 fw-bold text-success">Thank You</span>
                        </div>
                        <div class="col-12 border-start border-5 border-primary mt-3 mb-3 rounded" style="background-color:#e7f2ff ;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="from-label fw-bold fs-5">NOTICE : </label><br>
                                    <label class="form-label fs-6">Purchased item can return befor 7 days of delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="border border-1 border-primary">
                        </div>
                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">
                                Invoice was created on acomputer and is valid without the signature and seal.
                            </label>
                        </div>

                    </div>
                </div>
            <?php
            }

            ?>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    
</body>

</html>