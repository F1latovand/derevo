<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");

if (!$link) {
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}

$nameFile =  $_FILES['img']['name'];
$tmp_name = $_FILES['img']['tmp_name'];
$RegFile = time() . $nameFile;
move_uploaded_file($tmp_name, "image/products/" . $RegFile);

if (isset($_POST["title"])) {
  $sql = mysqli_query($link, "INSERT INTO `products` (`title`, `price`, `img`, `category`, `sub_category`, `description`) VALUES ('{$_POST['title']}', '{$_POST['price']}', '$RegFile', '{$_POST['category']}', '{$_POST['sub_category']}', '{$_POST['description']}')");
  if ($sql) {
    echo "<script>alert('Товар успешно добавлен!')</script>";
    echo "<script>window.location = 'adminpanel.php'</script>";
  } else {
    echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
  }
}
?>
<?php
$sql = mysqli_query($link, 'SELECT `ID`, `title`, `price`, `img`, `category`, `sub_category`, `description` FROM `products`');
while ($result = mysqli_fetch_array($sql)) {
  echo "<script>alert('Товар успешно добавлен!')</script>";
  echo "<script>window.location = 'adminpanel.php'</script>";
}
?>


<?php
// header('Content-Type: text/html; charset=utf-8');

// if (!$link) {
//   echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
//   exit;
// }
// if (isset($_POST["title"])) {
//   $ddd = "no";
//   $sql = mysqli_query($link, "INSERT INTO `statii` (`id_user`, `title`, `stat`, `access`) VALUES ('{$_SESSION['id']}', '{$_POST['title']}', '{$_POST['stat']}', '$ddd')");
//   if ($sql) {
//     echo "<script>alert('Статья успешно отправлена!')</script>";
//     echo "<script>window.location = 'statii.php'</script>";
//   } else {
//     echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
//   }
// }
// $sql = mysqli_query($link, 'SELECT `ID`, `title`, `stat` FROM `statii`');
// while ($result = mysqli_fetch_array($sql)) {
//   echo "<script>alert('Статья успешно отправлена!')</script>";
//   echo "<script>window.location = 'statii.php'</script>";
// }
