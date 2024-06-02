<?php

class Controller_Home extends Controller
{
    function __construct() {
        parent::__construct();
        $this->model = new Model_Home();
        $this->view = new View();
    }

    function action_index() {
        $data = [];
        $data["user"] = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
        $data["items"] = $this->model->get_home_all_products();
        $data["new_items"] = $this->model->get_home_new_products();
        $this->view->generate("app/pages/Home/index.php", "app/layouts/base.php", $data);
    }


    function action_search() {
        $data = [];
        $data["search_items"] = $this->model->get_search_products($_POST["search"]);
        $this->view->generate("app/pages/Home/search.php", "app/layouts/base.php", $data);
    }
    
}
?>
