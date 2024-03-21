<?php
require_once __DIR__ . '/../models/Quote.php';
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$quoteModel = new Quote($db);
$authorModel = new Author($db);
$categoryModel = new Category($db);

$data = json_decode(file_get_contents("php://input"), true);

// Checking if all required parameters are provided
if (empty($data['quote']) || empty($data['author_id']) || empty($data['category_id'])) {
    http_response_code(400);
    echo json_encode(["message" => "Missing Required Parameters"]);
    return;
}

// Verifying existence of author and category
if (!$authorModel->readOne($data['author_id']) || !$categoryModel->readOne($data['category_id'])) {
    http_response_code(404);
    echo json_encode(["message" => "author_id or category_id Not Found"]);
    return;
}

// Attempting to create quote
$quoteModel->quote = $data['quote'];
$quoteModel->author_id = $data['author_id'];
$quoteModel->category_id = $data['category_id'];

if ($quoteModel->create()) {
    http_response_code(201);
    echo json_encode(["message" => "Quote created successfully."]);
} else {
    http_response_code(503);
    echo json_encode(["message" => "Unable to create quote."]);
}
