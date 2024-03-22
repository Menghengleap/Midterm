<?php
    // Configure headers for CORS and content type to enable API access from any origin
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD']; // Determine the HTTP method type of the request

    // Respond to preflight requests in CORS context
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); // Specify allowed methods
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With'); // Specify allowed headers
        exit(); 
    }
    
    // Process request based on HTTP method
    if ($method === 'GET') {
        try {
            // Load different resources based on the presence of an ID parameter
            if (isset($_GET['id'])){
                require_once 'read_single.php'; 
            }
            else{
                require_once 'read.php'; 
            }

        }
        catch(ErrorException $e) // Handle exceptions during file loading
        {
            echo("Required file not found!"); // Error message for file load failure
        }
    }
    else if ($method === 'POST') {
        try {
            require_once 'create.php'; 

        }
        catch(ErrorException $e) 
        {
            echo("Required file not found!"); 
        }
    }
    else if ($method === 'PUT') {
        try {
            require_once 'update.php'; 

        }
        catch(ErrorException $e) 
        {
            echo("Required file not found!"); 
        }
    }
    else if ($method === 'DELETE') {
        try {
            require_once 'delete.php'; 

        }
        catch(ErrorException $e)
        {
            echo("Required file not found!"); 
        }
    }
    else // Respond if the HTTP method is not supported by this script
        echo ("No function requested"); // Error message for unsupported or missing method
?>
