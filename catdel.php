<?php

    //把地址栏的post cat_id获取过来
    $cat_id = $_GET['cat_id'];

    //连接数据库
    $conn = mysqli_connect('localhost', 'root', '', 'blog');
    //设置字符集
    mysqli_query($conn, "set names utf8");

    //如果cat_id不是数字
    if (!is_numeric($cat_id)) {
        echo '栏目错误';
        eixt();
    }

    //如果栏目下有文章,不能删除
    $sql = 'select count(*) from art where cat_id=' . $cat_id;
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($rs);
    if ($row[0] != 0) {
        echo '栏目下有文章,不能删除';
        exit();
    }

    //查询该栏目是否存在
    $sql = 'select count(*) from cat where cat_id=' . $cat_id;
    $rs = mysqli_query($conn,$sql);
    $row = mysqli_fetch_row($rs);
    if($row[0] == 0){
        echo '栏目不存在';
        exit();
    }

    $sql = 'delete from cat where cat_id='.$cat_id;
    $rs = mysqli_query($conn,$sql);

    if (!$rs){
        echo mysqli_errno();
    }else{
        echo '删除成功';
    }