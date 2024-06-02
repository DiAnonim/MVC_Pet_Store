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

    public function create_user($data = [])
    {
        $sql = "INSERT INTO users (username, email, password, birthday, gender, phone_number) 
                VALUES (:username, :email, :password, :birthday, :gender, :phone_number)";

        $args = [
            'username' => $data["username"],
            'email' => $data["email"],
            'password' => $data["password"],
            'birthday' => $data["birthday"],
            'gender' => $data["gender"],
            'phone_number' => $data["phone_number"],
        ];

        return $this->db->insert_db($sql, $args);
    }

    public function login($data = [])
    {
        $sql = "SELECT * FROM users WHERE `email` = :email";
        $args = [
            'email' => $data["email"],
        ];
        $user = $this->db->get_single($sql, $args);

        if ($user && $this->check_password($data['password'], $user[strtoupper('password')], $user['salt'])) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function check_password($password1, $password2, $salt)
    {
        return sha1(md5($password1) . $salt) == $password2;
    }

    public function logout()
    {
        session_destroy();
    }

    public function getUser()
    {
        if ($_SESSION['user']) {
            return $_SESSION['user'];
        }
    }

    public function edit_user($data = [])
    {
        $sql = "UPDATE users SET username = :username, email = :email, birthday = :birthday, gender = :gender, phone_number = :phone_number where user_id = :user_id";

        $args = [
            'user_id' => $data['user_id'],
            'username' => $data['username'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
        ];

        return $this->db->update($sql, $args);
    }



    public function deleteUser($id)
    {
        // Запрос к базе данных
    }
}
?>