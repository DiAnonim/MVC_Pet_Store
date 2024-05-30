<section>
    <?php
    require_once "app/components/heading.php";
    display_heading("Профиль");
    ?>
    <div class="login">
        <img style="border-radius: 50%; width: 300px; margin: auto;" src="<?= $user['user_photo_link'] ?>" alt="">
        <h2>Username: <?= $user['username'] ?></h2>
        <p>Email: <?= $user['email'] ?></p>
        <p>Birthday: <?= $user['birthday'] ?></p>
        <p>Gender: <?= $user['gender'] ?></p>
        <p>Phone number: <?= $user['phone_number'] ?></p>
        <p>Role: <?= $user['role'] ?></p>
        <form action="/mvc/user/edit" method="post">
            <button type="submit">Редактировать</button>
        </form>
        <form action="/mvc/user/logout" method="post">
            <button type="submit">Выход</button>
        </form>
    </div>

</section>