<?php require "connection.php"; ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="col-12">
        <div class="row mt-1 mb-1">
            <div class="row mt-1 mb-1"></div>
            <div class="offset-lg-1 col-12 col-lg-4 align-self-start mt-2">

                <?php
                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];

                ?>
                    <span class="text-lg-start"><b>Welcome</b> <?php echo ($data["fname"]); ?></span>
                    <span class="text-lg-start fw-bold signOut" style="color:red ;" onclick="signOut();">Sign Out</span> |
                <?php

                } else {

                ?>
                    <a href="index.php" class="text-lg-start fw-bold text-decoration-none" style="color:red ;">Sign In or Rejister</a>
                <?php
                }
                ?>

                <span class="text-lg-start fw-bold">Help and Contact</span>
            </div>

            <div class="offset-lg-4 col-12 col-lg-3 align-self-end">
                <div class="row">
                    <div class="col-1 col-lg-3 mt-2">
                        <span class="text-start fw-bold">Sell</span>
                    </div>
                    <div class="col-2 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop
                        </button>
                        <ul class=" dropdown-menu">
                            <li><a class="dropdown-item" href="userProfile.php">My profile</a></li>
                            <li><a class="dropdown-item" href="#">My Selling</a></li>
                            <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="Watchlist.php">Watchlist</a></li>
                            <li><a class="dropdown-item" href="purchesinghistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="massage.php">Massage</a></li>
                            <li><a class="dropdown-item" href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');">Contact Admin</a></li>

                        </ul>
                    </div>
                    <div class="col-1 col-lg-3 ms-lg-0 mt-1 cart-icon" onclick="window.location='cart.php';"></div>


                    <!-- msg model -->
                    <div class="modal" tabindex="-1" id="contactAdmin">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <?php
                                $msg_rs = Database::search("SELECT * FROM `chat` WHERE `from`='" . $_SESSION["u"]["email"] . "' OR `to`='" . $_SESSION["u"]["email"] . "' ORDER BY `date_time` ASC");
                                ?>
                                <div class="modal-body overflow-scroll" style="max-height:500px ;">
                                    <!-- received -->

                                    <?php

                                    $msg_num = $msg_rs->num_rows;
                                    for ($x = 0; $x < $msg_num; $x++) {
                                        $msg_data = $msg_rs->fetch_assoc();
                                        if ($msg_data["to"] == $_SESSION["u"]["email"]) {
                                    ?>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-8 rounded bg-success">
                                                        <div class="row">
                                                            <div class="col-12 pt-2">
                                                                <span class="text-white fw-bold fs-4"><?php echo $msg_data["content"]; ?></span>
                                                            </div>
                                                            <div class="col-12 text-end pb-2">
                                                                <span class="text-white fs-6"><?php echo $msg_data["date_time"]; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- received -->
                                        <?php
                                        } else {

                                        ?>
                                            <!-- sent -->
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="offset-4 col-8 rounded bg-primary">
                                                        <div class="row">
                                                            <div class="col-12 pt-2">
                                                                <span class="text-white fw-bold fs-4"><?php echo $msg_data["content"]; ?></span>
                                                            </div>
                                                            <div class="col-12 text-end pb-2">
                                                                <span class="text-white fs-6"><?php echo $msg_data["date_time"]; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- sent -->
                                    <?php
                                        }
                                    }

                                    ?>



                                    <!-- sent -->
                                </div>
                                <div class="modal-footer">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="msgtxt">
                                            </div>
                                            <div class="col-3 d-grid">
                                                <button type="button" class="btn btn-primary" onclick="sendAdminMs('<?php echo $_SESSION['u']['email']; ?>');">Send</button>
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





    <script src="script.js"></script>
</body>

</html>