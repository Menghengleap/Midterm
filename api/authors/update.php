<?php
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$authorModel = new Author($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id']) && !empty($data['author'])) {
    $authorModel->id = $data['id'];
    $authorModel->author = $data['author'];

    if ($authorModel->update()) {
        http_response_code(200);
        echo json_encode(["message" => "Author updated successfully."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to update author."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Missing Required Parameters"]);
}
