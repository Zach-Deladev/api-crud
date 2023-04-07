<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../model/database.php';
include_once '../model/users.php';

// Create a new database connection and user object
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

// Check if an "id" parameter is present in the query string
if (isset($_GET['id'])) {
    // Assign the "id" parameter to the "id" property of the user object
    $user->id = $_GET['id'];

    // Call the deleteUser() method on the user object to delete the user
    if ($user->deleteUser()) {
        // Return a success response
        http_response_code(200);
        echo json_encode(["message" => "User deleted."]);
    } else {
        // Return an error response
        echo http_response_code(500);
        echo json_encode(["message" => "Data could not be deleted"]);
    }
} else {
    // Return an error response if the "id" parameter is missing
    echo http_response_code(400);
    echo json_encode(["message" => "Invalid or missing input data"]);
}
