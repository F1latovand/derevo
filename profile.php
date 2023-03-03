<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once("bd.php");
?>
<?php
if (isset($_SESSION['login'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewpoint" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="image/icon.ico" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <title>Derevo</title>
    </head>

    <body>
        <div class="header">
            <div class="logo"><a href="index.php"><img src="image/logo.png" width="180" height="60"></a></div>
            <div class="src">
                <form action="search.php" method="post" class="src">
                    <input type="text" placeholder="Поиск по сайту" name="search">
                </form>
            </div>
            <div class="cart">
                <?php
                if ($_SESSION['login'] == 'admin') {
                ?>
                    <a href="adminpanel.php" style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Админ панель</a>
                <?php
                }
                ?><br />
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

        <?php
        $userid = $_SESSION['id'];

        $result = mysqli_query($link, "SELECT * FROM users WHERE id='$userid'");
        $user = mysqli_fetch_assoc($result);
        ?>
        <script>
            $(function() {
                $("#phone").mask("+7(999) 999-99-99");
            });
        </script>
        <div class="use">
            <h2>Ваши данные</h2>
            <div class="profedit">
                <form action="profileedit.php" method="post">
                    <input type="hidden" name="userid" value="<?= $userid ?>">
                    <input class="validinput" type="text" name="name" value="<?= $user['name'] ?>" placeholder="Имя" maxlength="255">
                    <input class="validinput" type="mail" name="email" value="<?= $user['email'] ?>" placeholder="Почта" maxlength="255"><br><br>
                    <input class="validinput" type="text" name="surname" value="<?= $user['surname'] ?>" placeholder="Фамилия" maxlength="255">
                    <input class="validinput" type="tel" name="phone" id="phone" value="<?= $user['phone'] ?>" placeholder="Телефон"><br>
                    <input id="pagstyle" type="submit" name="submit" value="Сохранить">
                </form>
            </div><br>
            <div class="passedit">
                <form action="passedit.php" method="post">
                    <input type="hidden" name="userid" value="<?= $userid ?>">
                    <input class="validinput" type="password" name="oldpass" placeholder="Старый пароль" maxlength="255"><br><br>
                    <input class="validinput" type="password" name="newpass" placeholder="Новый пароль" maxlength="255"><br>
                    <input id="pagstyle" type="submit" name="submit" value="Изменить пароль">
                </form>
            </div>
        </div>
        <hr>
        <div class="use">
            <h2>Корзина</h2>
            <?php
            if (empty($_SESSION['cart'])) {
            ?>
                <span style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Ваша корзина пуста!</span>
            <?php
            } else {
            ?>
                <a href="cartclear.php" class="clearcart" style="color: grey;">Очистить корзину</a>
                <hr>
                <span style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Количество товаров в корзине:
                    <?php echo count($_SESSION['cart'], COUNT_RECURSIVE) ?></span>
                <hr>
                <?php foreach ($_SESSION['cart'] as $arr) : ?>
                    <?php $sql = "SELECT * FROM products WHERE `id` = $arr"; ?>
                    <?php if ($result = $link->query($sql)) : ?>
                        <?php foreach ($result as $row) : ?>
                            <div id="image">
                                <div class="cartelement">
                                    <a href="?id=<?= $row['id'] ?>&#win3"><img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $row['img'] ?>"></a></br>




                                    <a href="#x" class="overlay" id="win3"></a>
                                    <div class="popup" id="popka">
                                        <?php $id = $_GET['id'] ?>
                                        <?php $sql = "SELECT * FROM products WHERE `id` = $id"; ?>
                                        <?php if ($result = $link->query($sql)) : ?>
                                            <?php foreach ($result as $row) : ?>
                                                <h2><?php echo $row['title'] ?></h2>
                                                <hr>
                                                <div class='image'>
                                                    <img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $row['img'] ?>"></br></br></br>
                                                    <hr>
                                                    <h3>Описание товара</h3>
                                                    <h5><?= $row['description'] ?></h5>
                                                    <hr>
                                                    <a id="cart_text"><?= $row['price'] ?> Руб.</a></br>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>




                                    <a id="cart_text"><?= $row['title'] ?></a>
                                    <a id="cart_text"><?= $row['price'] ?> Руб.</a></br>
                                    <form action="cartdelete.php" method="post">
                                        <input type="hidden" name="tovarid" value="<?= $row['id'] ?>">
                                        <input class="pagstyle" type="submit" value="Удалить">
                                    </form>
                                </div>
                                <hr>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php
                if (!empty($_SESSION['cart'])) {
                ?>
                    <a href="tobyers/delivery.php" class="delivery" style="color: grey;">Оформить доставку</a>
                <?php
                }
                ?>
            <?php
            }
            ?>
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
    echo "<script>alert('Извините, вы не авторизованы')</script>";
    echo "<script>window.location = 'index.php'</script>";
}
?>