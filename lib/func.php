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