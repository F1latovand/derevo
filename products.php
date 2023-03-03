<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
header('Content-Type: text/html; charset=utf-8');
require("bd.php");
require("tocart.php");
?>
<?php if ($_SESSION['login'] == 'admin') { ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewpoint" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="image/icon.ico" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="best_text">Список всех товаров</div>
        <div class="best">
            <?php $sql = "SELECT * FROM products"; ?>
            <?php if ($result = $link->query($sql)) : ?>
                <?php foreach ($result as $row) : ?>
                    <div class='image'>
                        <a href="?id=<?= $row['id'] ?>&#win3"><img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $row['img'] ?>"></a></br>




                        <a href="#x" class="overlay" id="win3"></a>
                        <div class="popup" id="popka">
                            <?php $id = $_GET['id'] ?>
                            <?php $sql = "SELECT * FROM products WHERE `id` = $id"; ?>
                            <?php if ($result = $link->query($sql)) : ?>
                                <?php foreach ($result as $wor) : ?>
                                    <h2><?php echo $wor['title'] ?></h2>
                                    <hr>
                                    <div class='image'>
                                        <img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $wor['img'] ?>"></br></br></br>
                                        <hr>
                                        <h3>Описание товара</h3>
                                        <h5><?= $wor['description'] ?></h5>
                                        <hr>
                                        <a id="cart_text"><?= $wor['price'] ?> Руб.</a></br>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>




                        <hr>
                        <a class="titletext"><?= $row['title'] ?></a></br>
                        <a><?= $row['price'] ?> Руб.</a></br>
                        <hr>
                        <form action="tocart.php" method="post">
                            <input type="hidden" name="addid" value="<?= $row['id'] ?>">
                            <input class="pagstyle" type="submit" value="Добавить в корзину">
                        </form>
                        <form action="proddelete.php" method="post">
                            <input type='hidden' name='prodid' value='<?= $row['id'] ?>'>
                            <input type='hidden' name='prodimg' value='<?= $row['img'] ?>'>
                            <input class='pagstyle' type='submit' value='Удалить'>
                        </form>
                        <a href="?redid=<?= $row['id'] ?>&#win4">Редактировать</a>



                        <a href="#x" class="overlay" id="win4"></a>
                        <div class="popup" id="popka">
                            <?php $id = $_GET['redid'] ?>
                            <?php $sql = "SELECT * FROM products WHERE `id` = $id"; ?>
                            <?php if ($result = $link->query($sql)) : ?>
                                <?php foreach ($result as $row) : ?>
                                    <form action="prodedit.php" method="post" enctype="multipart/form-data">
                                        <h2><?php echo $row['title'] ?></h2>
                                        <input type="text" name="title" value="<?= $row['title'] ?>">
                                        <hr>
                                        <div class='image'>
                                            <img style="object-fit: cover; height: 100px; width: auto;" src="image/products/<?= $row['img'] ?>"></br></br></br>
                                            <input type="file" name="img" value="<?= $row['img'] ?>">
                                            <hr>
                                            <h3>Описание товара</h3>
                                            <h5><?= $row['description'] ?></h5>
                                            <textarea name="description"><?= $row['description'] ?></textarea>
                                            <hr>
                                            <a id="cart_text"><?= $row['price'] ?> Руб.</a></br>
                                            <input type="text" name="price" value="<?= $row['price'] ?>"> Руб.
                                            <h3>Категория:</h3>
                                            <?php
                                            if ($row['category'] == 'divan') {
                                                echo "Диван";
                                            } else {
                                                if ($row['category'] == 'krovat') {
                                                    echo "Кровать";
                                                } else {
                                                    if ($row['category'] == 'shkaf') {
                                                        echo "Шкаф";
                                                    } else {
                                                        if ($row['category'] == 'stenk') {
                                                            echo "Стенка";
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            -->
                                            <select class="" name="category">
                                                <option value="divan">Диван</option>
                                                <option value="krovat">Кровать</option>
                                                <option value="shkaf">Шкаф</option>
                                                <option value="stenk">Стенка</option>
                                            </select>

                                            <h3>Подкатегория:</h3>
                                            <?php
                                            if ($row['sub_category'] == 'divan-krovat') {
                                                echo "Диван-кровать";
                                            } else {
                                                if ($row['sub_category'] == 'divan-uglovoy') {
                                                    echo "Диван угловой";
                                                } else {
                                                    if ($row['sub_category'] == 'divan-pryamoy') {
                                                        echo "Диван прямой";
                                                    } else {
                                                        if ($row['sub_category'] == 'krovat-dvuspalniy') {
                                                            echo "Кровать двуспальная";
                                                        } else {
                                                            if ($row['sub_category'] == 'krovat-odnospalniy') {
                                                                echo "Кровать односпальная";
                                                            } else {
                                                                if ($row['sub_category'] == 'shkaf-kupe') {
                                                                    echo "Шкаф-купе";
                                                                } else {
                                                                    if ($row['sub_category'] == 'shkaf-raspashnoy') {
                                                                        echo "Шкаф распашной";
                                                                    } else {
                                                                        if ($row['sub_category'] == 'shkaf-uglovoy') {
                                                                            echo "Шкаф угловой";
                                                                        } else {
                                                                            if ($row['sub_category'] == 'stenk') {
                                                                                echo "Стенка";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            -->
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
                                            <input type='hidden' name='prodid' value='<?= $row['id'] ?>'>
                                            <input class='deletestyle' type="submit" value="Сохранить">
                                    </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                    </div>



        </div>
    <?php endforeach; ?>
<?php endif; ?>
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
    header('location: index.php');
}
?>