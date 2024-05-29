<?php
function product_card($id, $name, $price, $image_url, $description, $count, $class)
{
    if ($count > 0) {
        echo "
        <div class='$class'>
            <img src='$image_url' alt=' '>
            <h3>$name</h3>
            <p>$description</p>
            <p class='price'>$price €</p>
            <a href='/mvc/items/id$id'>Details</a>
        </div>";
    } else {
        echo "<div class='$class'>
        <img src='$image_url' alt=' '>
        <h3>$name</h3>
        <p style='color: red;'>Товар закончился</p></div>";
    }
}

function product_card_home($id, $name, $price, $image_url, $count, $class)
{
    if ($count > 0) {
        echo "
    <div class='$class'>
        <img src='$image_url' alt=' '>
        <div>
            <h3>$name</h3>
            <p class='price'>$price €</p>
            <a href='/mvc/items/id$id'>Details</a>
        </div>
    </div>";
    } else {
        echo "<div class='$class'>
        <img src='$image_url' alt=' '>
        <h3>$name</h3>
        <p style='color: red;'>Товар закончился</p>
        </div>";
    }

}



function product_card_basket($id, $name, $price, $image_url, $description, $count, $class)
{
    echo "
    <div class='$class'>
        <img src='$image_url' alt=' '>
        <h3>$name</h3>
        <p>$description</p>
        <p class='price'>$price €</p>
        <a href='/mvc/items/id$id'>Details</a>

    </div>";
    
}

function review_card($id, $user_name, $review, $class)
{
    $created = date("d.m.Y");
    echo "
    <div class='$class'>
    <h3 col>$user_name <span style='color: rgb(97, 216, 97); text-shadow: 0 0 10px rgb(255, 255, 255); font-size: 12px' >Created: $created</span></h3>
    <p style='color: black; text-shadow: 0 0 10px rgb(255, 255, 255);'>$review</p>
    </div>";
}

?>