<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14
 * Time: 16:02
 */
//获取文章列表
include ('./lib/init.php');

//判断地址栏是否有cat_id
if(isset($_GET['cat_id'])){
    $where = " and art.cat_id=$_GET[cat_id]";
}else{
    $where ='';
}
//获取栏目信息
$sql = 'select cat_id,catname from cat';
$cats = mGetAll($sql);

$sql = "select art_id,title,content,pubtime,comm,catname from art inner join cat on art.cat_id=cat.cat_id where 1" . $where;
$art = mGetAll($sql);

//print_r($art);exit();

include (ROOT.'./view/front/index.html');
