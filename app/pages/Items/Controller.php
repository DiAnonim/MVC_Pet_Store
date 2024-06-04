<?php
// Контроллер для управления товарами
class Controller_Items extends Controller
{
    function __construct()
    {
        // Подключаем модели
        require_once "app/pages/Items/Model.php";
        require_once "app/pages/Basket/Model.php";

        // Инициализируем модели
        $this->model = new Model_Items();
        $this->cart_model = new Model_Basket();
        $this->view = new View();
    }

    // Главная страница с товарами
    function action_index($id = null)
    {
        // Обработка POST-запросов
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Если нажата кнопка удаления товара
            if (isset($_POST['delete'])) {
                $this->model->delete_item($_POST['delete']);
            }
        }
        // Получаем список товаров
        $data = [];
        $data["items"] = $this->model->getItems();
        $this->view->generate("app/pages/Items/index.php", "app/layouts/base.php", $data);
    }


    // Создание нового товара
    function action_create()
    {
        // Проверяем, был ли отправлен POST-запрос
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получаем данные формы
            $data = [
                'product_photo_link' => $_POST['product_photo_link'],
                'product_name' => $_POST['product_name'],
                'product_description' => $_POST['product_description'],
                'product_price' => $_POST['product_price'],
                'product_count' => $_POST['product_count'],
                'product_category' => $_POST['product_category']
            ];
            // Вызываем метод модели для создания нового товара
            $this->model->create_item($data);
        }
        $data = [];
        $data["categories"] = $this->model->get_categories();
        // Перенаправляем пользователя на главную страницу с товарами после создания товара
        $this->view->generate("app/pages/Items/create.php", "app/layouts/base.php", $data);
    }

    // Страница с деталями товара
    function action_details($id)
    {
        // Обработка POST-запросов
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Если нажата кнопка добавления в корзину
            if (isset($_POST['add_to_cart'])) {
                $this->cart_model->add_to_cart($id);
            }
            // Если оставлен отзыв
            else if (isset($_POST['review'])) {
                $data = [
                    'product_id' => $_POST['product_id'],
                    'text' => $_POST['review']
                ];
                $this->model->add_review($data);
            }
        }
        // Получаем данные о товаре и отзывах для отображения на странице
        $data = [];
        $data["item"] = $this->model->get_item($id);
        $data["reviews"] = $this->model->get_reviews($id);
        // Отображаем страницу с деталями товара
        $this->view->generate("app/pages/Items/details.php", "app/layouts/base.php", $data);
    }
}
?>