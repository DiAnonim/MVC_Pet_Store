<section>
    <?php
    require_once "app/components/product_card.php";
    require_once "app/components/heading.php";
    display_heading("Все Товары");
    ?>
    <div class="products">
        <?php foreach ($items as $item): ?>
            <?php product_card($item['product_id'], $item['product_name'], $item['product_price'], $item['product_photo_link'], $item['product_description'], $item['product_count'], "product-card"); ?>
        <?php endforeach; ?>
    </div>
</section>
