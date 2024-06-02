<section>
    <?php
    require_once "app/components/heading.php";
    display_heading("Редактирование профиля");
    ?>
    <form class="registration" action="" method="post">
        <input type="text" name="username" value="<?= $user['username'] ?>" placeholder="Имя и фамилия" required><br>
        <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="Почта (example@ex.com)" required><br>
        <input type="date" name="birthday" value="<?= $user['birthday'] ?>" placeholder="Дата рождения" required><br>
        <select class="gender" name="gender" required>
            <option value="female" <?= $user['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
            <option value="male" <?= $user['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
        </select><br>
        <input type="text" name="phone_number" value="<?= $user['phone_number'] ?>" placeholder="Телефонный номер (+7 999 999 99 99)"><br>
        <button type="submit">Сохранить</button>
        <a href="/mvc/user">Отмена</a>
    </form>
</section>
