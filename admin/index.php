<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/25/2020
 * Time: 4:01 PM
 */
session_start();
include("../lib/php/lib_include.php");
include("check_admin_session.php");
?>
<!DOCTYPE html>
<html>
<title>داشبورد مدیریت</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="../lib/js/jquery.js"></script>
<script src="js/fnuser.js"></script>
<script src="js/modal.js"></script>
<?php
include("calhead.php");
?>
<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: Tahoma;
    }

    body {
        font-size: 12px;
    }
</style>
<body class="w3-light-grey" style="direction: rtl;">

<!-- Top container -->
<?php
include("top.php");
?>
<!-- Sidebar/menu -->
<?php
include("nav.php");
?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
     title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-right:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px;">
        <h5><b> <i class="fa fa-sticky-note w3-margin-left"> </i>آخرین یادداشت ها</b></h5>
    </header>
    <div class="w3-padding-large w3-margin w3-round-medium">
        <div class="w3-mobile" style="width: 100%;">
            <?php
            $sqlt = "select distinct `tarikh` from `mynote` where `fpage`=1 and `vaz`=0 order by tarikh";
            $dbt = new database();
            $dbt->connect()->query($sqlt);
            while ($fildt = mysqli_fetch_assoc($dbt->res)) {
                ?>
                <div class="w3-third w3-padding w3-right">
                    <div style=" width: 100%; text-align: center;">
                        <i class="fa fa-calendar"></i>
                        <span>
                            <?php
                            $year = substr($fildt['tarikh'], 0, 4);
                            $month = substr($fildt['tarikh'], 5, 2);
                            $day = substr($fildt['tarikh'], 8, 2);
                            $jdate = gregorian_to_jalali($year, $month, $day);
                            $jfdate = $jdate[0] . "-" . $jdate[1] . "-" . $jdate[2];
                            echo($jfdate);
                            ?>
                        </span>
                    </div>
                    <div class="w3-white w3-card w3-round"
                         style="min-height:200px; max-height: 200px; overflow-y: scroll;">
                        <ul>
                            <?php
                            $tarikh = $fildt['tarikh'];
                            $sqln = "select * from `mynote` where `tarikh`='$tarikh' and `fpage`=1 and vaz=0 order by `ordnum` desc ";
                            $dbn = new database();
                            $dbn->connect()->query($sqln);
                            while ($fildn = mysqli_fetch_assoc($dbn->res)) {
                                ?>
                                <li>
                                    <a href="#" title="<?php echo($fildn['txt']); ?>"
                                       alt="<?php echo($fildn['txt']); ?>" style="text-decoration: none;">
                                        <span><?php echo($fildn['title']); ?></span>
                                    </a>
                                    <br>
                                    <span class="w3-left w3-margin-left">
                                    <a href="mynote.php?action=editform&id=<?php echo($fildn['id']); ?>"
                                       style="text-decoration: none;" target="_blank">
                                        <i class="fa fa-eye w3-text-blue"></i>
                                    </a>
                                        <a href="change_note_vaz.php?id=<?php echo($fildn['id']); ?>"
                                           style="text-decoration: none;">
                                            <i class="fa fa-check w3-text-blue"></i>
                                        </a>
                                        <a href="change_note_order.php?ty=0&id=<?php echo($fildn['id']); ?>"
                                           style="text-decoration: none;">
                                            <i class="fa fa-arrow-down w3-text-red"></i>
                                        </a>
                                        <a href="change_note_order.php?ty=1&id=<?php echo($fildn['id']); ?>"
                                           style="text-decoration: none;">
                                            <i class="fa fa-arrow-up w3-text-green"></i>
                                        </a>
                            </span>
                                </li>
                                <hr>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- End page content -->
</div>
<?php
include("footer.php");
?>
</body>
</html>