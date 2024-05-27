<?php

abstract class Model {

    protected $db;

    public function __construct(){
        $this->db = new Database;
    }

    abstract public function getData();
}