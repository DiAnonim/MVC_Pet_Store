<section>
    <?php
    // Подключение компонента отображения заголовка и вызов функции display_heading 
    require_once "app/components/product_card.php";
    require_once "app/components/heading.php";
    display_heading("Все Товары");
    ?>

    <!-- Проверка наличия авторизованного пользователя с ролью "админ", и вывод ссылки для добавления нового товара -->
    <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] == "admin"): ?>
        <div class="login">
            <a href="/mvc/items/create">Добавить Товар</a>
        </div>
    <?php endif; ?>

    <!-- вывод списка товаров -->
    <div class="products">
        <?php foreach ($items as $item): ?>
            <div class="product-card">
                <img src='<?= $item['product_photo_link'] ?>' alt=' '>
                <h3><?= $item['product_name'] ?></h3>
                <?php if ($item['product_count'] > 0): ?>
                    <p><?= $item['product_description'] ?></p>
                    <p class='price'><?= $item['product_price'] ?> €</p>
                    <a href='/mvc/items/id<?= $item['product_id'] ?>'>Подробнее</a>
                <?php else: ?>
                    <p style='color: red;'>Товар закончился</p>
                <?php endif; ?>

                <!-- Проверка наличия авторизованного пользователя с ролью "админ", и вывод формы для удаления -->
                <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == "admin"): ?>
                    <form action="" method="post">
                        <input type="hidden" name="delete" value="<?= $item['product_id'] ?>">
                        <button class="button" style="width: 100%;" type="submit">Удалить</button>
                    </form>
                    
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
</section>