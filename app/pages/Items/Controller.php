<?php

class Controller_Items extends Controller
{
    function __construct() {
        $this->model = new Model_Items();
        $this->view = new View();
    }

    function action_index() {
        $data = [];
        $data["items"] = $this->model->getItems();
        $this->view->generate("app/pages/Items/index.php", "app/layouts/base.php", $data);
    }

    function action_details($id) {
        $result = $this->model->getById($id);
        $data = [];
        $data["item"] = $result;        
        $this->view->generate("app/pages/Items/Details.php", "app/layouts/base.php", $data);
    }

    function action_in_basket($id) {
        $this->model->send_to_cart($id);
    }
    
}
?>
