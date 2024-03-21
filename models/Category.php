<?php
class Category {
    private $conn;
    private $table_name = "categories";

    // Object properties
    public $id;
    public $category;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Reading all categories
    public function read() {
        $query = "SELECT id, category FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Creating a new category
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (category) VALUES (:category)";
        $stmt = $this->conn->prepare($query);

        $this->category = htmlspecialchars(strip_tags($this->category));

        // binding value
        $stmt->bindParam(':category', $this->category);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Updating an existing category
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET category = :category WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));

        // binding values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Deleting a category
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        // binding id of record to delete
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Fetching a single category by ID
    public function readOne($id) {
        $query = "SELECT id, category FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if row is not empty
        if ($row) {
            $this->id = $row['id'];
            $this->category = $row['category'];
            return true;
        }

        return false;
    }
}
