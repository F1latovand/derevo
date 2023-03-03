<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require("bd.php");
if (isset($_POST["userid"])) {
    $userid = $_SESSION['id'];
    $result = mysqli_query($link, "SELECT * FROM users WHERE id='$userid'");
    $user = mysqli_fetch_assoc($result);
    $oldpass = $user['password'];
    $oldPassword = $_POST['oldpass'];
    $oldPassword = md5($oldPassword);
    $newPassword = $_POST['newpass'];
    $newPassword = md5($newPassword);
    if ($oldPassword == $oldpass) {
        mysqli_query($link, "UPDATE users SET password='$newPassword' WHERE id='$userid'");
        echo "<script>alert('Пароль успешно изменен!')</script>";
        echo "<script>window.location = 'profile.php'</script>";
    } else {
        echo "<script>alert('Старый пароль введен не верно!')</script>";
        echo "<script>window.location = 'profile.php'</script>";
    }
}
