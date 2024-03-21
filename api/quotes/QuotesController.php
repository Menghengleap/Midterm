<?php
require_once __DIR__ . '/../models/Quote.php';
require_once __DIR__ . '/../Database.php';



class QuotesController {
    private $db;
    private $quoteModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->quoteModel = new Quote($this->db);
    }

    // Getting all quotes
    public function getQuotes($params) {
        $author_id = $params['author_id'] ?? null;
        $category_id = $params['category_id'] ?? null;

        $stmt = $this->quoteModel->read($author_id, $category_id);
        $num = $stmt->rowCount();

        if ($num > 0) {
            $quotes_arr = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $quote_item = [
                    "id" => $id,
                    "quote" => $quote,
                    "author" => $author,
                    "category" => $category
                ];
                array_push($quotes_arr, $quote_item);
            }
            http_response_code(200);
            echo json_encode($quotes_arr);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "No Quotes Found"]);
        }
    }

    public function getQuote($id) {
        if ($this->quoteModel->readOne($id)) {
            $quote = [
                "id" => $this->quoteModel->id,
                "quote" => $this->quoteModel->quote,
                "author" => $this->quoteModel->author_id,
                "category" => $this->quoteModel->category_id,
            ];
            http_response_code(200);
            echo json_encode($quote);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "No Quote Found"]);
        }
    }

    public function createQuote($data) {
        // Checking if all required parameters are provided
        if (empty($data['quote']) || empty($data['author_id']) || empty($data['category_id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        // Verifying if the provided author_id exists
        require_once __DIR__ . '/../models/Author.php';
        $authorModel = new Author($this->db);
        if (!$authorModel->readOne($data['author_id'])) {
            http_response_code(404);
            echo json_encode(["message" => "author_id Not Found"]);
            return;
        }

        // Verify if the provided category_id exists
        require_once __DIR__ . '/../models/Category.php';
        $categoryModel = new Category($this->db);
        if (!$categoryModel->readOne($data['category_id'])) {
            http_response_code(404);
            echo json_encode(["message" => "category_id Not Found"]);
            return;
        }

        $this->quoteModel->quote = $data['quote'];
        $this->quoteModel->author_id = $data['author_id'];
        $this->quoteModel->category_id = $data['category_id'];

        if ($this->quoteModel->create()) {
            http_response_code(201);
            echo json_encode(["message" => "Quote created successfully."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Unable to create quote."]);
        }
    }


    public function updateQuote($data) {
        // Check if all required parameters are provided
        if (empty($data['quote']) || empty($data['author_id']) || empty($data['category_id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        // Verify if the provided author_id exists
        require_once __DIR__ . '/../models/Author.php';
        $authorModel = new Author($this->db);
        if (!$authorModel->readOne($data['author_id'])) {
            http_response_code(404);
            echo json_encode(["message" => "author_id Not Found"]);
            return;
        }

        // Verify if the provided category_id exists
        require_once __DIR__ . '/../models/Category.php';
        $categoryModel = new Category($this->db);
        if (!$categoryModel->readOne($data['category_id'])) {
            http_response_code(404);
            echo json_encode(["message" => "category_id Not Found"]);
            return;
        }
        $this->quoteModel->id = $data['id'];
        $this->quoteModel->quote = $data['quote'];
        $this->quoteModel->author_id = $data['author_id'];
        $this->quoteModel->category_id = $data['category_id'];

        if ($this->quoteModel->update()) {
            http_response_code(200);
            echo json_encode(["message" => "Quote updated successfully."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Unable to update quote."]);
        }
    }

    public function deleteQuote($data) {
        // Checking if the quote exists
        $exists = $this->quoteModel->readOne($data['id']);
        if (!$exists) {
            http_response_code(404);
            echo json_encode(["message" => "No Quotes Found"]);
            return;
        }

        if (!empty($data['id'])) {
            $this->quoteModel->id = $data['id'];

            if ($this->quoteModel->delete()) {
                http_response_code(200);
                echo json_encode(["message" => "Quote deleted successfully."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to delete quote."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
        }
    }
}
