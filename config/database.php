<?php
// config/database.php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "DB_LATIHAN_PBO_TRPL1B_Dela_Apriyani"; // GANTI dengan nama database kamu
    public $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        // Cek koneksi
        if ($this->connection->connect_error) {
            die("Koneksi gagal: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
?>