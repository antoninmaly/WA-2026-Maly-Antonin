<?php
require_once 'Database.php';

class Book {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO books (title, author, category, subcategory, year, price, isbn, description, link) 
                VALUES (:title, :author, :category, :subcategory, :year, :price, :isbn, :description, :link)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data); 
    }
}