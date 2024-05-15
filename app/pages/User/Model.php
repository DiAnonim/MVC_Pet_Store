<?php

class Model_User implements Model
{
    public function getData()
    {
        return false;
    }

    public function getUser()
    {
        $user = new stdClass;
        return $user;
    }

    public function editUser($id)
    {
        // Запрос к базе данных
    }

    public function deleteUser($id){
        // Запрос к базе данных
    }
}