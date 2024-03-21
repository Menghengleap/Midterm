<?php
class Author {
    private $conn;
    private $table_name = "authors";

    // Object properties
    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Reading all authors
    public function read() {
        $query = "SELECT id, author FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Creating a new author
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (author) VALUES (:author)";
        $stmt = $this->conn->prepare($query);

        $this->author = htmlspecialchars(strip_tags($this->author));

        // binding value
        $stmt->bindParam(':author', $this->author);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Updating an existing author
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET author = :author WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->author = htmlspecialchars(strip_tags($this->author));

        // binding values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':author', $this->author);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Deleting an author
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

    // Fetching a single author by ID
    public function readOne($id) {
        $query = "SELECT id, author FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if row is not empty
        if ($row) {
            $this->id = $row['id'];
            $this->author = $row['author'];
            return true;
        }

        return false;
    }
}
