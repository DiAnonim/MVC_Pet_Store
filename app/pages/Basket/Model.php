<?php

class Model_Basket extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        return false;
    }

    // метод получения корзины и подсчета общей стоимости
    public function getBasket() {
        $user_id = $_SESSION['user']['user_id'];

        // получаем данные корзины пользователя
        $basket = [];
        $query = "SELECT * FROM shopping_cart WHERE user_id = $user_id";
        $basket["products"] = $this->db->get_all($query);

        $total_price = 0;

        // считаем общую стоимость
        foreach ($basket["products"] as $key => $value) {
            $product_id = $value["product_id"];
            $query = "SELECT * FROM zoo_product WHERE product_id = $product_id";
            $product = $this->db->get_single($query);

            $basket["products"][$key]["product"] = $product;
            $basket["products"][$key]["quantity"] = $value["quantity"];

            $total_price += $product["product_price"] * $value["quantity"];
        }

        $basket["total_price"] = $total_price;

        // возвращаем массив с товарами и общей стоимостью 
        return $basket;
    }

    // Удаление одного элемента
    public function deleteItem($id)
    {
        $user_id = $_SESSION['user']['user_id'];

        // Уменьшаем количество товара в корзине
        $query_check_quantity = "SELECT quantity FROM shopping_cart WHERE user_id = ? AND product_id = ?";
        $args_check_quantity = [$user_id, $id];
        $item = $this->db->get_single($query_check_quantity, $args_check_quantity);

        if ($item['quantity'] > 1) {
            // Уменьшаем количество на 1
            $query_update_quantity = "UPDATE shopping_cart SET quantity = quantity - 1 WHERE user_id = ? AND product_id = ?";
            $this->db->update($query_update_quantity, $args_check_quantity);
        } else {
            // Удаляем товар из корзины
            $query_delete_from_cart = "DELETE FROM shopping_cart WHERE user_id = ? AND product_id = ?";
            $this->db->delete($query_delete_from_cart, $args_check_quantity);
        }

        // Увеличиваем количество товара на складе
        $query_update_stock = "UPDATE zoo_product SET product_count = product_count + 1 WHERE product_id = ?";
        $args_update_stock = [$id];
        $this->db->update($query_update_stock, $args_update_stock);
    }

    // Очистка корзины
    public function clearBasket()
    {
        $user_id = $_SESSION['user']['user_id'];

        // Получаем все товары из корзины для данного пользователя
        $query = "SELECT product_id, quantity FROM shopping_cart WHERE user_id = ?";
        $args = [$user_id];
        $products = $this->db->get_all($query, $args);

        // Увеличиваем количество каждого товара в базе данных
        foreach ($products as $product) {
            $product_id = $product['product_id'];
            $quantity = $product['quantity'];
            $query_update_stock = "UPDATE zoo_product SET product_count = product_count + ? WHERE product_id = ?";
            $args_update_stock = [$quantity, $product_id];
            $this->db->update($query_update_stock, $args_update_stock);
        }

        // Очищаем корзину
        $query_clear_cart = "DELETE FROM shopping_cart WHERE user_id = ?";
        $this->db->delete($query_clear_cart, $args);
    }

    // Очищаем корзину без изменения количества товаров на складе
    public function clear_basket_without_restock()
    {
        $user_id = $_SESSION['user']['user_id'];

        // Очищаем корзину без изменения количества товаров на складе
        $query_clear_cart = "DELETE FROM shopping_cart WHERE user_id = ?";
        $args = [$user_id];
        $this->db->delete($query_clear_cart, $args);
    }

    // Создание заказа
    public function ordering()
    {
        $user_id = $_SESSION['user']['user_id'];

        // Получаем текущую корзину
        $basket = $this->getBasket();
        $total_price = $basket["total_price"];

        // Создаем заказ
        $query_create_order = "INSERT INTO orders (user_id, total_amount, order_date, status) VALUES (?, ?, ?, ?)";
        $args_create_order = [$user_id, $total_price, date('Y-m-d H:i:s'), "confirmed"];
        $this->db->insert_db($query_create_order, $args_create_order);

        // Очищаем корзину
        $this->clear_basket_without_restock();
    }

    // Добавление в корзину
    public function add_to_cart($id)
    {
        $user_id = $_SESSION['user']['user_id'];

        // Проверка на наличие товара на складе
        $query_check_stock = "SELECT product_count FROM zoo_product WHERE product_id = ?";
        $args_check_stock = [$id];
        $product = $this->db->get_single($query_check_stock, $args_check_stock);

        if ($product['product_count'] > 0) {
            // Проверка, есть ли товар уже в корзине
            $query_check_cart = "SELECT quantity FROM shopping_cart WHERE user_id = ? AND product_id = ?";
            $args_check_cart = [$user_id, $id];
            $item = $this->db->get_single($query_check_cart, $args_check_cart);

            if ($item) {
                // Если товар уже в корзине, увеличиваем количество на 1
                $query_update_quantity = "UPDATE shopping_cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
                $this->db->update($query_update_quantity, $args_check_cart);
            } else {
                // Если товара нет в корзине, добавляем его с количеством 1
                $query_add_to_cart = "INSERT INTO shopping_cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
                $args_add_to_cart = [$user_id, $id];
                $this->db->insert_db($query_add_to_cart, $args_add_to_cart);
            }

            // Уменьшаем количество товара на складе
            $query_update_stock = "UPDATE zoo_product SET product_count = product_count - 1 WHERE product_id = ?";
            $this->db->update($query_update_stock, $args_check_stock);
        } else {
            // Обработка случая, когда товара нет на складе
            throw new Exception("Товар отсутствует на складе");
        }
    }
}
?>