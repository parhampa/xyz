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
<title>یادداشت های من</title>
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
        <h5><b><i class="fa fa-dashboard"></i>یادداشت های من</b></h5>
    </header>
    <div class="w3-white w3-padding-large w3-margin w3-round-medium w3-right" style="width: 80%;">
        <?php
        $fm = new makeform();
        $fm->set_tbl_key("mynote", "id", 1);
        $fm->CSRF_token();
        $fm->fast_string_input("عنوان", "title", "title", 1, 1, 1);
        $fm->fast_textarea("توضیحات", "txt", "txt");
        $fm->dateinput("tarikh", "تاریخ یاد آوری", 1, 1, 1);
        $fm->fast_number_input("ترتیب نمایش", "ordnum", "ordnum");
        $fm->label("وضعیت انجام", "w3-text-green")
            ->select()
            ->selectname("vaz")
            ->selectid("vaz")
            ->selectclasses("w3-select w3-border")
            ->selectaddval("0", "انجام نشده")
            ->selectaddval("1", "انجام شده")
            ->end()
            ->sndform("vaz", 2, 1, "وضعیت انجام", 1, 1);
        $fm->label("نمایش در صفحه اول", "w3-text-green")
            ->select()
            ->selectname("fpage")
            ->selectid("fpage")
            ->selectclasses("w3-select w3-border")
            ->selectaddval("1", "نمایش در صفحه اول")
            ->selectaddval("0", "نمایش در قسمت مدیریت")
            ->end()
            ->sndform("fpage", 2, 1, "نمایش در صفحه اول", 1, 1);

        $fm->submit();
        $fm->addform();
        $fm->show();
        ?>

    </div>
    <!-- End page content -->
</div>
<?php
include("footer.php");
?>
</body>
</html>