<?php

require "connection.php";



$txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["to"];
$sort = $_POST["s"];

// echo($brand);

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%'";
        $status = 1;
    }

    if ($status == 0 && $category != 0) {
        $query .= " WHERE `category_id`='" . $category . "'";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `category_id`='" . $category . "'";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {

        $brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $brand . "'");
        $brand_num = $brand_rs->num_rows;
        for ($x = 0; $x < $brand_num; $x++) {
            $brand_data = $brand_rs->fetch_assoc();
            $pid = $brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `brand_has_model_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {

        $model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_id`='" . $model . "'");
        $model_num = $model_rs->num_rows;
        for ($x = 0; $x < $model_num; $x++) {
            $model_data = $model_rs->fetch_assoc();
            $pid = $model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `brand_has_model_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $model != 0) {

        $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $brand . "' 
        AND `model_id`='" . $model . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `brand_has_model_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($status == 0 && $condition != 0) {
        $query .= " WHERE `condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($status != 0 && $condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($status == 0 && $color != 0) {
        $query .= " WHERE `colour_id`='" . $color . "'";
        $status = 1;
    } else if ($status != 0 && $color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "'";
        }
    } else if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "'";
        }
    } else if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        }
    }
} else if ($sort == 1) {
    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `price` DESC";
        $status = 1;
    } 
    
} else if ($sort == 2) {
    // echo ("PRICE LOW TO HIGH");
    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `price` ASC";
        $status = 1;
    } 
} else if ($sort == 3) {
    // echo ("QUANTITY HIGH TO LOW");
    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `qty` DESC";
        $status = 1;
    } 
} else if ($sort == 4) {
    // echo ("QUANTITY LOW TO HIGH");
    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%' ORDER BY `qty` ASC";
        $status = 1;
    } 
}

if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 10;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {
?>

    <div class="card mb-3 mt-3 col-12 col-lg-6">
        <div class="row">

            <div class="col-md-4 mt-4">

                <?php
                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $results_data["id"] . "'");
                $image_data = $image_rs->fetch_assoc();
                ?>
                <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" alt="...">
                <?php
                ?>


            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <h5 class="card-title fw-bold"><?php echo $results_data["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs:<?php echo $results_data["price"]; ?>.00</span>
                    <br />
                    <span class="card-text text-success fw-bold fs"><?php echo $results_data["qty"]; ?> Items Left</span>

                    <div class="row">
                        <div class="col-12">

                            <div class="row g-1">
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="#" class="btn btn-success fs">Buy Now</a>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="#" class="btn btn-danger fs">Add Cart</a>
                                </div>
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



<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                        ?> onclick="advancedSearch('<?php echo ($pageno - 1); ?>');" <?php
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
                        <a class="page-link" onclick="advancedSearch('<?php echo $x; ?>');"><?php echo $x; ?></a>
                    </li>
                <?php

                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch1('<?php echo $x; ?>');"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="advancedSearch('<?php echo ($pageno + 1); ?>');" <?php
                                                                                                                // echo "?page=" . ($pageno + 1);
                                                                                                            } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>