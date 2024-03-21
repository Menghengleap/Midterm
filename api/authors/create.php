<?php
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$authorModel = new Author($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['author'])) {
    $authorModel->author = $data['author'];

    if ($authorModel->create()) {
        http_response_code(201);
        echo json_encode(["message" => "Author created successfully."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to create author."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Missing Required Parameters"]);
}
