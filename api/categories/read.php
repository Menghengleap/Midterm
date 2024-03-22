<?php 
  // Define access control and content type for the response
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  // Include database configuration and category model
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Set up a new database instance and establish a connection
  $database = new Database();
  $db = $database->getConnection();

  // Create a new instance of the Category class
  $cat = new DBCategory($db);

  // Execute the read method to retrieve all categories
  $result = $cat->GET();
  
  // Count the number of rows returned
  $num = $result->rowCount();

  // Validate the presence of category entries
  if($num > 0) {
        // Initialize an array to store category data
        $cat_arr = array();
        
        // Retrieve each row and add it to the category array
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          // Construct a category item array
          $cat_item = array(
            'id' => $id,
            'category' => $category
          );

          // Add the category item to the main array
          array_push($cat_arr, $cat_item);
        }

        // Encode the array as JSON and output it
        echo json_encode($cat_arr);

  } else {
        // Respond with a message if no categories exist
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
?>
