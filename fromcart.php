<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");
error_reporting(E_ERROR | E_PARSE);
?>
<?php
foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $_GET['id']) {
        unset($_SESSION['cart'][$key]);
    }
}
?>