<?php
session_start();
header('Access-Control-Allow-Origin: *');
header("Pragma-directive: no-cache");
header("Cache-directive: no-cache");
header("Cache-control: no-cache");
header("Pragma: no-cache");
header("Expires: 0");
include("../lib/php/lib_include.php");
include("check_admin_session.php");
$ml = new mobile_input();
$ttl = $ml->set_name("ttl")
    ->set_title("عنوان تصویر")
    ->set_important(false)
    ->post_str();
$sql = "select * from `pic` order by `id` desc limit 0,10";
if (trim($ttl) != "") {
    $sql = "select * from `pic` where `title` like '%$ttl%' or `title` like '$ttl%' or `title` like '%$ttl' order by `id` desc limit 0,10";
}
?>
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
    $sqlt = $sql;
    $dbt->connect()->query($sqlt);
    while ($fildt = mysqli_fetch_assoc($dbt->res)) {
        ?>
        <tr>
            <td style="text-align: center;"><?php echo($fildt['title']); ?></td>
            <td style="text-align: center;">
                <img src="<?php echo($fildt['address']); ?>" style="width: 30%;">
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
