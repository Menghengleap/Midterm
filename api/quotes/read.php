<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . '/../models/Quote.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$quoteModel = new Quote($db);
$params = []; // Add filtering logic if necessary

$stmt = $quoteModel->read($params['author_id'] ?? null, $params['category_id'] ?? null);
$num = $stmt->rowCount();

if ($num > 0) {
    $quotes_arr = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quotes_arr[] = [
            "id" => $id,
            "quote" => $quote,
            "author_id" => $author_id,
            "category_id" => $category_id,
        ];
    }
    http_response_code(200);
    echo json_encode($quotes_arr);
} else {
    http_response_code(404);
    echo json_encode(["message" => "No Quotes Found"]);
}
