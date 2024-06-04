<section>
    <?php
    // подключаем необходимые компоненты
    require_once "app/components/heading.php";
    display_heading("Вход");
    ?>

    <!-- форма для входа на свой аккаунт -->
    <form class="login" action="" method="post">
        <input type="email" name="email" placeholder="Почта (example@ex.com)"><br>
        <input type="password" name="password" placeholder="Пароль"><br>

        <!-- ссылка на регистрацию -->
        <p>У вас нет аккаунта? <a href="/mvc/user/registration/">Регистрация</a></p>
        <!-- кнопка для входа на свой аккаунт -->
        <button type="submit">Войти</button>
    </form>
</section>