<section>
    <!-- Подключение компонентов -->
    <?php
    require_once "app/components/heading.php";
    require_once "app/components/product_card.php";
    require_once "app/components/search.php";
    display_heading("Главная страница");?>

    <!-- Поиск по названию -->
    <section>
        <?php
        create_search_form("search", "/mvc/home/search/", "search");
        ?>
    </section>

    <!-- Проверка наличия авторизованного пользователя с ролью "админ", и вывод ссылки для добавления нового товара -->
    <?php if (!empty($user) && $user["role"] == "admin"): ?>
        <section class="login">
            <h1>Добро пожаловать админ</h1>
        </section>
    <?php endif; ?>
    
    <!-- Вывод всех товаров -->
    <?php
    display_subheading("нажмите для просмотра всех товаров", "/mvc/items");
    ?>
    <section class="products-home">
        <?php foreach ($items as $item): ?>
            <?php
            product_card_home(
                $item['product_id'],
                $item['product_name'],
                $item['product_price'],
                $item['product_photo_link'],
                $item['product_count'],
                "product-card-home"
            ); ?>
        <?php endforeach; ?>
    </section>

    <!-- Вывод последних добавленных -->
    <?php
    display_subheading("недавно добавленные", "");
    ?>
    <section class="products-home">
        <?php foreach ($new_items as $item): ?>
            <?php
            product_card_home(
                $item['product_id'],
                $item['product_name'],
                $item['product_price'],
                $item['product_photo_link'],
                $item['product_count'],
                "product-card-home"
            ); ?>
        <?php endforeach; ?>
    </section>
</section>