<?php
  require ('./lib/init.php');
  $sql = 'select * from comment order by comment_id desc';
  $comm = mGetAll($sql);

  include (ROOT.'/view/admin/commlist.html');