<section>
    <?php
    // Подключаем необходимые компоненты
    require_once "app/components/heading.php";

    // Проверяем наличие результатов поиска
    display_heading("Результаты поиска");
    if (empty($search_items)) {
        echo "<p style='color: red; margin-left: 450px;'>Извините, по вашему запросу ничего не найдено.</p>";
    } else {
        // Выводим результаты поиска
        echo '<div class="products">';
        foreach ($search_items as $item) { ?>
            <div class="product-card">
                <img src='<?= $item['product_photo_link'] ?>' alt=' '>
                <h3><?= $item['product_name'] ?></h3>
                <?php if ($item['product_count'] > 0): ?>
                    <p><?= $item['product_description'] ?></p>
                    <p class='price'><?= $item['product_price'] ?> €</p>
                    <a href='/mvc/items/id<?= $item['product_id'] ?>'>Details</a>
                <?php else: ?>
                    <p style='color: red;'>Товар закончился</p>
                <?php endif; ?>
            </div>
            <?php
        }
        echo '</div>';
    }
    ?>
</section>