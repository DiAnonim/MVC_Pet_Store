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

        if ($user && sha1(md5($data['password']) . $user['salt']) == $user[strtoupper('password')]) {
            return $user;
        }
        return false;
    }

    public function logout(){
        return true;
    }

    public function getUser()
    {
        // Запрос к базе данных
    }

    public function editUser($id)
    {
        // Запрос к базе данных
    }

    public function deleteUser($id)
    {
        // Запрос к базе данных
    }
}
?>