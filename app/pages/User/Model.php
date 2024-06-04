<?php

class Model_User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        return false;
    }

    // Метод для создания нового пользователя
    public function create_user($data = [])
    {
        // Подготовка запроса на добавление пользователя
        $sql = "INSERT INTO users (username, email, password, birthday, gender, phone_number, user_photo_link) 
                VALUES (:username, :email, :password, :birthday, :gender, :phone_number, :user_photo_link)";

        // сохранение данных нового пользователя
        $args = [
            'username' => $data["username"],
            'email' => $data["email"],
            'password' => $data["password"],
            'birthday' => $data["birthday"],
            'gender' => $data["gender"],
            'phone_number' => $data["phone_number"],
            'user_photo_link' => $data["user_photo_link"],
        ];

        // Выполняем добавление пользователя в базу данных
        return $this->db->insert_db($sql, $args);
    }

    // Метод для входа пользователя
    public function login($data = [])
    {   
        // запрос для получения данных определенного пользователя
        $sql = "SELECT * FROM users WHERE `email` = :email";

        $args = [
            'email' => $data["email"],
        ];

        // Выполняем запрос к базе данных и получаем данные пользователя
        $user = $this->db->get_single($sql, $args);

        // Проверка наличия такого пользователя в бд и проверка правильности пароля
        if ($user && $this->check_password($data['password'], $user[strtoupper('password')], $user['salt'])) {
            // Сохраняем данные пользователя в сессии
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    // Метод для проверки пароля
    public function check_password($password1, $password2, $salt)
    {
        return sha1(md5($password1) . $salt) == $password2;
    }

    // Метод для выхода
    public function logout()
    {
        session_destroy();
    }

    // Метод для получения данных пользователя из сессии
    public function get_user_session()
    {
        if ($_SESSION['user']) {
            return $_SESSION['user'];
        }
    }

    // Метод для редактирования пользователя
    public function edit_user($data = [])
    {
        // Проверка пароля
        if (!$this->check_password($data['password'], $_SESSION['user']['PASSWORD'], $_SESSION['user']['salt'])) return false;

        // Получаем ID пользователя
        $user_id = $_SESSION['user']['user_id'];
        // Подготовка запроса на обновление данных пользователя
        $sql = "UPDATE users SET username = :username, email = :email, birthday = :birthday, gender = :gender, phone_number = :phone_number WHERE user_id = :user_id";
        // сохранение обновлённых данных пользователя
        $args = [
            'user_id' => $user_id,
            'username' => $data['username'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
        ];

        // Выполняем обновление данных пользователя
        $this->db->update($sql, $args);

        // Извлекаем обновленные данные пользователя из базы данных
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $args = [
            'user_id' => $user_id
        ];

        // Выполняем запрос к базе данных и получаем обновленные данные пользователя
        return $this->db->get_single($sql, $args);

    }

    // Метод для удаления пользователя
    public function delete_user($data = [])
    {
        // Проверка пароля
        if (!$this->check_password($data['password'], $_SESSION['user']['PASSWORD'], $_SESSION['user']['salt'])) return false;

        // Подготовка запроса на удаление пользователя
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        
        // сохранение ID пользователя
        $args = [
            'user_id' => $data['user_id']
        ];
        
        // Выполняем удаление пользователя
        $result = $this->db->delete($sql, $args);

        if ($result) {
            // Успешное удаление пользователя
            return true;
        } else {
            // Ошибка при удалении пользователя
            return false;
        }
    }
}
?>