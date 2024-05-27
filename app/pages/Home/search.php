<section>
    <?php
    require_once "app/components/product_card.php";
    require_once "app/components/heading.php";

    if (empty($search_items)) {
        display_heading("Результаты поиска");
        echo "<p style='color: red; margin-left: 450px;'>Извините, по вашему запросу ничего не найдено.</p>";
    } else {
        display_heading("Результаты поиска");
        echo '<div class="products">';
        foreach ($search_items as $item) {
            product_card($item['product_id'], $item['product_name'], $item['product_price'], $item['product_photo_link'], $item['product_description'], $item['product_count'], "product-card");
        }
        echo '</div>';
    }
    ?>
</section>