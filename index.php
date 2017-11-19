<?php
// Uncomment this to display errors when in dev
ini_set('display_errors', 1);

/**
 * Header definition for requests to be passed on the Web Services
 * Allow only GET, POST, PUT, DELETE and OPTIONS methods
 * Specify json as content
 */
$headers = apache_request_headers();
if (isset($headers) && !is_null($headers) && isset($headers['Origin'])) {
    $http_origin = $headers['Origin'];
    if (in_array($http_origin, Config::$ALLOWED_ORIGIN)) {
        header("Access-Control-Allow-Origin: " . $http_origin);
    }
}
header("Access-Control-Allow-Credentials: true");
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

if (isset($headers['authorization'])) {
    $token = $headers['authorization'];
}

// Call the service specified in url
$result = WebServices::execute($_SERVER['REQUEST_METHOD']);

// If request method is an OPTIONS or result is good return 200. Return 400 otherwise
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
} else if (!$result && !is_array($result)) {
//    http_response_code(400);
} else {
    echo json_encode($result);
    http_response_code(200);
}