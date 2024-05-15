<?php
function product_card($name, $price, $image_url, $description) {
    echo "
    <div class='product-card'>
        <img src='$image_url' alt='$name'>
        <h3>$name</h3>
        <p>$description</p>
        <span class='price'>$price</span>
        <button class='btn btn-primary'>Добавить в корзину</button>
    </div>";
}
?>
