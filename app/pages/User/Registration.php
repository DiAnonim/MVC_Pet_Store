<section>
    <?php
    // Подключаем необходимые компоненты
    require_once "app/components/heading.php";
    display_heading("Регистрация");
    ?>

    <!-- Форма регистрации -->
    <form class="registration" action="" method="post">
        <!-- Поля для ввода данных о профиле -->
        <!-- Ссылка на фото https://gas-kvas.com/uploads/posts/2023-02/1676442203_gas-kvas-com-p-detskii-kompyuternii-risunok-43.png -->
        <input type="text" name="user_photo_link" placeholder="Ссылка на фото" required><br>
        <input type="text" name="username" placeholder="Имя и фамилия" required><br>
        <input type="email" name="email" placeholder="Почта (example@ex.com)" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <input type="date" name="birthday" placeholder="Дата рождения" required><br>
        <select class="gender" name="gender" required>
            <option value="female">Female</option>
            <option value="male">Male</option>
        </select><br>
        <input type="text" name="phone_number" placeholder="Телефонный номер (+7 999 999 99 99)"><br>

        <!-- Ссылка на страницу входа -->
        <p>У вас уже есть аккаунт? <a href="/mvc/user/login/">Вход</a></p>
        <!-- Кнопка для отправки формы на сохранение профиля -->
        <button type="submit">Зарегистрироваться</button>
    </form>

</section>