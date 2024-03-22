<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->getConnection();

  // Instantiate Category post object
  $cat = new DBCategory($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if ( !isset($data->category) )
    {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
    }

  $cat->category = $data->category;

  // Create Category
  if($cat->create()) {
    echo json_encode(array('id' => $db->lastInsertId(), 'category'=>$cat->category));
  }