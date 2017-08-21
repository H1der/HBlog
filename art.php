<?php
include('./lib/init.php');
$art_id = $_GET['art_id'];
$sql = 'select title,content,pubtime,catname,comm,pic from art left join cat on art.cat_id=cat.cat_id where art_id=' . $art_id;
$art = mGetRow($sql);
//print_r($art);exit();

if (empty($art)) {
    header('Location:index.php');
    exit;
}
$sql = 'select * from cat';
$cats = mGetAll($sql);

//如果post非空,则有评论
if (!empty($_POST)) {
    $comm = array();
    $comm['art_id'] = $art_id;
    $comm['nick'] = $_POST['nick'];
    $comm['content'] = htmlspecialchars(trim($_POST['content']));
    $comm['email'] = $_POST['email'];
    $comm['pubtime'] = time();
    //获取来访者ip
    $comm['ip']=sprintf('%u',ip2long(getIp()));

    //插入的评论返回结果 如果返回false 则发布评论失败
    $rs = mExec('comment', $comm);
    if ($rs) {
        //评论发布成功 将art表的comm+1
        $sql = "update art set comm=comm+1 where art_id=$art_id";
        mQuery($sql);

        //跳转到上个页面
        $ref = $_SERVER['HTTP_REFERER'];
        header("Location: $ref");
    }

    //每增加一条评论,art_表的comm字段+1
    $sql = 'update art set comm=comm+1 where art_id='.$art_id;

    //跳转到上一页
    $ref = $_SERVER['HTTP_REFERER'];
    header("Location:$ref");
}

//取出所有评论
$sql = 'select * from comment where art_id = '.$art_id;
$comment = mGetAll($sql);
//print_r($comment);exit();

include(ROOT . '/view/front/art.html');