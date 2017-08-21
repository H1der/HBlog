<?php

require('./lib/init.php');

if (empty($_POST)) {
    include(ROOT . '/view/front/login.html');
} else {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
//    $sql = "select * from user where name='".$name . "' and password='".$password."'";
//    $rs = mGetRow($sql);

    //根据用户名查用户信息
    $sql = "select * from user where name ='" . $name . "'";
    $user = mGetRow($sql);
    if (empty($user)) {
        var_dump($user);
        error('用户名错误');
    } else if (md5($password . $user['salt']) !== $user['password']) {
        error('密码错误');
    } else {
        setcookie('name', $user['name']);
        setcookie('ccode', ccode($user['name']));
        header('Location:artlist.php');
    }
}