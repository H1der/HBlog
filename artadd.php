<?php

include ('./lib/init.php');

//从数据库中取出栏目
$sql = 'select * from cat ';
$cat = mGetAll($sql);

if (empty($_POST)){
    include (ROOT.'/view/admin/artadd.html');
}else{
    //检测标题
    $art['title'] = trim($_POST['title']);
    if(empty($art['title'])){
        error('标题不能为空');
    }
    //检测栏目
    $art['cat_id'] = $_POST['cat_id'];
    if (!is_numeric($art['cat_id'])){
        error('栏目不为数字');
    }

//检测内容
    $art['content'] = trim($_POST['content']);
    if(empty($art['content'])){
        error('内容不能为空');
    }

//文章发布时间
    $art['pubtime']=time();

//发布文章
    if(!mExec('art',$art)){
        error('文章发布失败');
    }else{
        succ('文章发布成功');
    }
}

