<?php

// Model_Home
class Model_Home extends Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function getData() {
        return false;
    }

    // Получить все продукты
    public function get_home_all_products() {
        return $this->db->get_all("SELECT * FROM zoo_product LIMIT 3");
    }

    // Получить новые продукты
    public function get_home_new_products() {
        $query = "SELECT * FROM zoo_product ORDER BY product_id DESC LIMIT 3";  
        return $this->db->get_all($query);
    }

    // Поиск по названию
    public function get_search_products($search) {
        $query = "SELECT * FROM zoo_product WHERE product_name LIKE :search";
        return $this->db->get_all($query, ["search" => "%$search%"]);
    }
}