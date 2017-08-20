<?php

include ('./lib/init.php');
$art_id = $_GET['art_id'];
$sql = 'delete from art where art_id ='.$art_id;
if (!mQuery($sql)){
    error('文章删除失败');
}else{
    header('Location:artlist.php');
}