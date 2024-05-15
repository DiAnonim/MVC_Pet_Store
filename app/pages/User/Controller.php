<?php

class Controller_User extends Controller
{
    function __construct() {
        $this->model = new Model_User();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->getUser();
        $this->view->generate("app/pages/User/index.php", "app/layouts/user.php", $data);
    }
    
    function edit($id) {
        $data = $this->model->editUser($id);
        $this->view->generate("app/pages/User/edit.php", "app/layouts/user.php", $data);
    }

    function delete($id) {
        $this->model->deleteUser($id);
    }
}
?>
