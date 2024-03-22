<?php
  // Define headers to allow API access and set the content type to JSON
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Include the necessary database and model files
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  
  // Create a database instance and establish a connection
  $database = new Database();
  $db = $database->getConnection();

  // Initialize a new Category instance
  $cat = new DBCategory($db);

  // Validate the presence of essential parameters
  if(!isset($data->id) || !isset($data->category)){
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
  }

  // Assign the category ID and name from the request
  $cat->id = $data->id;
  $cat->category = $data->category;

  // Prepare the category information array
  $category_arr = array(
    'id' => $cat->id,
    'category' => $cat->category
  );

  // Attempt to update the category and respond accordingly
  if($cat->update()) {
    echo json_encode($category_arr); // Send the updated category details
  } else {
    echo json_encode(
      array('message' => 'Category not updated') // Notify on failure to update
    );
  }
?>
