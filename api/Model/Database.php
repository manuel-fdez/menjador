<?php
class Database{

    private $host = "php_mariadb_joanpere";
    private $username = "joanpere";
    private $password = "ucauca";
    private $db = "menjador_db";
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (\PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
    
}