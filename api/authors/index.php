<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
require_once __DIR__ . '/../models/Quote.php';
require_once __DIR__ . '/../Database.php';

// Create a new database connection
$db = (new Database())->getConnection();

// Create a new instance of the Quote model
$quoteModel = new Quote($db);

// Fetch all quotes (no filtering parameters provided)
$stmt = $quoteModel->read();

// Fetch the quotes as an associative array
$quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if quotes were found
if ($quotes) {
    // Output the quotes as JSON
    echo json_encode($quotes);
} else {
    // No quotes found
    http_response_code(404);
    echo json_encode(["message" => "No quotes found"]);
}
?>
