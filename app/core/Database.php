<?php

class Database
{
    private $connection = null;
    public $query = null;

    private $host = "localhost";
    private $port = "3306";
    private $db_name = "pet_supplies";
    private $charset = "utf8mb4";
    private $user = "root";
    private $password = "";

    private function connect()
    {
        try {
            if ($this->connection === null) {
                $this->connection = new PDO(
                    "mysql:host=$this->host;
                    port=$this->port;
                    dbname=$this->db_name;
                    charset=$this->charset",
                    $this->user,
                    $this->password
                );
            }
            return $this->connection;
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
            return null;
        }
    }

    public function get_all($sql, $args = []){
        if($this->connect() === null) return null;
        $this->query = $this->connect()->prepare($sql);
        $this->query->execute($args);
        return $this->query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_single($sql, $args = []){
        if($this->connect() === null) return null;
        $this->query = $this->connect()->prepare($sql);
        $this->query->execute($args);
        return $this->query->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_db($sql, $args = []){
        $this->query = $this->connect()->prepare($sql);
        return ($this->query->execute($args)) ? $this->connect()->lastInsertId() : 0;
    }

    public function delete($sql, $args = []){
        $this->query = $this->connect()->prepare($sql);
        return $this->query->execute($args);
    }
}