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

    public function get_reviews($id)
    {
        $query_reviews = "SELECT * FROM reviews WHERE product_id = :product_id";
        $args_reviews = ["product_id" => $id];
        $reviews = $this->db->get_all($query_reviews, $args_reviews);

        foreach ($reviews as &$review) {
            $query_user = "SELECT * FROM users WHERE user_id = :user_id";
            $args_user = ["user_id" => $review['user_id']];
            $review['user'] = $this->db->get_single($query_user, $args_user);
        }

        return $reviews;
    }

    public function add_review($data)
    {
        $sql = "INSERT INTO reviews (product_id, user_id, reviews_text) VALUES (:product_id, :user_id, :review_text)";
        $args = [
            "product_id" => $data['product_id'],
            "user_id" => $_SESSION['user']['user_id'],
            "review_text" => $data['text']
        ];
        $this->db->insert_db($sql, $args);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM zoo_product WHERE product_id = :product_id";
        $args = [
            "product_id" => $id
        ];
        return $this->db->get_single($sql, $args);
    }

    public function get_content(){
        $sql = "SELECT * FROM zoo_product LIMIT 3 OFFSET 0";
    }
}