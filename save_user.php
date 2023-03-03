<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");
?>
<?php
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
        unset($login);
    }
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
if (empty($login) or empty($password)) {
    echo "<script>alert('Заполните все поля!')</script>";
    echo "<script>window.location = 'index.php'</script>";
}
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$login = trim($login);
$password = trim($password);
$password = md5($password);
$result = mysqli_query($link, "SELECT id FROM users WHERE login='$login'");
$myrow = mysqli_fetch_array($result);
if (!empty($myrow['id'])) {
    exit("<script>alert('Извините, введённый вами логин уже зарегистрирован. Введите другой логин.'); window.location = 'index.php'</script>");
}
$result2 = mysqli_query($link, "INSERT INTO users (`login`, `password`, `date`) VALUES ('$login','$password', NOW())");
if ($result2) {
    header('location: index.php');
} else {
    echo "<script>alert('Ошибка! Вы не зарегистрированы.')</script>";
    echo "<script>window.location = 'index.php'</script>";
    // echo "<script>window.location = 'index.php'</script>";
}
?>