<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->getConnection();

  // Instantiate Author post object
  $auth = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if ( !isset($data->author) )
    {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
    }

  $auth->author = $data->author;

  // Create post
  if($auth->CREATE()) {
    
    echo json_encode(array('id' => $db->lastInsertId(), 'author'=>$auth->author));
  }
