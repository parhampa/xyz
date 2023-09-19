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
<script src="../lib/js/palib.js"></script>
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
        $fm->label("دسته بندی", "w3-text-green")
            ->select()
            ->selectid("cat_id")
            ->selectname("cat_id")
            ->selectclasses("w3-select w3-border")
            ->selectdb("cat", "title", "id", "", " where `ty`=5")
            ->end()
            ->sndform("cat_id", 2, 1, "دسته بندی", 1, 1);

        $fm->fast_string_input("عنوان کالا", "title", "title", 1, 1, 1);
        $fm->label("کد فروشگاه", "w3-text-green");
        $fm->input()
            ->inptype("number")
            ->inpname("shop_id")
            ->inpid("shop_id")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("shop_id", 1, 1, "کد فروشگاه", 1, 1)
            ->must_be_in("shops", "id", "shop_id");
        $fm->all = $fm->all . "عنوان فروشگاه: <span id='titleplcco'></span><br>";
        $fm->input()
            ->inpval("انتخاب فروشگاه")
            ->inptype("button")
            ->inpclasses("w3-btn w3-round w3-green")
            ->onclick("document.getElementById('co_list').style.display='block';")
            ->end();
        $fm->all .= "<br>";

        $fm->label("واحد اندازه گیری", "w3-text-green")
            ->select()
            ->selectid("vahed_id")
            ->selectname("vahed_id")
            ->selectclasses("w3-select w3-border")
            ->selectdb("vahed", "title", "id")
            ->end()
            ->sndform("vahed_id", 2, 1, "واحد اندازه گیری");
        $fm->fast_textarea("توضیحات کالا", "txt", "txt", 1);
        $fm->label("کد تصویر", "w3-text-green")
            ->input()
            ->inptype("number")
            ->inpname("pic_id")
            ->inpid("pic_id")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("pic_id", 1, 1, "کد تصویر")
            ->must_be_in("pic", "id", "pic_id");
        $fm->all .= "<div style='display: none;' id='selpic' onclick='hideselpic();'><img src='' style='width: 33%;' id='picplc'></div>";
        $fm->input()
            ->inptype("button")
            ->inpval("انتخاب تصویر")
            ->inpclasses("w3-btn w3-round w3-green")
            ->onclick("document.getElementById('piclist').style.display='block';")
            ->end();
        $fm->all .= "<br>";

        $fm->fast_number_input("قیمت ورودی به شرکت", "price_in", "price_in", 1);
        $fm->fast_number_input("قیمت خروجی از شرکت", "price_out", "price_out", 1);

        $fm->fast_number_input("دستمزد بازاریابی", "price_visitor", "price_visitor", 1);
        $fm->fast_number_input("دستمزد شرکت", "price_us", "price_us", 1);
        $fm->fast_number_input("تخفیف", "price_off", "price_off", 1);
        $fm->fast_number_input("تعداد موجودی", "countt", "countt", 1);


        $fm->submit();
        $fm->addform();
        $fm->show();


        $md = new modal();
        $md->add_inner_modal_top("co_list");
        ?>
        <div style="width: 100%; text-align: center;">
            <input type="text" name="ttl" id="ttl" class="cofilter">
            <input type="button" value="جستجو" onclick="load_list_co();">
            <input type="button" value="درج فروشگاه جدید" onclick="window.open('shops.php')">
            <br>
            <br>
        </div>
        <script>
            function select_co(id) {
                document.getElementById('shop_id').value = id;
                var newid = "titleid" + id;
                document.getElementById('titleplcco').innerHTML = document.getElementById(newid).innerHTML;
                document.getElementById('co_list').style.display = 'none';
            }
        </script>
        <div style="width: 100%; direction: rtl;" id="tblco">
            <table class="w3-table-all">
                <tr>
                    <th style="text-align: center;">عنوان شرکت</th>
                    <th style="text-align: center;">شهر</th>
                    <th style="text-align: center;">عملیات</th>
                </tr>
                <?php
                $sqlt = "select * from `shops` order by `id` desc limit 0,10";
                $dbt = new database();
                $dbt->connect()->query($sqlt);
                while ($fildt = mysqli_fetch_assoc($dbt->res)) {
                    ?>
                    <tr>
                        <td style="text-align: center;"
                            id="titleid<?php echo($fildt['id']); ?>"><?php echo($fildt['title']); ?></td>
                        <td style="text-align: center;"><?php
                            $cid = $fildt['city'];
                            $sqltt = "select * from `citis` where `id`=$cid";
                            $dbtt = new database();
                            $dbtt->connect()->query($sqltt);
                            $fildtt = mysqli_fetch_assoc($dbtt->res);
                            echo($fildtt['title']);
                            ?></td>
                        <td style="text-align: center;">
                            <input type="button" value="انتخاب فروشگاه" class="w3-btn w3-round w3-green"
                                   onclick="select_co(<?php echo($fildt['id']); ?>)">
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
        $md->add_inner_modal_down();

        $md = new modal();
        $md->add_inner_modal_top("piclist");
        ?>
        <div style="width: 100%; text-align: center;">
            <input type="text" name="ttl" id="ttl" class="picfilter">
            <input type="button" value="جستجو" onclick="load_list_pic();">
            <input type="button" value="آپلود تصویر" onclick="window.open('gallery.php')">
            <br>
            <br>
        </div>
        <div style="width: 100%; direction: rtl;" id="tblpic">
            <table class="w3-table-all">
                <tr>
                    <th style="text-align: center;">
                        عنوان تصویر
                    </th>
                    <th style="text-align: center;">
                        تصویر
                    </th>
                    <th style="text-align: center;">
                        عملیات
                    </th>
                </tr>
                <?php
                $dbt = new database();
                $sqlt = "select * from `pic` order by `id` limit 0,10";
                $dbt->connect()->query($sqlt);
                while ($fildt = mysqli_fetch_assoc($dbt->res)) {
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo($fildt['title']); ?></td>
                        <td style="text-align: center;">
                            <img id="tmppic<?php echo($fildt['id']); ?>" src="<?php echo($fildt['address']); ?>"
                                 style="width: 30%;">
                        </td>
                        <td style="text-align: center;">
                            <span onclick="select_picture(<?php echo($fildt['id']); ?>);"
                                  class="w3-btn w3-green w3-round">انتخاب</span>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <script>
                function load_list_co() {
                    placeid = "tblco";
                    document.getElementById(placeid).innerHTML = "";

                    postobj.send_type = "post";
                    postobj.post_url = "list_co_tbl.php";
                    postobj.after_success = function (data) {
                        document.getElementById(placeid).innerHTML = data;
                    };
                    res_obj_postdata("cofilter");
                }

                function load_list_pic() {
                    placeid = "tblpic";
                    document.getElementById(placeid).innerHTML = "";

                    postobj.send_type = "post";
                    postobj.post_url = "list_pic_tbl.php";
                    postobj.after_success = function (data) {
                        document.getElementById(placeid).innerHTML = data;
                    };
                    res_obj_postdata("picfilter");
                }

                function hideselpic() {
                    document.getElementById('selpic').style.display = "none";
                }

                function select_picture(id) {
                    document.getElementById('pic_id').value = id
                    document.getElementById('piclist').style.display = "none";
                    var tmpid = 'tmppic' + id;
                    document.getElementById('picplc').src = document.getElementById(tmpid).src;
                    document.getElementById('selpic').style.display = "";
                }
            </script>
        </div>
        <?php
        $md->add_inner_modal_down();
        ?>
    </div>

    <!-- End page content -->
</div>
<?php
include("footer.php");
?>
</body>
</html>