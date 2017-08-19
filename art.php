<?php
include ('./lib/init.php');
$art_id = $_GET['art_id'];
$sql = 'select title,content,pubtime,catname,comm from art left join cat on art.cat_id=cat.cat_id where art_id='.$art_id;
$art = mGetRow($sql);
if (empty($art)){
    header('Location:index.php');
    exit;
}
$sql = 'select * from cat';
$Cat = mGetAll($sql);
include (ROOT.'/view/front/art.html');