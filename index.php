<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14
 * Time: 16:02
 */

include ('./lib/init.php');
$sql = 'select art_id,cat_id,user_id,nick,pubtime,title,content from art order by art_id desc';
$art = mGetAll($sql);

$sql = 'select * from cat';
$cat = mGetAll($sql);

include (ROOT.'./view/front/index.html');