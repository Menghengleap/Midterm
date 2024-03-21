<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$categoryModel = new Category($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id'])) {
    $categoryModel->id = $data['id'];
    if ($categoryModel->delete()) {
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
