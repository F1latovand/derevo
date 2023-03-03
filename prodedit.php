<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require("bd.php");
if (isset($_POST["prodid"])) {
    $id = $_POST["prodid"];
    $title = $_POST["title"];
    $price = $_POST["price"];

    $nameFile =  $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $RegFile = time() . $nameFile;
    move_uploaded_file($tmp_name, "image/products/" . $RegFile);

    $category = $_POST["category"];
    $sub_category = $_POST["sub_category"];
    $description = $_POST["description"];
    $sql = mysqli_query($link, "UPDATE products SET title = '$title', price = '$price', img = '$RegFile', category = '$category', sub_category = '$sub_category', description = '$description' WHERE id = $id");
    echo "<script>alert('Товар редактирован упешно!')</script>";
    echo "<script>window.location = 'products.php'</script>";
}
