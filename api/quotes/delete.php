<?php 
  // Set HTTP headers for cross-origin requests and specify the response format as JSON
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Link the database and quote model for database interaction
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Create a database object and establish a connection
  $database = new Database();
  $db = $database->getConnection();

  // Prepare a new quote instance for data manipulation
  $quo = new DBQuote($db);

  // Decode the input data from the client
  $data = json_decode(file_get_contents("php://input"));

  // Assign the provided ID to the quote for deletion
  $quo->id = $data->id;

  // Validate the existence of the quote before deletion
  $test = curl_init('http://localhost/api/quotes/?id=' . $quo->id);
  curl_setopt($test, CURLOPT_RETURNTRANSFER, true); // Ensure the response from cURL is returned
  $response = curl_exec($test); // Perform the request and receive the response
  curl_close($test); // Terminate the cURL session
  $test2 = array_values(json_decode($response, true));
  if ($test2[0] != $quo->id) {
    echo json_encode(array(
        'message' => 'No Quotes Found' // Notify client if no matching quotes were found
    ));
    exit();
  }

  // Proceed with quote deletion and provide feedback
  if ($quo->delete()) {
    echo json_encode(
      array('id' => $quo->id) // Confirm deletion with the quote's ID
    );
  }
?>
