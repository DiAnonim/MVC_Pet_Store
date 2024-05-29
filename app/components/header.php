<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зоо Магазин</title>
    <link rel="stylesheet" href="/mvc/css/style.css">
</head>

<body>
    <header class="header">
        <a href="/mvc" style="color: rgb(124, 128, 237); position: relative; right: 350px">Зоо Магазин</a>
        <a href="/mvc/items/">Все Товары</a>
        <?php
        if (isset($_SESSION['user'])) {
            echo "<a href='/mvc/basket'>Корзина</a>";
            echo "<a href='/mvc/user/'>Профиль</a>";
        } else {
            echo "<a href='/mvc/user/registration/'>Регистрация</a>/<a href='/mvc/user/login'>Вход</a>";
        }
        ?>
    </header>
</body>

</html>