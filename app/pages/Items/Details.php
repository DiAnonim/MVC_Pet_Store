<?php
require_once "app/components/heading.php";
display_heading("О Товаре");
?>
<div class="item-details">
    <img src="<?= $item['product_photo_link'] ?>" alt=" ">
    <h2><?= $item['product_name'] ?></h2>
    <p style="color: rgb(97, 216, 97); text-shadow: 0 0 10px rgb(255, 255, 255);">В наличии: <?= $item['product_count'] ?></p>
    <p><?= $item['product_description'] ?></p>
    <p><?= $item['product_price'] ?> €</p>
    <p><a href="/mvc/items">Back</a></p>
</div>