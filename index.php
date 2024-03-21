<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'Database.php';
require_once 'controllers/QuotesController.php';
require_once 'controllers/AuthorsController.php';
require_once 'controllers/CategoriesController.php';

// Initializing the database connection
$database = new Database();
$db = $database->getConnection();

// Instantiating controllers
$quotesController = new QuotesController($db);
$authorsController = new AuthorsController($db);
$categoriesController = new CategoriesController($db);

// Parse the URL and extract the endpoint and parameters
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = str_replace("/api/", "", $request);
$params = explode('/', $request);
$endpoint = $params[0];
$method = $_SERVER['REQUEST_METHOD'];

function getRequestData() {
    if (strpos($_SERVER['CONTENT_TYPE'], "application/json") !== false) {
        $rawData = file_get_contents('php://input');
        return json_decode($rawData, true);
    } else {
        return $_POST;
    }
}

// Process the request
switch ($endpoint) {
    case 'quotes':
        if ($method == 'GET') {
            if (!empty($_GET['id'])) {
                $quotesController->getQuote($_GET['id']);
            } elseif (!empty($_GET['author_id']) || !empty($_GET['category_id'])) {
                $quotesController->getQuotes($_GET);
            } else {
                $quotesController->getQuotes([]);
            }
        } elseif ($method == 'POST') {
            $data = getRequestData();
            $quotesController->createQuote($data);
        } elseif ($method == 'PUT') {
            $data = getRequestData();
            $quotesController->updateQuote($data);
        } elseif ($method == 'DELETE') {
            $data = getRequestData();
            $quotesController->deleteQuote($data);
        }
        break;

    case 'authors':
        if ($method == 'GET') {
            if (!empty($_GET['id'])) {
                $authorsController->getAuthor($_GET['id']);
            } else {
                $authorsController->getAuthors();
            }
        } elseif ($method == 'POST') {
            $data = getRequestData();
            $authorsController->createAuthor($data);
        } elseif ($method == 'PUT') {
            $data = getRequestData();
            $authorsController->updateAuthor($data);
        } elseif ($method == 'DELETE') {
            $data = getRequestData();
            $authorsController->deleteAuthor($data);
        }
        break;

    case 'categories':
        if ($method == 'GET') {
            if (!empty($_GET['id'])) {
                $categoriesController->getCategory($_GET['id']);
            } else {
                $categoriesController->getCategories();
            }
        } elseif ($method == 'POST') {
            $data = getRequestData();
            $categoriesController->createCategory($data);
        } elseif ($method == 'PUT') {
            $data = getRequestData();
            $categoriesController->updateCategory($data);
        } elseif ($method == 'DELETE') {
            $data = getRequestData();
            $categoriesController->deleteCategory($data);
        }
        break;

    default:
        // Endpoint not found
        http_response_code(404);
        echo json_encode(["message" => "Endpoint not found."]);
        break;
}

