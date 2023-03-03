<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");

?>
<?php
$back = "<script>history.back()</script>";
if (!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['phone'])) {
  $name = $_POST['name'];
  $mail = $_POST['email'];
  $phone = $_POST['phone'];
  mail(
    $mail,
    "Письмо от интернет-магазина derevo",
    "Ваш заказ принят в обработку, в скором времени с вами свяжется менеджер",
    "Content-Type: text/html; charset=utf-8"
  );
  echo "<script>alert('Ваше сообщение успешно отправлено!')</script>";
  echo $back;
  exit;
} else {
  echo "<script>alert('Для отправки сообщения заполните все поля!')</script>";
  echo $back;
  exit;
}
?>