<section>
    <?php
    require_once "app/components/heading.php";
    require_once "app/components/product_card.php";
    display_heading("Ваша корзина");
    ?>
    <div class="basket">
        <?php
        if (!empty($items["products"])) {
            foreach ($items["products"] as $item) {
                $product = $item['product'];
                product_card_basket(
                    $product['product_id'],
                    $product['product_name'],
                    $product['product_price'],
                    $product['product_photo_link'],
                    $product['product_description'],
                    $item['quantity'],
                    "product-card"
                );
                ?>
                <button class="delete-button" data-product-id="<?php echo $product['product_id']; ?>">Удалить</button>
                <?php
            }
        } else {
            display_subheading("Ваша корзина пуста, пожалуйста, добавьте что-нибудь в нее", "/mvc/items");
        }
        ?>
    </div>
    <script></script>
</section>