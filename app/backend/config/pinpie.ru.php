<?php
$debug = false;
$pinpie['page not found'] = 'pagenotfound.php';
$pinpie['static folder'] = '/app/static';
$static_servers = [
  's0.' . $pinpie['site url'],
  's1.' . $pinpie['site url'],
  's2.' . $pinpie['site url'],
];
$pinpie['cache type'] = 'apc';
//$pinpie['cache type'] = 'files';