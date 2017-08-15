<?php

//判断表单是否有 post 数据
if (empty($_POST)) {
    include('./view/admin/catadd.html');
} else {
    //连接数据库
    $conn = mysqli_connect('localhost', 'root', '', 'blog');

    //设置字符集为utf8
    mysqli_query($conn,'set name utf8');

    //如果有 post ,先判断传过来的 catname 是否为空
    $cat['catname'] = trim($_POST['catname']);
    //    print_r($cat['catname']);exit();
    if (empty($cat['catname'])) {
        echo '栏目不能为空';
        exit();
    }

    //检测栏目是否存在
    $sql = "SELECT count(*) FROM cat WHERE catname = '$cat[catname]'";
    //print_r($sql);exit();
    $rs = mysqli_query($conn, $sql);
    //print_r($rs);exit();
    if (mysqli_fetch_row($rs)[0] != 0 ) {
        echo '栏目已经存在';
        exit();
    }

    //将栏目插入数据库
    $sql = "insert into cat (catname) values ('$cat[catname]')";
    if(!mysqli_query($conn,$sql)){
        echo mysqli_errno();
    }else{
        echo '添加成功';
    }

}
