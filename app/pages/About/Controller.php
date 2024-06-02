<?php

class Controller_About extends Controller
{
    function __construct()
    {
        $this->model = new Model_About();
        $this->view = new View();
    }

    function action_index()
    {
        $data = [];
        $data['user_rating'] = $_SESSION['user']['rating_id'];
        if (isset($data['user_rating'])) {
            $_SESSION['rated_store'] = true;
        } else
            $_SESSION['rated_store'] = false;

        if (!empty($_POST) && isset($_POST['rating'])) {
            $this->model->add_rating($_POST['rating']);
            $_SESSION['rated_store'] = true;
            $data['success'] = "Ваша оценка успешно добавлена";
        }

        $data['average_rating'] = $this->model->get_about_rating();
        $this->view->generate("app/pages/About/index.php", "app/layouts/base.php", $data);
    }
}
?>