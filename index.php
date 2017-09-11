<?php
// Uncomment this to display errors when in dev
ini_set('display_errors', 1);

/**
 * Header definition for requests to be passed on the Web Services
 * Allow only GET, POST, PUT, DELETE and OPTIONS methods
 * Specify json as content
 */
header("Access-Control-Allow-Origin: http://localhost:8080");
//header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header('Content-Type: application/json; charset=utf-8');

/**
 * Autoloader which load files based on class names and their package
 *
 * @param $class_name
 */
function __autoload($class_name)
{
    $file = './' . str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file)) {
        include_once $file;
        return;
    }
}

$token = null;
$headers = apache_request_headers();
if(isset($headers['authorization'])){
    $token = $headers['authorization'];
}

//var_dump($headers);

// Call the service specified in url
$result = WebServices::execute($_SERVER['REQUEST_METHOD']);

// If the service answer a good response, display the result encoded in JSON, display an error otherwise
if (!$result && !is_array($result)) {
    echo 'Bad Request';
//    http_response_code(400);
} else {
    echo json_encode($result);
//    http_response_code(200);
}