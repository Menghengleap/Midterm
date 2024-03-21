<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$categoryModel = new Category($db);

$stmt = $categoryModel->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $categories_arr = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $categories_arr[] = [
            "id" => $row['id'],
            "category" => $row['category']
        ];
    }
    http_response_code(200);
    echo json_encode($categories_arr);
} else {
    http_response_code(404);
    echo json_encode(["message" => "No categories found."]);
}
