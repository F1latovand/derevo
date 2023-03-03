<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
require("bd.php");
header('Content-Type: text/html; charset=utf-8');
if (isset($_POST["id"])) {
    $userid = $link->real_escape_string($_POST["id"]);
    $sql = "DELETE FROM users WHERE id = '$userid'";
    if ($link->query($sql)) {
    } else {
        echo "Ошибка: " . $link->error;
    }
    $link->close();
    echo "<script>alert('Пользователь удален упешно!')</script>";
    echo "<script>window.location = 'adminpanel.php'</script>";
}
