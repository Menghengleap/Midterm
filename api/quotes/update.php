<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../models/Quote.php';
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$quoteModel = new Quote($db);
$authorModel = new Author($db);
$categoryModel = new Category($db);

$data = json_decode(file_get_contents("php://input"), true);

// Check if all required parameters are provided
if (empty($data['id']) || empty($data['quote']) || empty($data['author_id']) || empty($data['category_id'])) {
    http_response_code(400);
    echo json_encode(["message" => "Missing Required Parameters"]);
    return;
}

// Verify if the provided author_id and category_id exist
if (!$authorModel->readOne($data['author_id'])) {
    http_response_code(404);
    echo json_encode(["message" => "author_id Not Found"]);
    return;
}

if (!$categoryModel->readOne($data['category_id'])) {
    http_response_code(404);
    echo json_encode(["message" => "category_id Not Found"]);
    return;
}

// Attempting to update the quote
$quoteModel->id = $data['id'];
$quoteModel->quote = $data['quote'];
$quoteModel->author_id = $data['author_id'];
$quoteModel->category_id = $data['category_id'];

if ($quoteModel->update()) {
    http_response_code(200);
    echo json_encode(["message" => "Quote updated successfully."]);
} else {
    http_response_code(503);
    echo json_encode(["message" => "Unable to update quote."]);
}
