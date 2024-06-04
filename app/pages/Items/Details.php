<?php
// Подключаем необходимые компоненты
require_once "app/components/heading.php";
require_once "app/components/product_card.php";

// Отображаем заголовок страницы
display_heading("О Товаре");
?>

<section class="item-details">
    <!-- Выводим изображение товара -->
    <img src="<?= $item['product_photo_link'] ?>" alt=" ">
    <!-- Выводим название товара -->
    <h2><?= $item['product_name'] ?></h2>
    <!-- Выводим описание товара -->
    <p><?= $item['product_description'] ?></p>
    <!-- Выводим цену товара -->
    <p><?= $item['product_price'] ?> €</p>

    <?php if (isset($_SESSION['user'])): ?>
        <?php if ($item['product_count'] > 0): ?>
            <!-- Если товар в наличии, выводим информацию о его наличии -->
            <p style="color: rgb(97, 216, 97); text-shadow: 0 0 10px rgb(255, 255, 255);">В наличии:
                <?= $item['product_count'] ?></p>
            <!-- Форма для добавления товара в корзину -->
            <form action="" method="POST">
                <input type="hidden" name="add_to_cart" value="<?= $item['product_id'] ?>">
                <button class="button" type="submit">Добавить в корзину</button>
            </form>
        <?php else: ?>
            <!-- Если товара нет в наличии, выводим сообщение -->
            <p style="color: red;">Нет в наличии</p>
        <?php endif; ?>
    <?php else: ?>
        <!-- Если пользователь не авторизован, предлагаем ему войти или зарегистрироваться -->
        <p><a href="/mvc/user/login">Войдите</a> или <a href="/mvc/user/registration">зарегистрируйтесь</a>, чтобы добавлять
            в корзину</p>
    <?php endif; ?>
</section>

<?php
// Проверяем, авторизован ли пользователь
if (isset($_SESSION['user'])):
    // Отображаем заголовок для блока отзывов
    display_heading("Напишите отзыв");
    ?>
    <!-- Форма для отправки отзыва -->
    <form class="login" action="" method="POST">
        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
        <input type="text" name="review" placeholder="Оставьте ваш отзыв...">
        <button type="submit">Отправить</button>
    </form>
<?php else: ?>
    <div class="login">
        <!-- Если пользователь не авторизован, предлагаем ему войти или зарегистрироваться -->
        <p><a href="/mvc/user/login">Войдите</a> или <a href="/mvc/user/registration">зарегистрируйтесь</a>, чтобы оставлять
            отзывы</p>
    </div>
<?php endif; ?>

<section>
    <ul>
        <?php
        // Отображаем заголовок для блока отзывов
        display_heading("Отзывы");
        ?>
        <?php foreach ($reviews as $review): ?>
            <?php if ($review['product_id'] == $item['product_id']): ?>
                <?php
                // Выводим отзывы о товаре
                $user = $review['user'];
                review_card($item['product_id'], $user['username'], $review['reviews_text'], $review['created'], "review-card");
                ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</section>