<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

class CategoriesController {
    private $db;
    private $categoryModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new Category($this->db);
    }

    // GET: /categories/
    public function getCategories() {
        $stmt = $this->categoryModel->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $categories_arr = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $category_item = [
                    "id" => $id,
                    "category" => $category
                ];
                array_push($categories_arr, $category_item);
            }
            http_response_code(200);
            echo json_encode($categories_arr);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "No categories found."]);
        }
    }

    // GET: /categories/?id=5
    public function getCategory($id) {
        $this->categoryModel->id = $id;

        if ($this->categoryModel->readOne($id)) {
            $category_item = [
                "id" => $this->categoryModel->id,
                "category" => $this->categoryModel->category
            ];

            http_response_code(200);
            echo json_encode($category_item);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "category_id not found."]);
        }
    }

    // POST: /categories/
    public function createCategory($data) {
        if (!empty($data['category'])) {
            $this->categoryModel->category = $data['category'];

            if ($this->categoryModel->create()) {
                http_response_code(201);
                echo json_encode(["message" => "Category created successfully."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to create category."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
        }
    }

    // PUT: /categories/
    public function updateCategory($data) {
        if (!empty($data['id']) && !empty($data['category'])) {
            $this->categoryModel->id = $data['id'];
            $this->categoryModel->category = $data['category'];

            if ($this->categoryModel->update()) {
                http_response_code(200);
                echo json_encode(["message" => "Category updated successfully."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to update category."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
        }
    }
    // DELETE: /categories/
    public function deleteCategory($data) {
        $exists = $this->categoryModel->readOne($data['id']);
        if (!$exists) {
            http_response_code(404);
            echo json_encode(["message" => "No Categories Found"]);
            return;
        }

        if (!empty($data['id'])) {
            $this->categoryModel->id = $data['id'];

            if ($this->categoryModel->delete()) {
                http_response_code(200);
                echo json_encode(["message" => "Category deleted successfully."]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to delete category."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
        }
    }
}
