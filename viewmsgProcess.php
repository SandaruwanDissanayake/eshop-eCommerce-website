<?php
echo ("hello");


session_start();
require "connection.php";


$recever_mail = $_SESSION["u"]["email"];
$sender_mail = $_GET["e"];

echo $recever_mail;
 echo $sender_mail;

$msg_rs = Database::search("SELECT * FROM `chat` WHERE `from`='" . $sender_mail . "' OR `to`='" . $sender_mail . "'");
$msg_num = $msg_rs->num_rows;


for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    if ($msg_data["from"] == $sender_mail && $msg_data["to"] == $recever_mail) {

?>
        <!-- received -->
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
    }else if ($msg_data["to"] == $sender_mail && $msg_data["from"] == $recever_mail) {

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