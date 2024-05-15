<?php

class Controller_Home extends Controller
{
    function __construct() {
        $this->model = new Model_Home();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->getHome();
        $this->view->generate("app/pages/Home/index.php", "app/layouts/home.php", $data);
    }
    
}
?>
