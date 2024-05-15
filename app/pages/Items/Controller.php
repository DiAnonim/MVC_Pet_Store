<?php

class Controller_Items extends Controller
{
    function __construct() {
        $this->model = new Model_Items();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->getItems();
        $this->view->generate("app/pages/Items/index.php", "app/layouts/items.php", $data);
    }

    function action_details($id) {
        echo "One item: $id";
    }

    function action_in_basket($id) {
        $this->model->send_to_cart($id);
    }
    
}
?>
