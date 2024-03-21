<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once __DIR__ . '/../models/Quote.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$quoteModel = new Quote($db);

$id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'ID not provided']));

if ($quoteModel->readOne($id)) {
    $quote = [
        "id" => $quoteModel->id,
        "quote" => $quoteModel->quote,
        "author_id" => $quoteModel->author_id,
        "category_id" => $quoteModel->category_id,
    ];
    http_response_code(200);
    echo json_encode($quote);
} else {
    http_response_code(404);
    echo json_encode(["message" => "No Quote Found"]);
}
