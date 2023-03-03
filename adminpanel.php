<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");
?>
<?php
if (!isset($_SESSION['login'])) {
  echo "<script>alert('Извините, у вас нет прав.')</script>";
  echo "<script>window.location = 'index.php'</script>";
?>
  <?php
} else {
  if ($_SESSION['login'] == 'admin') {
  ?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="UTF-8">
      <meta name="viewpoint" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="style.css">
      <link rel="shortcut icon" href="image/icon.ico" type="image/x-icon">
      <title>Derevo</title>
    </head>

    <body>
      <div class="header">
        <div class="logo"><a href="index.php"><img src="image/logo.png" width="200" height="60"></a></div>
        <div class="src">
          <form action="search.php" method="post" class="src">
            <input type="text" placeholder="Поиск по сайту" name="search">
          </form>
        </div>
        <div class="cart">
          <a href="adminpanel.php" style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Админ панель</a>
          <form action="exit.php" method="post">
            <input style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;" type="submit" name="exit" value="Выйти">
          </form>
        </div>
      </div>
      <hr>
      <div class="block2">
        <div class="nav">
          <div class="dropdown">
            <button class="dropbtn"><b>Диваны</b></button>
            <div class="dropdown-content">
              <a href="divani/divani-krovati.php">Диваны-кровати</a>
              <a href="divani/pryamie.php">Прямые</a>
              <a href="divani/uglovie.php">Угловые</a>
            </div>
          </div>
          <div class="btn">
            <div class="dropdown">
              <button class="dropbtn"><b>Кровати</b></button>
              <div class="dropdown-content">
                <a href="krovati/krovati-dvuspalnie.php">Двуспальные</a>
                <a href="krovati/krovati-odnospalnie.php">Односпальные</a>
              </div>
            </div>
          </div>
          <div class="btn">
            <div class="dropdown">
              <button class="dropbtn"><b>Шкафы</b></button>
              <div class="dropdown-content">
                <a href="shkafi/shkafi-kupe.php">Шкафы-купе</a>
                <a href="shkafi/shkafi-raspashnie.php">Распашные</a>
                <a href="shkafi/shkafi-uglovie.php">Угловые</a>
              </div>
            </div>
          </div>
          <div class="btn">
            <div class="dropdown">
              <button class="dropbtn"><b>Стенки</b></button>
              <div class="dropdown-content">
                <a href="stenki/stenki.php">Стенки</a>
              </div>
            </div>
          </div>
          <div class="btn">
            <div class="dropdown">
              <button class="dropbtn"><b>Каталог</b></button>
              <div class="dropdown-content">
                <a href="catalog/catalog.php">Каталог</a>
              </div>
            </div>
          </div>
        </div>
        <hr>
      </div>
      <div class="use">
        <h2>Список пользователей</h2>
        <div class="users">
          <?php
          $sql = "SELECT * FROM users";
          if ($result = $link->query($sql)) {
          ?>
            <table border=3px solid black>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th></th>
              </tr>
              <?php foreach ($result as $row) { ?>
                <tr>
                  <td><?= $row["id"] ?></td>
                  <td><?= $row["login"] ?></td>
                  <td>
                    <form action='delete.php' method='post'>
                      <input type='hidden' name='id' value='<?= $row["id"] ?>' />
                      <?php if ($row['login'] == 'admin') {
                      } else { ?>
                        <input class='pagstyle' type='submit' value='Удалить'>
                      <?php } ?>
                    </form>
                  </td>
                </tr>
              <?php } ?>
            </table>
          <?php } ?>
          <hr>
        </div>
        <h2>Добавить товар</h2>
        <div class="addproduct">
          <form action="addtobd.php" method="post" enctype="multipart/form-data">
            <table>
              <tr>
                <td>Наименование:</td>
                <td><input class="validinput" type="text" name="title"></td>
              </tr>
              <tr>
                <td>Цена:</td>
                <td><input class="validinput" type="text" name="price" size="3"> руб.</td>
              </tr>
              <tr>
                <td>Название изображения:</td>
                <td><input class="validinput" type="file" name="img"></td>
              </tr>
              <tr>
                <td>Категория:</td>
                <td><select class="" name="category">
                    <option value="divan">Диван</option>
                    <option value="krovat">Кровать</option>
                    <option value="shkaf">Шкаф</option>
                    <option value="stenk">Стенка</option>
                  </select></td>
              </tr>
              <tr>
                <td>Подкатегория:</td>
                <td>
                  <select class="" name="sub_category">
                    <option value="divan-krovat">Диван-кровать</option>
                    <option value="divan-uglovoy">Диван угловой</option>
                    <option value="divan-pryamoy">Диван прямой</option>
                    <option value="krovat-dvuspalniy">Кровать двуспальная</option>
                    <option value="krovat-odnospalniy">Кровать односпальная</option>
                    <option value="shkaf-kupe">Шкаф-купе</option>
                    <option value="shkaf-raspashnoy">Шкаф распашной</option>
                    <option value="shkaf-uglovoy">Шкаф угловой</option>
                    <option value="stenk">Стенка</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Описание:</td>
                <td><textarea class="validinput" type="text" name="description"></textarea></td>
              </tr>
              <tr>
                <td><input class="pagstyle" type="submit" name="upload" value="Добавить товар"></td>
              </tr>
            </table>
          </form>
          <h4><a href="products.php">Список всех товаров</a></h4>
        </div>
      </div>
      <hr>
      <div class="footer">
        <div class="pokupatelyam">
          <b>Покупателям<br /><br /></b>
          <br />
          <a href="tobyers/delivery.php">Доставка</a><br /><br />
          <a href="tobyers/guarantee.php">Гарантия</a><br /><br />
        </div>
        <div class="companiya">
          <b>Компания<br /><br /></b>
          <br />
          <a href="tobyers/about.php">О компании</a><br /><br />
          <a href="tobyers/contacts.php">Контакты</a><br /><br />
        </div>
        <div class="catalog">
          <b>Каталог<br /><br /></b>
          <br />
          <a href="divani/divani-krovati.php">Диваны</a><br /><br />
          <a href="krovati/krovati.php">Кровати</a><br /><br />
          <a href="stenki/stenki.php">Стенки</a><br /><br />
          <a href="shkafi/shkafi.php">Шкафы</a><br /><br />
        </div>
        <div class="mobila">
          8 (3333) 22-33-44
        </div>
        <div class="socialki">
          <a href="https://instagram.com"><img width="40" height="40" src="image/inst.png"></a>
          <a href="https://vk.com"><img width="35" height="35" src="image/vk.png"></a>
          <a href="https://twitter.com"><img width="40" height="40" src="image/twit.png"></a>
          <a href="https://www.youtube.com"><img width="40" height="40" src="image/yout.png"></a>
        </div>
      </div>
    </body>

    </html>
<?php
  } else {
    echo "<script>alert('Извините, у вас нет прав.')</script>";
    echo "<script>window.location = 'index.php'</script>";
  }
}
?>