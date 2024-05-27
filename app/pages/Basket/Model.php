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
        $basket = [new stdClass, new stdClass, new stdClass];
        return $basket;
    }

    public function deleteItem($id) {
        // Запрос к базе данных
    }

    public function clearBasket(){
        // Запрос к базе данных
    }

    public function ordering(){
        // Запрос к базе данных
    }
}