<?php

class Controller_Basket extends Controller
{
    function __construct()
    {
        $this->model = new Model_Basket();
        $this->view = new View();
    }

    function action_index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete'])) {
                $product_id = $_POST['delete'];
                $this->model->deleteItem($product_id);
            } elseif (isset($_POST['delete_all'])) {
                $this->model->clearBasket();
            } else if (isset($_POST['ordering'])) {
                $this->model->ordering();
            }
        }
        $data = [];
        $data["items"] = $this->model->getBasket();
        $this->view->generate("app/pages/Basket/index.php", "app/layouts/base.php", $data);
    }

}
?>