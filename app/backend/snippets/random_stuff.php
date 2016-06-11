<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (empty($_SESSION['random_stuff'])) {
  $_SESSION['random_stuff'] = random_bytes(127);
  for ($i = strlen($_SESSION['random_stuff']); $i--;) {
    $chr = $_SESSION['random_stuff'][$i];
    $chr = ord($chr) % 95 + 32;
    $_SESSION['random_stuff'][$i] = chr($chr);
  }
  $_SESSION['random_stuff'] = str_replace(['"', "\n", "\r"], ['\\"', '-', '-'], $_SESSION['random_stuff']);
}

echo h($_SESSION['random_stuff']);