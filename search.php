<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require("bd.php");
require("tocart.php");
error_reporting(E_ERROR | E_PARSE);
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
?>
<?php
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
    </form>
    <div class="header">
        <div class="logo"><a href="index.php"><img src="image/logo.png" width="180" height="60"></a></div>
        <div class="src">
            <form action="search.php" method="post" class="src">
                <input type="text" placeholder="Поиск по сайту" name="search">
            </form>
        </div>
        <?php if (isset($_SESSION['login'])) { ?>

            <div class="cart">
                <?php
                if ($_SESSION['login'] == 'admin') {
                ?>
                    <a href="adminpanel.php" style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Админ панель</a>
                <?php
                }
                ?><br />
                <a href="profile.php" style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Профиль</a><br>
                <a href="#win2" class="button button-green" style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Корзина</a>
                <a href="#x" class="overlay" id="win2"></a>
                <div class="popup" id="popka">
                    <h2>Корзина</h2>
                    <?php
                    if (empty($_SESSION['cart'])) {
                    ?>
                        <hr>
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
                                            <img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $row['img'] ?>"></br>
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
                    }
                    ?>
                    <?php
                    if (!empty($_SESSION['cart'])) {
                    ?>
                        <a href="tobyers/delivery.php" class="delivery" style="color: grey;">Оформить доставку</a>
                    <?php
                    }
                    ?>
                </div>
                <form action="exit.php" method="post">
                    <input style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;" type="submit" name="exit" value="Выйти">
                </form>
            </div>
        <?php } else { ?>
            <div class="cart">
                <a href="#win1" class="button button-green" style="font-family: Century Gothic;background-color: #ffffff;padding: 0px;font-size: 20px;border: none;color: grey;font-weight:bold;">Вход</a>
                <a href="#x" class="overlay" id="win1"></a>
                <div class="popup" id="vhodpopup">
                    <section class="modal_form" id="formas">
                        <input type="radio" id="aut" name="rad" value="aut">
                        <input type="radio" id="reg" checked name="rad" value="reg">

                        <div class="for">
                            <div id="reg" class=" form">
                                <form action="save_user.php" method="post" align="center">
                                    <h2>Регистрация</h2>
                                    <p>
                                        <input class="validinput" name="login" type="text" placeholder="Логин">
                                    </p>
                                    <p>
                                        <input class="validinput" name="password" type="password" placeholder="Пароль">
                                    </p>
                                    <p>
                                        <input class="pagstyle" type="submit" name="submit" value="Зарегистрироваться">
                                    </p>
                                </form>
                                <div class="rad">
                                    <ul id="forma">
                                        <li>

                                            <div class="label"><label for="reg" id="reg">
                                                    <h4 align="center" class="bord">Авторизация</h4>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="for">
                            <div id="aut" class=" form">
                                <form action="testreg.php" method="post" align="center">
                                    <h2>Авторизация</h2>
                                    <p>
                                        <input class="validinput" name="login" type="text" placeholder="Логин">
                                    </p>
                                    <p>
                                        <input class="validinput" name="password" type="password" placeholder="Пароль">
                                    </p>
                                    <p>
                                        <input class="pagstyle" type="submit" name="submit" value="Войти">
                                    </p>
                                    <div class="rad">
                                        <ul id="forma">
                                            <li>
                                                <div class="label"> <label for="aut" id="aut">
                                                        <h4 align="center" class="bord">Нет аккаунта?</h4>
                                                    </label></div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>
    </div>
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
    <div class="best_text">Результат поиска</div>
    <div class="best">
        <?php
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $prods = mysqli_query($link, "SELECT * FROM products WHERE title LIKE '%$search%'");
        }
        $prods;
        if (mysqli_num_rows($prods) > 0 && !empty($search)) {
            while ($prod = mysqli_fetch_assoc($prods)) {
        ?>
                <div class='image'>
                    <a href="?id=<?= $prod['id'] ?>&#win3"><img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $prod['category'] ?>i/<?= $prod['img'] ?>"></a></br>



                    <a href="#x" class="overlay" id="win3"></a>
                    <div class="popup" id="popka">
                        <?php $id = $_GET['id'] ?>
                        <?php $sql = "SELECT * FROM products WHERE `id` = $id"; ?>
                        <?php if ($result = $link->query($sql)) : ?>
                            <?php foreach ($result as $wor) : ?>
                                <h2><?php echo $wor['title'] ?></h2>
                                <hr>
                                <div class='image'>
                                    <img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $wor['category'] ?>i/<?= $wor['img'] ?>"></br></br></br>
                                    <hr>
                                    <h3>Описание товара</h3>
                                    <h5><?= $wor['description'] ?></h5>
                                    <hr>
                                    <a id="cart_text"><?= $wor['price'] ?> Руб.</a></br>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>



                    <a class="titletext"><?= $prod['title'] ?></a></br>
                    <a><?= $prod['price'] ?> Руб.</a></br>
                    <?php
                    if (isset($_SESSION['login'])) { ?>
                        <form action="tocart.php" method="post">
                            <input type="hidden" name="addid" value="<?= $prod['id'] ?>">
                            <input class="pagstyle" type="submit" value="Добавить в корзину">
                        </form>
                    <?php
                    } else {
                    ?>
                        <a style="word-break:break-all; font-size: 14px;">Авторизуйтесь, чтобы добавить товар в корзину</a>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <h4>Ничего не найдено!</h4>
        <?php } ?>
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