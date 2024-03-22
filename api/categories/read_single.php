<?php
  // Set up HTTP headers for cross-origin resource sharing and response format
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  // Include database and model files for category functionality
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Establish a new database connection
  $database = new Database();
  $db = $database->getConnection();

  // Prepare a new category instance for database interaction
  $cat = new DBCategory($db);

  // Retrieve the category ID from the query string
  $cat->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Fetch details of a single category based on the ID
  $cat->read_single();

  // Compile the category details into an associative array
  $category_arr = array(
    'id' => $cat->id,
    'category' => $cat->category
  );

  // Check if the category exists and output its details in JSON format
  if($category_arr['category'] != null){
    // Convert array to JSON for API response
    echo json_encode($category_arr);
  } else {
    // Respond with an error message if the category does not exist
    echo json_encode(
      array('message' => 'category_id Not Found')
    );
  }
?>
