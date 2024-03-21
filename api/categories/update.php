<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$categoryModel = new Category($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id']) && !empty($data['category'])) {
    $categoryModel->id = $data['id'];
    $categoryModel->category = $data['category'];
    if ($categoryModel->update()) {
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
