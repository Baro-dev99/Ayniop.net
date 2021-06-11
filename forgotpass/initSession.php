<?php
include_once 'code.php';
session_start();
$sessionname="code";
if (!isset($_SESSION[$sessionname])){
    $_SESSION[$sessionname]=new code();
}
$verficationcode=&$_SESSION[$sessionname];
?>