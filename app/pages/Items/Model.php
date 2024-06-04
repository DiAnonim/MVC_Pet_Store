<?php
// Модель для работы с товарами
class Model_Items extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData(){}

    // Получить все товары
    public function getItems()
    {
        return $this->db->get_all("SELECT * FROM zoo_product");
    }

    // Получить все категории
    public function get_categories(){
        return $this->db->get_all("SELECT * FROM category");
    }

    // Получить отзывы о товаре
    public function get_reviews($id)
    {
        // Подготовка запроса на получение отзывов о товаре
        $query_reviews = "SELECT * FROM reviews WHERE product_id = :product_id";
        $args_reviews = ["product_id" => $id];
        // Получение отзывов
        $reviews = $this->db->get_all($query_reviews, $args_reviews);

        // Для каждого отзыва получаем данные о пользователе
        foreach ($reviews as &$review) {
            $query_user = "SELECT * FROM users WHERE user_id = :user_id";
            $args_user = ["user_id" => $review['user_id']];
            $review['user'] = $this->db->get_single($query_user, $args_user);
        }

        return $reviews;
    }

    // Добавить отзыв о товаре
    public function add_review($data)
    {
        // Подготовка запроса на добавление отзыва
        $sql = "INSERT INTO reviews (product_id, user_id, reviews_text) VALUES (:product_id, :user_id, :review_text)";
        $args = [
            "product_id" => $data['product_id'],
            "user_id" => $_SESSION['user']['user_id'],
            "review_text" => $data['text']
        ];
        // Выполнение запроса
        $this->db->insert_db($sql, $args);
    }

    // Получить информацию о товаре
    public function get_item($id)
    {
        // Подготовка запроса на получение информации о товаре
        $sql = "SELECT * FROM zoo_product WHERE product_id = :product_id";
        $args = [
            "product_id" => $id
        ];
        // Выполнение запроса
        return $this->db->get_single($sql, $args);
    }

    // Удалить товар
    public function delete_item($id)
    {
        // Подготовка запроса на удаление товара
        $sql = "DELETE FROM zoo_product WHERE product_id = :product_id";
        $args = [
            "product_id" => $id
        ];
        // Выполнение запроса
        $this->db->delete($sql, $args);
    }

    // Создать новый товар
    public function create_item($data)
    {
        // Подготовка запроса на создание нового товара
        $sql = "INSERT INTO zoo_product (product_photo_link, product_name, product_description, product_price, product_count, product_category)
         VALUES (:product_photo_link, :product_name, :product_description, :product_price, :product_count, :product_category)";
        $args = [
            "product_photo_link" => $data['product_photo_link'],
            "product_name" => $data['product_name'],
            "product_description" => $data['product_description'],
            "product_price" => $data['product_price'],
            "product_count" => $data['product_count'],
            "product_category" => $data['product_category']
        ];
        // Выполнение запроса
        $this->db->insert_db($sql, $args);
    }
    
}
?>