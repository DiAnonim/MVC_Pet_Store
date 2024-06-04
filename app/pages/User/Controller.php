<?php

class Controller_User extends Controller
{
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
    }

    // профиль пользователя
    function action_index()
    {
        $data = [];
        // Получаем данные текущего пользователя
        $data["user"] = $this->model->get_user_session();
        $this->view->generate("app/pages/User/index.php", "app/layouts/base.php", $data);
    }

    // регистрация
    function action_registration()
    {
        // Проверяем, что POST данные не пустые
        if (!empty($_POST)) {
            // Сохраняем данные нового пользователя
            $user = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'birthday' => $_POST['birthday'],
                'gender' => $_POST['gender'],
                'phone_number' => $_POST['phone_number'],
                'user_photo_link' => $_POST['user_photo_link'],
            ];
            // Создаем нового пользователя
            $new_user = $this->model->create_user($user);

            // Выводим сообщение об успешном создании пользователя
            if ($new_user > 0) $this->view->generate("app/pages/User/success.php", "app/layouts/base.php");
            else // Выводим сообщение об ошибке 
                $this->view->generate("app/pages/User/error.php", "app/layouts/base.php");
        } else // Показываем форму регистрации
            $this->view->generate("app/pages/User/registration.php", "app/layouts/base.php");
    }

    // вход
    function action_login()
    {
        // Проверяем, что POST данные не пустые
        if (!empty($_POST)) {
            // Получаем данные пользователя и сохраняем
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            // делаем вход
            $user = $this->model->login($data);

            // Выводим сообщение об успешном входе
            if ($user)
                $this->view->generate("app/pages/User/success.php", "app/layouts/base.php");
            else // Выводим сообщение об ошибке
                $this->view->generate("app/pages/User/error.php", "app/layouts/base.php");
        } else  // Показываем форму входа
            $this->view->generate("app/pages/User/login.php", "app/layouts/base.php");
    }

    function action_edit()
    {
        if (!empty($_POST)) { // Проверяем, что POST данные не пустые
            $new_data_user = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'birthday' => $_POST['birthday'],
                'gender' => $_POST['gender'],
                'phone_number' => $_POST['phone_number'],
                'password' => $_POST['password'],  
            ];

            // Обновляем данные пользователя и получаем обновленные данные
            $updated_user = $this->model->edit_user($new_data_user);

            if ($updated_user) {
                // Обновляем данные в сессии
                $_SESSION['user'] = $updated_user;
                $this->view->generate("app/pages/User/success.php", "app/layouts/base.php");
            } else {
                $this->view->generate("app/pages/User/error.php", "app/layouts/base.php");
            }
        } else {
            $data = ["user" => $this->model->get_user_session()]; // Получаем данные текущего пользователя для формы редактирования
            $this->view->generate("app/pages/User/edit.php", "app/layouts/base.php", $data); // Показываем форму редактирования
        }

    }


    // удаление
    function action_delete()
    {
        if (!empty($_POST) && isset($_POST['user_id']) && isset($_POST['password'])) {
            $data = [
                'user_id' => $_POST['user_id'],
                'password' => $_POST['password'],
            ];

            // удаляем пользователя
            $result = $this->model->delete_user($data);

            if ($result) {
                // Выводим сообщение об успешном удалении пользователя и делаем logout
                $this->model->logout();
                $this->view->generate("app/pages/User/success.php", "app/layouts/base.php");
            } else {
                // Выводим сообщение об ошибке
                $this->view->generate("app/pages/User/error.php", "app/layouts/base.php");
            }
        } else {
            $data = ["user" => $this->model->get_user_session()]; // Получаем данные текущего пользователя для формы удаления
            $this->view->generate("app/pages/User/delete.php", "app/layouts/base.php", $data); // Показываем форму удаления
        }
    }

    // выход
    function action_logout()
    {
        // производим выход
        $this->model->logout();
        $this->view->generate("app/pages/User/logout.php", "app/layouts/base.php");
    }
}
?>