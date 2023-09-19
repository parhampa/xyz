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
<title>تعریف مشتریان</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="../lib/js/jquery.js"></script>
<script src="js/fnuser.js"></script>
<script src="js/modal.js"></script>
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
        <h5><b><i class="fa fa-dashboard"></i>تعریف مشتریان</b></h5>
    </header>
    <div class="w3-white w3-padding-large w3-margin w3-round-medium w3-right" style="width: 80%;">
        <?php
        $fm = new makeform();
        $fm->set_tbl_key("customers", "id", 1);
        $fm->CSRF_token();
        $fm->label("شماره تماس مشتری", "w3-text-green")
            ->input()
            ->inpname("phone")
            ->inpid("phone")
            ->inptype("number")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("phone", 1, 1, "شماره تماس مشتری", 1, 1)
            ->must_not_be_in("customers", "phone", "phone");
        $fm->fast_password_input("کلمه عبور", "pass", "pass");
        $fm->fast_textarea("نام", "name", "name", 1, 1, 1);
        $fm->fast_string_input("نام خانوادگی", "family", "family", 1, 1, 1);
        $fm->fast_textarea("آدرس", "address", "address");
        $fm->fast_string_input("کد پستی", "post_code", "post_code");
        $fm->label("شهر", "w3-text-green")
            ->select()
            ->selectname("city")
            ->selectid("city")
            ->selectclasses("w3-select w3-border")
            ->selectdb("citis", "title", "id")
            ->end()
            ->sndform("city", 2, 1, "شهر", 1, 1)
            ->must_be_in("citis", "id", "city");
        $fm->label("وضعیت برای خرید", "w3-text-green")
            ->select()
            ->selectname("vaz_shop")
            ->selectid("vaz_shop")
            ->selectclasses("w3-select w3-border")
            ->selectaddval("0", "تایید نشده")
            ->selectaddval("1", "تایید شده")
            ->end()
            ->sndform("vaz_shop", 2, 1, "وضعیت برای خرید", 1, 1);
        $fm->fast_number_input("کد معرف", "refer", "refer", 0, 1, 1);
        $fm->label("وضعیت کاربری", "w3-text-green")
            ->select()
            ->selectname("vaz_user")
            ->selectid("vaz_user")
            ->selectclasses("w3-select w3-border")
            ->selectaddval("0", "تایید نشده")
            ->selectaddval("1", "تایید شده")
            ->end()
            ->sndform("vaz_user", 2, 1, "وضعیت کاربری", 1, 1);
        $fm->fast_string_input("کد ملی", "kod_meli", "kod_meli");
        $fm->fast_string_input("ایمیل", "email", "email");
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