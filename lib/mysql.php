<?php
/**
 * mysql.php mysql操作的系列函数
 * @author Hider
 */

/**
 * 连接数据库
 * @return resource 成功返回一个资源
 */

function mConn(){
    //静态变量似的mConn在同一页面 数据库值只连接一次
    static $conn = null;
    if ($conn===null){
        $conn = mysqli_connect('localhost','root','','blog');
        mysqli_query($conn,'set names utf8');
        mysqli_query($conn, "set character set 'utf8'");
    }
    return $conn;
}

/**
 * 执行sql语句
 *
 * @param  string $sql
 * @return mixed 返回布尔值类型/资源
 */
function mQuery($sql){
    return mysqli_query(mConn(),$sql);
}

/**
 * 查询select语句并返回多行,适用于查多条数据
 * @param string $sql select语句
 * @return mixed array 查询到返回二位数组,未查到返回false
 */