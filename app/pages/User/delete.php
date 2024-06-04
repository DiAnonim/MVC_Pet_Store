<?php require_once "app/components/heading.php"; display_heading("Удаление аккаунта"); ?>

<!-- Форма для удаления аккаунта -->
<form class="registration" action="" method="post">
    <label for="delete" style="color: red">Вы действительно хотите удалить аккаунт?</label>
    <input type="hidden" name="user_id" id="delete" value="<?= $user['user_id'] ?>">
    <input style="box-shadow: 0 0 5px red;" type="password" name="password" placeholder="Введите пароль для подтверждения">
    <button type="submit" style="background-color: red">Удалить аккаунт</button>
</form>
