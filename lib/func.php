<?php
/**
 * 成功返回的信息
 */
function succ($res){
    $result = 'succ';
    include (ROOT.'/view/admin/info.html');
    exit;
}
/**
 * 失败返回的报错信息
 */

function error($res){
    $result = 'fail';
    include (ROOT.'/view/admin/info.html');
    exit;
}

/**
 * @param int $num 文章总数
 * @param int $curr 当前显示的页码数      $curr-2 $curr-1 $curr $curr+1 $curr+2
 * @param int $cnt 每页显示的条数
 * @return arr
 *
 */
function getPage($num,$curr,$cnt) {
    //最大的页码数
    $max = ceil($num/$cnt);
    //最左侧页码
    $left = max(1 , $curr-2);

    //最右侧页码
    $right = min($left+4 , $max);

    $left = max(1 , $right-4);

    /*	(1 [2] 3 4 5) 6 7 8 9
        1 2 (3 4 [5] 6 7) 8 9
        1 2 3 4 (5 6 7 [8] 9)*/
    $page = array();
    for($i=$left;$i<=$right;$i++) {
        $_GET['page'] = $i;
        $page[$i] = http_build_query($_GET);
    }

    return $page;
}


/**
 * 获取来访者ip
 * @return array|false|null|string
 *
 */
function getIp(){
    static $realip = null;
    if ($realip !== null){
        return $realip;
    }
    if(getenv('HTTP_X_FORWARDED_FOR')){
        $realip = getenv('HTTP_X_FORWARDED_FOR');
    }elseif (getenv('HTTP_CLIENT_IP')){
        $realip = getenv('HTTP_CLIENT_IP');
    }else{
        $realip = getenv('REMOTE_ADDR');
    }
    return $realip;
}

/**
 * 按日期创建存储目录
 *
 */
function createDir(){
    $path = '/upload'.date('Y/m/d');

    $abs = ROOT . $path;
    if(is_dir(abs)||mkdir($abs,007,true)){
        return $path;
    }else{
        return false;
    }
}

/**
 * @param int $length
 * @return bool|string
 * 生成随机字符串
 */
function randStr($length = 6){
    $str = str_shuffle('qwertyuipasdfghjklzxcvbnmQWERTYUIPASDFGHJKLZXCVBNM23456789');
    $str = substr($str,0,$length);
    return $str;
}

/**
 * @param $name
 * @return string
 * 获取文件后缀
 */
function getExit($name){
    return strrchr($name,'.');
}
