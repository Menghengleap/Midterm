<?php
  // Define the necessary HTTP headers for the API response and CORS
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // Include the database and category model for operations
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Initialize and connect to the database
  $database = new Database();
  $db = $database->getConnection();

  // Create a new category instance for manipulation
  $cat = new DBCategory($db);

  // Extract the JSON content from the request body
  $data = json_decode(file_get_contents("php://input"));

  // Assign the provided ID to the category object for deletion
  $cat->id = $data->id;

  // Validate category existence before proceeding with deletion
  $test = curl_init('http://localhost/api/categories/?id=' . $cat->id);
    curl_setopt($test, CURLOPT_RETURNTRANSFER, true); // Ensure the cURL response is returned
    $response = curl_exec($test); // Perform the cURL session and receive response
    curl_close($test); // Terminate the cURL session
    $test2 = array_values(json_decode($response,true));
    if($test2[0] != $cat->id){

      echo json_encode(array(
          'message' => 'No Category Found' // Notify user if category does not exist
      ));
      exit();
    }

  // Proceed with category deletion if validation passes
  if($cat->delete()) {
    echo json_encode(
      array('id' => $cat->id) // Confirm successful deletion with category ID
    );
  } 
?>
