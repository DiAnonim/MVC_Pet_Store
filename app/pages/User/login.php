<section>
    <?php
    require_once "app/components/heading.php";
    display_heading("Вход");
    ?>
    <form class="login" action="" method="post">
        <input type="email" name="email" placeholder="Почта (example@ex.com)"><br>
        <input type="password" name="password" placeholder="Пароль"><br>
        <p>У вас нет аккаунта? <a href="/mvc/user/registration/">Регистрация</a></p>
        <button type="submit">Войти</button>
    </form>
</section>