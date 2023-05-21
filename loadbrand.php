<?php
// echo("brands");
require "connection.php";

if(isset($_GET["c"])){
    $category_id=$_GET["c"];
 
    $brand_rs=Database::search("SELECT * FROM `brand` WHERE `category_id`='".$category_id."'");

    $brand_num=$brand_rs->num_rows;
  ?>
    <option value="0">--Select Brand--</option> 
  <?php

    if($brand_num > 0 ){
        for($x=0; $x < $brand_num;$x++){
            $brand_data=$brand_rs->fetch_assoc();
            // echo("hello");
            ?>
            <option value="<?php echo $brand_data["id"];?>"><?php echo $brand_data["name"]; ?></option>
            
            <?php
        }
    }else{
       $all_brand=Database::search("SELECT * FROM `brand`");
       $all_num=$all_brand->num_rows;
       for($y=0; $y<$all_num;$y++){
        $all_data=$all_brand->fetch_assoc();
        ?>
        <option value="<?php echo $all_data["id"];?>"><?php echo $all_data["name"]; ?></option>
        
        <?php
       }
    }
}

?>