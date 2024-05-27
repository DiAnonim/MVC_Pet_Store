<?php

class Model_About extends Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getData() {
        return;
    }

    public function getAbout() {
        $basket = [new stdClass, new stdClass, new stdClass];
        return $basket;
    }

}