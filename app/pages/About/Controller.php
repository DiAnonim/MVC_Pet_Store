<?php

class Controller_About extends Controller
{
    function __construct() {
        $this->model = new Model_About();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->getAbout();
        $this->view->generate("app/pages/About/index.php", "app/layouts/about.php", $data);
    }
    
}
?>
