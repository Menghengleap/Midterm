<?php
class Quote {
    private $conn;
    private $table_name = "quotes";

    // Object properties
    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Function to read all quotes with optional filtering by author_id and/or category_id
    public function read($author_id = null, $category_id = null) {
        $query = "SELECT q.id, q.quote, a.author, c.category 
                  FROM " . $this->table_name . " q
                  JOIN authors a ON q.author_id = a.id
                  JOIN categories c ON q.category_id = c.id";

        // Filter by author_id and category_id if provided
        $conditions = [];
        $parameters = [];

        if (!is_null($author_id)) {
            $conditions[] = 'q.author_id = :author_id';
            $parameters[':author_id'] = $author_id;
        }

        if (!is_null($category_id)) {
            $conditions[] = 'q.category_id = :category_id';
            $parameters[':category_id'] = $category_id;
        }

        if (!empty($conditions)) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($parameters);

        return $stmt;
    }

    // Fetching a single quote by ID
    public function readOne($id) {
        $query = "SELECT q.id, q.quote, a.author, c.category
                  FROM " . $this->table_name . " q
                  JOIN authors a ON q.author_id = a.id
                  JOIN categories c ON q.category_id = c.id
                  WHERE q.id = :id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        // Fetching the row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Checking if a row was returned
        if ($row) {
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author_id = $row['author'];
            $this->category_id = $row['category'];
            
            return true; // Found a quote
        }

        return false; // No quote found
    }


    // Creating a new quote
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)";
        $stmt = $this->conn->prepare($query);

        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // binding values
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Updating an existing quote
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET quote = :quote, author_id = :author_id, category_id = :category_id 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // binding values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Deleting a quote
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
}
