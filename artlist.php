<?php
include ('./lib/init.php');
//使用左链接把catname查出来
$sql = 'select art.*,cat.catname from art left join cat on art.cat_id=cat.cat_id';
$art = mGetAll($sql);
//print_r($art);
include (ROOT.'/view/admin/artlist.html');