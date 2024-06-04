<section>
    <?php
    // Выводим заголовок "Добавление товара"
    require_once "app/components/heading.php";
    display_heading("Добавление товара");
    ?>
    <!-- Форма для создания нового товара -->
    <form class="registration" action="/mvc/items/create" method="post">
        <!-- Поля для ввода данных о новом товаре -->
        <input type="text" name="product_photo_link" placeholder="Ссылка на фото" required><br>
        <input type="text" name="product_name" placeholder="Название товара" required><br>
        <input type="text" name="product_description" placeholder="Описание товара" required><br>
        <input type="number" name="product_price" placeholder="Цена товара" required><br>
        <input type="number" name="product_count" placeholder="Количество товара" required><br>
        <select name="product_category" required>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <!-- Кнопка для отправки формы на создание товара -->
        <button type="submit">Создать</button>
    </form>
</section>
