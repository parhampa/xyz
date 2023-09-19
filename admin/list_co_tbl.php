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
    ->set_title("عنوان فروشگاه")
    ->set_important(false)
    ->post_str();
$sql = "select * from `shops` order by `id` desc limit 0,10";
if (trim($ttl) != "") {
    $sql = "select * from `shops` where `title` like '%$ttl%' or `title` like '$ttl%' or `title` like '%$ttl' order by `id` desc limit 0,10";
}
?>
<table class="w3-table-all">
    <tr>
        <th style="text-align: center;">عنوان شرکت</th>
        <th style="text-align: center;">شهر</th>
        <th style="text-align: center;">عملیات</th>
    </tr>
    <?php
    $sqlt = $sql;
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
