<?php
$cat_id = $_GET['cat_id'];
//print_r($cat_id);exit();
include ('./lib/init.php');
//检测cat_id是否为数字
if (!is_numeric($cat_id)) {
    echo '栏目不合法';
    exit();
}
//检测栏目是否存在
$sql = 'select count(*) from cat where cat_id=' . $cat_id;
//echo mGetOne($sql);exit();
if (mGetOne($sql) == 0) {
    echo '栏目不存在';
}
if (empty($_POST)) {
    $sql = 'select catname from cat where cat_id=' . $cat_id;
    $rs = mQuery($sql);
    $cat =mysqli_fetch_assoc($rs);
//    print_r($cat);exit();
    require(ROOT.'/view/admin/cataedit.html');
} else {
    $sql = "update cat set catname = '$_POST[catname]' where cat_id = $cat_id";
    if (!mQuery($sql)) {
        echo '修改失败';
    } else {
        echo '修改成功';
    }
}