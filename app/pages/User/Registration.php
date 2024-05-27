<section>
    <?php
    require_once "app/components/heading.php";
    display_heading("Регистрация");
    ?>
    <form class="registration" action="" method="post">
        <input type="text" name="username" placeholder="Имя и фамилия" required><br>
        <input type="email" name="email" placeholder="Почта (example@ex.com)" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <input type="date" name="birthday" placeholder="Дата рождения" required><br>
        <select class="gender" name="gender" required>
            <option value="female">Female</option>
            <option value="male">Male</option>
        </select><br>
        <input type="text" name="phone_number" placeholder="Телефонный номер (+7 999 999 99 99)"><br>
        <p>У вас уже есть аккаунт? <a href="/mvc/user/login/">Вход</a></p>
        <button type="submit">Зарегистрироваться</button>
    </form>

</section>