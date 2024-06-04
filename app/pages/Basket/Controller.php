<?php

class Controller_Basket extends Controller
{
    function __construct()
    {
        $this->model = new Model_Basket();
        $this->view = new View();
    }

    // Вывод корзины
    function action_index()
    {
        // Обработка POST-запросов
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Удаление элемента
            if (isset($_POST['delete'])) {
                $product_id = $_POST['delete'];
                $this->model->deleteItem($product_id);
            } 
            // Удаление всех
            elseif (isset($_POST['delete_all'])) {
                $this->model->clearBasket();
            } 
            // Сделать Заказ
            else if (isset($_POST['ordering'])) {
                $this->model->ordering();
            }
        }
        // Получаем данные о корзине
        $data = [];
        $data["items"] = $this->model->getBasket();
        // Отображаем страницу с корзиной   
        $this->view->generate("app/pages/Basket/index.php", "app/layouts/base.php", $data);
    }

}
?>