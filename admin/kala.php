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
<title>تعریف کالاها</title>
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
        <h5><b><i class="fa fa-dashboard"></i>تعریف کالاها</b></h5>
    </header>
    <div class="w3-white w3-padding-large w3-margin w3-round-medium w3-right" style="width: 80%;">
        <?php
        $fm = new makeform();
        $fm->set_tbl_key("kala", "id", 1);
        $fm->CSRF_token();

        $fm->fast_string_input("عنوان کالا", "title", "title", 1, 1, 1);
        $fm->label("کد فروشگاه", "w3-text-green")
            ->input()
            ->inptype("number")
            ->inpname("shop_id")
            ->inpid("shop_id")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("shop_id", 1, 1, "کد فروشگاه", 1, 1)
            ->must_be_in("shops", "id", "shop_id");
        $fm->fast_textarea("توضیحات کالا", "txt", "txt", 1);
        $fm->fast_number_input("قیمت ورودی به شرکت", "price_in", "price_in", 1);
        $fm->fast_number_input("قیمت خروجی از شرکت", "price_out", "price_out", 1);
        $fm->label("کد تصویر", "w3-text-green")
            ->input()
            ->inptype("number")
            ->inpname("pic_id")
            ->inpid("pic_id")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("pic_id", 1, 1, "کد تصویر")
            ->must_be_in("pic", "id", "pic_id");
        $fm->label("دسته بندی", "w3-text-green")
            ->select()
            ->selectid("cat_id")
            ->selectname("cat_id")
            ->selectclasses("w3-select w3-border")
            ->selectdb("cat", "title", "id", "", " where `ty`=5")
            ->end()
            ->sndform("cat_id", 2, 1, "دسته بندی", 1, 1);
        $fm->fast_number_input("دستمزد بازاریابی", "price_visitor", "price_visitor", 1);
        $fm->fast_number_input("دستمزد شرکت", "price_us", "price_us", 1);
        $fm->fast_number_input("تخفیف", "price_off", "price_off", 1);
        $fm->fast_number_input("تعداد موجودی", "countt", "countt", 1);
        $fm->label("واحد اندازه گیری", "w3-text-greeen")
            ->select()
            ->selectid("vahed_id")
            ->selectname("vahed_id")
            ->selectclasses("w3-select w3-border")
            ->selectdb("vahed", "title", "id")
            ->end()
            ->sndform("vahed_id", 2, 1, "واحد اندازه گیری");


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