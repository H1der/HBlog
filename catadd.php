<?php

//判断表单是否有 post 数据
if (empty($_POST)) {
    include('./view/admin/catadd.html');
} else {
    //连接数据库
    $conn = mysqli_connect('localhost', 'root', '123456');
    mysqli_query('use blog', $conn);
    mysqli_query('set name utf8', $conn);
    //如果有 post ,先判断传过来的 catname 是否为空
    $cat['catname'] = trim($_POST['catname']);
    if (empty($cat['catname'])) {
        echo '栏目不能为空';
    }

    //检测栏目是否存在
    $sql = "select count(*) from cat where catname = '$cat[catname]'";
    $rs = mysqli_query($sql);
    print_r(mysqli_fetch_assoc($rs));
//    print_r($rs);
}
