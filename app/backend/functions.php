<?php

function h($string) {
  return htmlspecialchars($string);
}

function x($string) {
  return str_replace(['[', ']', ' '], ['&lsqb;', '&rsqb;', '&nbsp;'], $string);
}

function scx($string, $class = '') {
  return '<span><code class="' . $class . '">' . x($string) . '</code></span>';
}

function pcx($string, $class = '') {
  return '<pre><code class="' . $class . '">' . x($string) . '</code></pre>';
}

function humanBytes($size) {
  $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
  return $size ? round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}
