<?php 

// echo("hello");

session_start();

require "connection.php";

$user = $_SESSION["u"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];
$condition = $_POST["c"];

// echo($search);
// echo($time);
// echo($time);
// echo($qty);
// echo($condition);

$query = "SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($condition != "0") {

    $query .= " AND `condition_id`='" . $condition . "'";
}
if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `datetime_add` DESC";
    } else  if ($time == "2") {
        $query .= " ORDER BY `datetime_add` ASC";
    }
}
if ($time != "0" && $qty != "0") {
    
        if ($qty == "1") {
            $query .= " , `qty` DESC";
        } else if ($qty == "2") {
            $query .= " , `qty` ASC";
        }
    
}else if ($time == "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}

?>

<div class="offset-1 col-10 text-center ">
    <div class="row justify-content-center">

        <?php


        if ("0" != ($_POST["page"])) {
            // echo("hello1");
            $pageno = $_POST["page"];
            // echo("hello2");
        } else {
            $pageno = 1;
        }
      


        $product_rs = Database::search($query);
       
        $product_num = $product_rs->num_rows;

        $results_per_page = 4;
        $number_of_pages = ceil($product_num / $results_per_page);

        // echo("hello1");

        $page_results = ($pageno - 1) * $results_per_page;
        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

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
</div>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                                echo "#";
                                            } else {
                                                ?>
                                                onclick="sort1('<?php echo ($pageno - 1); ?>');"
                                                <?php
                                                // echo "?page=" . ($pageno - 1);
                                            } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php

            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {

            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="sort1('<?php echo $x; ?>');"><?php echo $x; ?></a>
                    </li>
                <?php

                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="sort1('<?php echo $x; ?>');"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo "#";
                                            } else {
                                                ?>
                                                onclick="sort1('<?php echo ($pageno + 1); ?>');"
                                                <?php
                                                // echo "?page=" . ($pageno + 1);
                                            } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>