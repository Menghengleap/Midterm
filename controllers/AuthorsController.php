<?php
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../Database.php';

class AuthorsController {
    private $db;
    private $authorModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->authorModel = new Author($this->db);
    }

    // GET: /authors/
    public function getAuthors() {
        $stmt = $this->authorModel->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $authors_arr = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $author_item = [
                    "id" => $id,
                    "author" => $author
                ];
                array_push($authors_arr, $author_item);
            }
            http_response_code(200);
            echo json_encode($authors_arr);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "No authors found."]);
        }
    }

    // GET: /authors/?id=5
    public function getAuthor($id) {
        $this->authorModel->id = $id;

        if ($this->authorModel->readOne($id)) {
            $author_item = [
                "id" => $this->authorModel->id,
                "author" => $this->authorModel->author
            ];

            http_response_code(200);
            echo json_encode($author_item);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "author_id not found."]);
        }
    }

    // POST: /authors/
    public function createAuthor($data) {
        if (!empty($data['author'])) {
            $this->authorModel->author = $data['author'];

            if ($this->authorModel->create()) {
                http_response_code(201);
                echo json_encode(["message" => "Author created successfully."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to create author."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
        }
    }

    // PUT: /authors/
    public function updateAuthor($data) {
        if (!empty($data['id']) && !empty($data['author'])) {
            $this->authorModel->id = $data['id'];
            $this->authorModel->author = $data['author'];

            if ($this->authorModel->update()) {
                http_response_code(200);
                echo json_encode(["message" => "Author updated successfully."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to update author."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
        }
    }
    // DELETE: /authors/
    public function deleteAuthor($data) {
        $exists = $this->authorModel->readOne($data['id']);
        if (!$exists) {
            http_response_code(404);
            echo json_encode(["message" => "No Authors Found"]);
            return;
        }

        if (!empty($data['id'])) {
            $this->authorModel->id = $data['id'];

            if ($this->authorModel->delete()) {
                http_response_code(200);
                echo json_encode(["message" => "Author deleted successfully."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to delete author."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
        }
    }
}
