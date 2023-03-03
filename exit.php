<?php 
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    require_once("bd.php");
?>
<?php
    unset($_SESSION['login']);
    session_destroy();
    header('location: index.php');
?>