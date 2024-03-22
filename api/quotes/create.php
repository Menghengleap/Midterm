<?php 
  // Set CORS headers and specify content type for the API response
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Include database configuration and model files for Quote, Author, and Category
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  include_once '../../models/Author.php';
  include_once '../../models/Category.php';

  // Connect to the database
  $database = new Database();
  $db = $database->getConnection();

  // Prepare a new instance for the Quote entity
  $quo = new DBQuote($db);

  // Initialize Author and Category objects for validation
  $auth = new Author($db);
  $cat = new DBCategory($db);

  // Decode the incoming data from the request
  $data = json_decode(file_get_contents("php://input"));

  // Verify that all necessary data is provided
  if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
      echo json_encode(array('message' => 'Missing Required Parameters'));
      exit();
  }

  // Set the Quote, Author, and Category details from the provided data
  $quo->quote = $data->quote;
  $quo->author_id = $data->author_id;
  $quo->category_id = $data->category_id;

  // Assign IDs for Author and Category to fetch their records
  $auth->id = $data->author_id;
  $cat->id = $data->category_id;

    // Validate the existence of the specified category
    $cat->read_single();
    if(!$cat->category){
        echo json_encode(array('message' => 'category_id Not Found'));
        exit ();
    }
    // Validate the existence of the specified author
    $auth->read_single();
    if(!$auth->author){
        echo json_encode(array('message' => 'author_id Not Found'));
        exit();
    }

  // Attempt to create the new Quote and respond
  if($quo->CREATE()) {
    // Retrieve and send the newly created Quote ID along with its details
    $quo->id = $db->lastInsertId();
    $quo_arr = array(
      'id' => $quo->id,
      'quote' => $quo->quote,
      'author_id' => $quo->author_id,
      'category_id' => $quo->category_id,
    );
    echo json_encode($quo_arr);
  } else {
    // Respond with an error if the Quote could not be created
    echo json_encode(
      array('message' => 'Quote Not Created')
    );
  }
?>
