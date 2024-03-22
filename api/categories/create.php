<?php
  // Set HTTP headers for API access control and response format
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Link to database and category model files
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  
  // Establish database connection through instantiated DB class
  $database = new Database();
  $db = $database->getConnection();

  // Create a new instance of the category class for operations
  $cat = new DBCategory($db);

  // Decode JSON input from the request body
  $data = json_decode(file_get_contents("php://input"));

  // Check for the presence of category data in request
  if (!isset($data->category)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
  }

  // Assign decoded data to category object property
  $cat->category = $data->category;

  // Attempt to insert new category record into database
  if($cat->CREATE()) {
    echo json_encode(array('id' => $db->lastInsertId(), 'category' => $cat->category));
  }
?>
