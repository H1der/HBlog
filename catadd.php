<?php
require ('./lib/mysql.php');
//判断表单是否有 post 数据
if (empty($_POST)) {
    include('./view/admin/catadd.html');
} else {
    //如果有 post ,先判断传过来的 catname 是否为空
    $cat['catname'] = trim($_POST['catname']);
    //    print_r($cat['catname']);exit();
    if (empty($cat['catname'])) {
        echo '栏目不能为空';
        exit();
    }

    //检测栏目是否存在
    $sql = "SELECT count(*) FROM cat WHERE catname = '$cat[catname]'";
//    print_r(mQuery($sql));exit();
    $rs = mQuery($sql);
//    print_r(mysqli_fetch_row($rs));exit();
    if (mysqli_fetch_row($rs)[0] != 0) {
        echo '栏目已经存在';
        exit();
    }
//    print_r(mExec('cat',$Cat));exit();

    //将栏目插入数据库
    if (!mExec('cat',$cat)) {
        echo mysqli_error(mConn());
    } else {
        echo '添加成功';
    }

}
