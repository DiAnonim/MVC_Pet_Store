<?php

class Controller_User extends Controller
{
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
    }

    function action_index()
    {
        $data = [];
        $data["user"] = $this->model->getUser();
        $this->view->generate("app/pages/User/index.php", "app/layouts/base.php", $data);
    }

    function action_registration()
    {
        if (!empty($_POST)) {
            $user = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'birthday' => $_POST['birthday'],
                'gender' => $_POST['gender'],
                'phone_number' => $_POST['phone_number']
            ];
            $new_user = $this->model->create_user($user);
            if ($new_user > 0)
                $this->view->generate("app/pages/User/success.php", "app/layouts/base.php");
            else
                $this->view->generate("app/pages/User/error.php", "app/layouts/base.php");
        } else
            $this->view->generate("app/pages/User/registration.php", "app/layouts/base.php");
    }

    function action_login()
    {
        if (!empty($_POST)) {
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            $user = $this->model->login($data);
            if ($user)
                $this->view->generate("app/pages/User/success.php", "app/layouts/base.php");
            else
                $this->view->generate("app/pages/User/error.php", "app/layouts/base.php");
        } else {
            $this->view->generate("app/pages/User/login.php", "app/layouts/base.php");
        }
    }

    function action_logout()
    {
        $this->model->logout();
        $this->view->generate("app/pages/User/logout.php", "app/layouts/base.php");
    }
}
?>