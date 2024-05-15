<?php
class ViewMock
{
    public function render($template)
    {
        echo "Rendering template: $template";
    }
}

class Mock_User_Controller extends Controller
{
    private $id;
    private $view;

    public function __construct()
    {
        $this->view = new ViewMock();
    }

    public function edit($id)
    {
        $this->view->render("User/edit");
    }


    public function index()
    {
        $this->view->render("User/index");
    }

    public function create()
    {
        $this->view->render("User/create");
    }
}
