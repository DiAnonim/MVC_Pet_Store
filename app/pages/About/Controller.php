<?php


class Controller_About extends Controller
{
    function __construct()
    {
        $this->model = new Model_About();
        $this->view = new View();
    }

    // Метод для отображения главной страницы "О магазине"
    function action_index()
    {
        $data = [];
        $data['user_rating'] = $_SESSION['user']['rating_id']; // Получение рейтинга пользователя из сессии

        // Проверка на наличие оценки пользователя
        if (isset($data['user_rating'])) {
            $_SESSION['rated_store'] = true; // Установка флага оценки магазина
        } else
            $_SESSION['rated_store'] = false;

        // Обработка формы с оценкой
        if (!empty($_POST) && isset($_POST['rating'])) {
            $this->model->add_rating($_POST['rating']); // Добавление оценки в базу данных
            $_SESSION['rated_store'] = true; // Установка флага оценки магазина
            $data['success'] = "Ваша оценка успешно добавлена";
        }

        // Получение среднего рейтинга магазина
        $data['average_rating'] = $this->model->get_about_rating();
        // Генерация страницы с данными
        $this->view->generate("app/pages/About/index.php", "app/layouts/base.php", $data);
    }
}
?>