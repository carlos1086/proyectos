<?php
class Database {
    private $host = '127.0.0.1';
    private $dbname = 'CGC_books'; // Cambiado el nombre de la base de datos
    private $username = 'usuCGC'; // Cambiado al usuario específico
    private $password = 'Tokio2324'; // Asegúrate de que coincida con lo que pusiste en ddl.sql
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
