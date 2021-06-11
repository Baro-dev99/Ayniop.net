<?php
include_once 'id.php';
$sessionname="id";
session_start(); 
if (!isset($_SESSION[$sessionname])){
    $_SESSION[$sessionname]=new id();
}
$idsent=&$_SESSION[$sessionname];
?>