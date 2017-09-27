<?php

session_start();

$_SESSION=array();

if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time() - 3600);
}

if(isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID', "", time() - 3600);
}

session_destroy();

echo "<script> window.top.location.href = 'http://www.ioe.pku.edu.cn'; </script>";

?>