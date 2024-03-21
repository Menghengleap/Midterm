<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$authorModel = new Author($db);

$stmt = $authorModel->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $authors_arr = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $author_item = ["id" => $id, "author" => $author];
        array_push($authors_arr, $author_item);
    }
    http_response_code(200);
    echo json_encode($authors_arr);
} else {
    http_response_code(404);
    echo json_encode(["message" => "No authors found."]);
}
