<?php
include ('./lib/init.php');

$sql = 'select * from cat';
$rs = mQuery($sql);

if (!$rs){
    echo false;
}else{
    $cat = array();
    //把查询出来的内容放进一个数组里
    while ($row = mysqli_fetch_assoc($rs)){
        $cat[] = $row;
    }

//    print_r($cat);
}

include (ROOT.'/view/admin/catlist.html');