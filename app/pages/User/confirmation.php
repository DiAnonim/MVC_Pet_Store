<section>
    <?php
    require_once "app/components/heading.php";
    display_heading("Подтверждение");
    ?>
    <form class="login" action="" method="post">
        <h3>Для редактирования профиля введите свой пароль</h3>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <input type="password" name="password_conf" placeholder="Пароль" required><br>
        <button>Подтвердить</button>
    </form>
</section>
