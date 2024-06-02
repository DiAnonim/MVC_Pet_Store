<?php

class Model_About extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        return;
    }

    public function get_about_rating()
    {
        $sql = "SELECT AVG(ratings.estimation) as average_rating FROM users 
        JOIN ratings ON users.rating_id = ratings.rating_id";
        $result = $this->db->get_all($sql);
        if ($result && count($result) > 0) {
            return round($result[0]['average_rating'], 1);
        }
        return 0;
    }

    public function add_rating($new_rating)
    {
        $sql = "UPDATE users set rating_id = :rating where user_id = :user_id";
        $args = [
            "rating" => $new_rating,
            "user_id" => $_SESSION['user']['user_id']
        ];
        $this->db->update($sql, $args);
    }

    public function get_user_rating()
    {
        return $_SESSION['user']['rating_id'];
    }
}
?>