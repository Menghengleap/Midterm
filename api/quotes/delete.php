<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../models/Quote.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$quoteModel = new Quote($db);

$data = json_decode(file_get_contents("php://input"), true);

// Checking if the quote exists
if (empty($data['id'])) {
    http_response_code(400);
    echo json_encode(["message" => "Missing Required Parameters"]);
    return;
}

if (!$quoteModel->readOne($data['id'])) {
    http_response_code(404);
    echo json_encode(["message" => "No Quotes Found"]);
    return;
}

// Attempting to delete the quote
if ($quoteModel->delete()) {
    http_response_code(200);
    echo json_encode(["message" => "Quote deleted successfully."]);
} else {
    http_response_code(503);
    echo json_encode(["message" => "Unable to delete quote."]);
}
