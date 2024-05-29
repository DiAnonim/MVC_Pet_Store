<?php

class Model_Basket extends Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getData() {
        return false;
    }

    public function getBasket() {
        $user_id = $_SESSION['user']['user_id'];

        $basket = [];
        $query = "SELECT * FROM shopping_cart WHERE user_id = $user_id";    
        $basket["products"] = $this->db->get_all($query);

        foreach ($basket["products"] as $key => $value) {
            $product_id = $value["product_id"];
            $query = "SELECT * FROM zoo_product WHERE product_id = $product_id";
            $basket["products"][$key]["product"] = $this->db->get_single($query);
        }
        return $basket;
    }

    public function deleteItem($id) {
        $user_id = $_SESSION['user']['user_id'];
        $query = "DELETE FROM shopping_cart WHERE user_id = $user_id";
        $this->db->delete($query);
    }

    public function clearBasket(){
        // Запрос к базе данных
        
    }

    public function ordering(){
        // Запрос к базе данных
    }

    public function add_to_cart($id) {
        $user_id = $_SESSION['user']['user_id'];
        $query = "INSERT INTO shopping_cart (user_id, product_id) VALUES (?, ?)";
        $args = [$user_id, $id];
        $this->db->insert_db($query, $args);
    }
}
?>
