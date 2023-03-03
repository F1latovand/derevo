<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require("bd.php");
$idtov = $_POST['tovarid'];
if(isset($_POST['tovarid'])){
    foreach($_SESSION['cart'] as $key => $value){
        if($value == $idtov){
            unset($_SESSION['cart'][$key]);
        }
    }
    // header('location: index.php');
    echo "<script>history.back()</script>";
}
