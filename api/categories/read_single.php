<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$categoryModel = new Category($db);

$id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'ID not provided']));

if ($categoryModel->readOne($id)) {
    $category_item = [
        "id" => $categoryModel->id,
        "category" => $categoryModel->category
    ];
    http_response_code(200);
    echo json_encode($category_item);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Category not found."]);
}