<?php

class Controller_Basket extends Controller
{
    function __construct() {
        $this->model = new Model_Basket();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->getBasket();
        $this->view->generate("app/pages/Basket/index.php", "app/layouts/base.php", $data);
    }

    function action_delete_item($id) {
        $this->model->deleteItem($id);
    }

    function action_clear() {
        $this->model->clearBasket();
    }

    function ordering() {
        $data = $this->model->ordering();
        $this->view->generate("app/pages/Basket/order.php", "app/layouts/base.php");
    }
    
}
?>
