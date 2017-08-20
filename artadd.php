<?php

include('./lib/init.php');

//从数据库中取出栏目
$sql = 'select * from cat ';
$cats = mGetAll($sql);
//print_r($cats);exit();

if (empty($_POST)) {
    include(ROOT . '/view/admin/artadd.html');
} else {
    //检测标题
    $art['title'] = trim($_POST['title']);
    if (empty($art['title'])) {
        error('标题不能为空');
    }
    //检测栏目
    $art['cat_id'] = $_POST['cat_id'];
    if (!is_numeric($art['cat_id'])) {
        error('栏目不合法');
    }
//检测内容
    $art['content'] = trim($_POST['content']);
    if (empty($art['content'])) {
        error('内容不能为空');
    }
    //如果有上传图片,且上传成功
    //判断是否有图片上传 且 error 是否为0
    if( !($_FILES['pic']['name'] == '' ) && $_FILES['pic']['error'] == 0) {
        $filename = createDir() . '/' . randStr() . getExt($_FILES['pic']['name']);
        if(move_uploaded_file($_FILES['pic']['tmp_name'], ROOT .  $filename)){
            $art['pic'] = $filename;
        }
    }
//文章发布时间
    $art['pubtime'] = time();

//发布文章
    if (!mExec('art', $art)) {
        error('文章发布失败');
    } else {
        $art['tag']=trim($_POST['tag']);
        if (empty($art['tag'])){
            $sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
            mQuery($sql);
            succ('文章添加成功');
        }else{
            $art_id = getListId();
            //索引数组
            $tag = explode(',',$art['tag']);
//            print_r($tag);
            $sql= "insert into tag(art_id,tag) value";

            foreach ($tag as $v){
                $sql.="(".$art_id.",'".$v."')";
                $sql=rtrim($sql,",");
                if(mQuery($sql)){
                    $sql="update cat set num=num+1 where cat_id=$art[cat_id]";
                    mQuery($sql);
                    succ('文章添加成功');
                }else{
                    //tag添加失败,删除原文章
                    $sql='delete from art where art_id=$art_id';
                    if (mQuery($sql)){
                        $sql = "update cat set num=num-1 where cat_id=$art[cat_id]";
                        mQuery($sql);
                        error('标签插入失败');
                    }
                }
            }

        }
    }
}

