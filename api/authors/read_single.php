<?php
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../Database.php';

$db = (new Database())->getConnection();
$authorModel = new Author($db);

$id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'ID not provided']));

if ($authorModel->readOne($id)) {
    $author_item = [
        "id" => $authorModel->id,
        "author" => $authorModel->author
    ];
    http_response_code(200);
    echo json_encode($author_item);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Author not found."]);
}
