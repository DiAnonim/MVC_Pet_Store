<div>
    <?php
    require_once "app/components/heading.php";
    display_heading("О нас");
    ?>
</div>
<section class="login" style="width: 80%;">
    <div>
        <p>Добро пожаловать в наш зоомагазин,<br> где каждый шаг наполнен радостью и заботой о вашем питомце! <br>Мы
            предлагаем
            широкий ассортимент товаров для всех видов домашних животных, <br>от пушистых котиков до пернатых
            попугаев и
            маленьких грызунов.<br><br>

            Наши полки усеяны качественным кормом для собак и кошек, включая как премиум-бренды,<br> так и
            натуральные
            варианты, чтобы ваш любимец получал все необходимое для здоровья и счастья.<br>

            В нашем ассортименте также представлены аксессуары для заботы о вашем питомце:<br> игрушки, поводки,
            наполнители для туалетов и многое другое.<br> <br> Наш опытный персонал всегда готов поделиться советами
            по уходу и
            питанию,<br>
            чтобы ваше взаимодействие с любимцем было полноценным и радостным.<br><br>

            Посетите наш зоомагазин сегодня и превратите заботу о вашем питомце в удовольствие!</p><br><br>
    </div>

    <?php if (!empty($_SESSION['user']) && empty($data['user_rating']) && !isset($_SESSION['rated_store'])): ?>
        <div>
            <form class="rating" action="" method="post">
                <h2>Просим вас оценить наш магазин</h2>
                <select name="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button class="button">Оценить</button>
            </form>
        </div>
    <?php endif; ?>

    <div>
        <h2>Средняя оценка: <?php echo $data['average_rating'] ?? 'Нет оценок' ?></h2>
    </div>

    <?php if (isset($data['success'])): ?>
        <p style="color: rgb(0, 255, 42);"><?php echo $data['success']; ?></p>
    <?php endif; ?>
</section>