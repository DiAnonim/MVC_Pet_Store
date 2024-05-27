<?php

class Model_Items extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        return false;
    }

    public function getItems()
    {
        
        return $this->db->get_all("SELECT * FROM zoo_product");
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM zoo_product WHERE product_id = :product_id";
        $args = [
            "product_id" => $id
        ];
        return $this->db->get_single($sql, $args);
    }

    public function send_to_cart($id)
    {
        // Запрос к базе данных
    }
}