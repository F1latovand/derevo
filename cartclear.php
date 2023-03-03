<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");
?>
<?php
$_SESSION['cart'] = array();
header('location: index.php');
?>