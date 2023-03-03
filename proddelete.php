<?php
session_start();
require("поменяй.php");
header('Content-Type: text/html; charset=utf-8');
if (isset($_POST["prodid"])) {
    $prodid = $connect->real_escape_string($_POST["prodid"]);
    $sql = "DELETE FROM comments WHERE id = '$prodid'";
    if ($connect->query($sql)) {
    } else {
        echo "Ошибка: " . $connect->error;
    }
    echo "<script>alert('Комментарий удален упешно! XD')</script>";
    echo "<script>history.back()</script>";
}
