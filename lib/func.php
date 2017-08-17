<?php
/**
 * @param string $msg 成功返回的信息
 */
function succ($msg='成功'){
    $res = 'success';
    include (ROOT.'/view/admin/info.html');
    exit;
}
/**
 * @panram string $msg 失败返回的报错信息
 */

function error($msg='失败'){
    $res='fail';
    include (ROOT.'/view/admin/info.html');
    exit;
}