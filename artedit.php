<?php
include('./lib/init.php');
$art_id = $_GET['art_id'];
if (empty($_POST)) {
    $sql = 'select * from art where art_id=' . $art_id;
    $art = mGetRow($sql);
    $sql2 = 'select * from cat';
    $cat = mGetAll($sql2);

    //取出tag
    $sql3 = 'select tag from tag where art_id='.$art_id;
    $tag = mGetAll($sql3);
    $tags = '';
    foreach ($tag as $t){
        $tags .=$t['tag'].',';
    }
    $tags = rtrim($tags,',');
    include (ROOT.'/view/admin/artedit.html');
}else{
    //检测art_id是否为数字
    if(!is_numeric($art_id)){
        error('参数有误');
    }
    //检测标题是否为空
    $art['title'] = trim($_POST['title']);
    if(empty($art['title'])){
        error('标题不能为空');
    }
    //检测栏目
    $art['cat_id'] = $_POST['cat_id'];
    if(!is_numeric($art['cat_id'])){
        error('栏目不为数字');
    }
    //检测内容
    $art['content']=trim($_POST['content']);
    if(empty($art['content'])){
        error('内容不能为空');
    }
    //查询是否有这篇文章
    $sql = 'select count(*) from art where art_id='.$art_id;
    //没有这篇文章
    if(!mGetOne($sql)){
        error(mysqli_error());
    }
    $art['lastup'] = time();
    $art['arttag'] = trim($_POST['tag']);
    //发布文章
    if(!mExec('art',$art,'update','art_id='.$art_id)){
        error('文章修改失败');
    }else{
        //判断如果没有tag,无则文章修改成功
        $tag = trim($_POST['tag']);
        if (empty($tag)){
            succ('文章修改成功');
        }else{
            //直接删除原标签 重新添加新标签
            $sql = 'delete from tag where art_id ='.$art_id;
            mQuery($sql);

            //添加新标签
            $tag = explode(',',$tag);
            $sql ="insert into tag(art_id,tag) values";

            foreach ($tag as $v) {
                $sql .="(".$art_id.",'".$v."'),";
            }
            $sql = rtrim($sql,',');
            if (mQuery($sql)){
                succ('文章修改成功');
            }
        }
    }

}