<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");
error_reporting(E_ERROR | E_PARSE);
?>
<?php
if (isset($_SESSION['cart'])) {
    if (in_array($_POST['addid'], $_SESSION['cart'])) {
        echo "<script>alert('Товар уже находится в корзине')</script>";
        echo "<script>window.location = 'index.php'</script>";
    } else {
        if ($_POST['addid']) {
            $idtov = $_POST['addid'];
            $_SESSION['cart'][] = $idtov;
            echo "<script>window.location = 'index.php'</script>";
        }
    }
}