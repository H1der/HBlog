<meta charset="set8">
<?php
//连接数据库
$conn = mysqli_connect('localhost', 'root', '', 'blog');
mysqli_query($conn,'set name utf8');

$sql = 'select * from cat';
$rs = mysqli_query($conn,$sql);

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

include ('./view/admin/catlist.html');