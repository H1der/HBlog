<?php

$cat_id = $_GET['cat_id'];
//print_r($cat_id);exit();
//连接数据库
$conn = mysqli_connect('localhost', 'root', '', 'blog');
//设置写入字符集
mysqli_query($conn, "set character set 'utf8'");

//检测cat_id是否为数字
if (!is_numeric($cat_id)) {
    echo '栏目不合法';
    exit();
}

//检测栏目是否存在
$sql = 'select count(*) from cat where cat_id=' . $cat_id;
$rs = mysqli_query($conn, $sql);
if (mysqli_fetch_row($rs)[0] == 0) {
    echo '栏目不存在';
}

if (empty($_POST)) {
    $sql = 'select catname from cat where cat_id=' . $cat_id;
    $rs = mysqli_query($conn, $sql);
    $cat = mysqli_fetch_assoc($rs);
    require('./view/admin/cataedit.html');
} else {
    $sql = "update cat set catname = '$_POST[catname]' where cat_id = $cat_id";
    if (!mysqli_query($conn, $sql)) {
        echo '修改失败';
    } else {
        echo '修改成功';
    }
}