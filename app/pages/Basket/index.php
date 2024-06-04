<section>
    <?php
    // Подключаем необходимые компоненты
    require_once "app/components/heading.php";
    display_heading("Ваша корзина");

    // Проверка наличия элементов в корзине
    if (!empty($items["products"])) { ?>

        <!-- Отображаем панель управления с общей стоимостью и кнопками "Очистить корзину" и "Оформить заказ" -->
        <div class="control-panel" style="">
            <h2>Общая стоимость: <?= $items["total_price"] ?> €</h2>
            <form action="" method="post">
                <input type="hidden" name="delete_all">
                <button class="button" type="submit">Очистить корзину</button>
            </form>
            <form action="" method="post">
                <input type="hidden" name="ordering">
                <button class="button" type="submit">Оформить заказ</button>
            </form>
        </div>

        <div class="basket">
            <!-- Отображаем товары в корзине -->
            <?php foreach ($items["products"] as $item) {
                $product = $item['product'];
                $quantity = $item['quantity']; ?>

                <div class='product-card button'>
                    <img src='<?= $product["product_photo_link"] ?>' alt=' '>
                    <h3><?= $product["product_name"] ?> x<?= $quantity ?></h3>
                    <p><?= $product["product_description"] ?></p>
                    <p class='price'><?= $product["product_price"] ?> €</p>
                    <a href='/mvc/items/id<?= $product["product_id"] ?>'>Details</a>
                    <form action="" method="post">
                        <input type="hidden" name="delete" value="<?= $product['product_id']; ?>">
                        <button class="button" type="submit">Удалить</button>
                    </form>
                </div>

            <?php }
    }
    // Если корзина пуста, выводим соответствующее сообщение
    else {
        display_subheading("Ваша корзина пуста, пожалуйста, добавьте что-нибудь в нее", "/mvc/items");
    }
    ?>
    </div>
</section>