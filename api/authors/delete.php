<?php
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$authorModel = new Author($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id'])) {
    $authorModel->id = $data['id'];

    if ($authorModel->delete()) {
        http_response_code(200);
        echo json_encode(["message" => "Author deleted successfully."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to delete author."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Missing Required Parameters"]);
}
