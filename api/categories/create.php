<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$categoryModel = new Category($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['category'])) {
    $categoryModel->category = $data['category'];
    if ($categoryModel->create()) {
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
