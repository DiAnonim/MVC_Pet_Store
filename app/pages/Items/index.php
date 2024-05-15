<section>
    <?php
    require_once "app/components/heading.php";
    display_heading("Все Товары");
    ?>
    <div>
        <?php
        require_once "app/components/product_card.php";

        product_card("Товар 1", "$50", "https://example.com/product1.jpg", "Описание товара 1");
        ?>
    </div>
</section>