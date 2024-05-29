<?php

class Controller_Items extends Controller
{
    function __construct() {
        require_once "app/pages/Basket/Model.php";
        $this->model = new Model_Items();
        $this->cart_model = new Model_Basket();
        $this->view = new View();
    }

    function action_index() {
        $data = [];
        $data["items"] = $this->model->getItems();
        $this->view->generate("app/pages/Items/index.php", "app/layouts/base.php", $data);
    }

    function action_details($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_id' => $_POST['product_id'],
                'text' => $_POST['review']
            ];
            $this->model->add_review($data);
        }

        $result_items = $this->model->getById($id);
        $result_reviews = $this->model->get_reviews($id);
        $data = [];
        $data["item"] = $result_items;    
        $data["reviews"] = $result_reviews;
        $this->view->generate("app/pages/Items/Details.php", "app/layouts/base.php", $data);
    }

    function action_add_to_cart($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->cart_model->add_to_cart($id);
        }
    }
}
?>
