<?php

  namespace BB;
  
  if(@secure !== true)
    die('forbidden');

  \BB\module::$modules['cron'] = array(
    'name' => 'cron',
    'group' => 'app32',
    'icon' => 'fa-user',
    'custom' => true
  );
  
?>