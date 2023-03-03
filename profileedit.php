<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require("bd.php");
if (isset($_POST["userid"])) {
    $userid = $_SESSION['id'];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $sql = mysqli_query($link, "UPDATE users SET name = '$name', surname = '$surname', email = '$email', phone = '$phone' WHERE id = $userid");
    echo "<script>alert('Профиль редактирован упешно!')</script>";
    echo "<script>window.location = 'profile.php'</script>";
}
