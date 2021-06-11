<?php
include_once 'code.php';
include_once 'subject.php';
$sessionname="code";
$sessionnamee="subject";
session_start(); 
if (!isset($_SESSION[$sessionname])){
    $_SESSION[$sessionname]=new code();
}
$verficationcode=&$_SESSION[$sessionname];


if (!isset($_SESSION[$sessionnamee])){
    $_SESSION[$sessionnamee]=new subjectlist();
}
$listsubject=&$_SESSION[$sessionnamee];
?>