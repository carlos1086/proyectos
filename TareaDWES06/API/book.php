<?php
require_once 'database.php';

class Book {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para obtener todos los libros
    public function getAll() {
        $query = "SELECT * FROM books";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // Cambié el tipo de retorno a objetos en lugar de arrays
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para crear un nuevo libro
    public function create($title, $author, $year) {
        // Verifica si las propiedades existen
        $query = "INSERT INTO books (title, author, year) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Ejecuta la consulta con los parámetros correctos
        return $stmt->execute([$title, $author, $year]);
    }
    

    // Método para actualizar un libro existente
    public function update($title, $author, $year, $id) {
        // Comprobamos si el libro existe
        $query = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        $book = $stmt->fetch(PDO::FETCH_OBJ);
    
        if (!$book) {
            return false;  // Si el libro no existe, devolvemos false
        }
    
        // Si el libro existe, lo actualizamos
        $query = "UPDATE books SET title = ?, author = ?, year = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$title, $author, $year, $id]);
    }
    

    // Método para eliminar un libro
    public function delete($id) {
        $stmt = $this->conn->prepare($query = "DELETE FROM books WHERE id = ?");
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0)
            return true;
        return false;
    }
}
