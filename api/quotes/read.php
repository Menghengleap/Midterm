<?php 
  // Headers //
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate DB & connection //
  $database = new Database();
  $db = $database->getConnection();

  // Instantiate quote object //
  $quo = new DBQuote($db);
  

  if (isset($_GET['author_id'])){
    $quo->author_id = $_GET['author_id'];
  }
  if (isset($_GET['category_id'])){
    $quo->category_id = $_GET['category_id'];
  }


  // Quote query //
  $result = $quo->GET();
  // Get row count //
  $num = $result->rowCount();

  // Check if any quotes //
  if($num > 0) {
    // Quote array //
    $quo_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $quo_item = array(
        'id' => $id,
        'quote' => $quote,
        'author' => $author_name,
        'category' => $category_name
      );

      // Push to "data" //
      array_push($quo_arr, $quo_item);
      
    }

    // Turn to JSON & output //
    $json_data = json_encode($quo_arr);

    // Decode HTML entities before echoing //
    echo htmlspecialchars_decode($json_data);
  } else {
    // No Quotes //
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
  }
// End of script //
?>
