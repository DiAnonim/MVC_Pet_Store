<?php require_once "app/components/heading.php";
require_once "app/components/product_card.php";
display_heading("О Товаре"); ?>
<section class="item-details">
    <img src="<?= $item['product_photo_link'] ?>" alt=" ">
    <h2><?= $item['product_name'] ?></h2>
    <p style="color: rgb(97, 216, 97); text-shadow: 0 0 10px rgb(255, 255, 255);">В наличии:
        <?= $item['product_count'] ?>
    </p>
    <p><?= $item['product_description'] ?></p>
    <p><?= $item['product_price'] ?> €</p>
    <p><a href="/mvc/items">Back</a></p>
    <p><a href="/mvc/items/add_to_cart/<?= $item['product_id'] ?>">Добавить в корзину</a></p>

</section>

<?php
if (isset($_SESSION['user'])):
    display_heading("Напишите отзыв");
    ?>

    <form class="login" action="" method="POST">
        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
        <input type="text" name="review" placeholder="Оставьте ваш отзыв...">
        <button type="submit">Отправить</button>
    </form>

<?php endif; ?>

<section>
    <ul>
        <?php display_heading("Отзывы"); ?>
        <?php foreach ($reviews as $review): ?>
            <?php if ($review['product_id'] == $item['product_id']): ?>
                <?php
                $user = $review['user'];
                review_card($item['product_id'], $user['username'], $review['reviews_text'], "review-card");
                ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</section>