<?php
include "ss.php";
include "rand.php";
@ini_set('display_errors', 0);
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('GMT');
$line = date('Y-m-d H:i:s') . " - $_SERVER[REMOTE_ADDR]";
file_put_contents('V1.txt', $line . PHP_EOL, FILE_APPEND);
?>
