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
    exit("<script>alert('Вы ввели не всю информацию, вернитесь назад и заполните все поля!'); window.location = 'index.php'</script>");
}
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$login = trim($login);
$password = trim($password);
$password = md5($password);
$result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
$myrow = mysqli_fetch_array($result);
if (empty($myrow['password'])) {
    exit("<script>alert('Извините, введённый вами логин или пароль неверный.'); window.location = 'index.php'</script>");
} else {
    if ($myrow['password'] == $password) {
        $_SESSION['login'] = $myrow['login'];
        $_SESSION['id'] = $myrow['id'];
        $_SESSION['cart'] = array();
        header('location: index.php');
    } else {
        exit("<script>alert('Извините, введённый вами логин или пароль неверный.'); window.location = 'index.php'</script>");
    }
}
?>