<?php
// include database and user files / classes
include_once '../model/database.php';
include_once '../model/users.php';

// creates a new instance of the database class and gets a database connection
$database = new Database();
$db = $database->getConnection();

// creates a new instance of the user class
$item = new User($db);

// get the user data from the POST request
$data = $_POST;

// Validate the input fields
$errors = [];

if (empty($data['fname']) || !preg_match("/^[a-z\d]{3,12}$/i", $data['fname'])) {
    $errors[] = "Invalid first name.";
}
if (empty($data['lname']) || !preg_match("/^[a-z\d]{3,12}$/i", $data['lname'])) {
    $errors[] = "Invalid last name.";
}
if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
}

// If there are no errors, update the user data
if (empty($errors)) {
    // set the user data in the User object
    $item->id = $data['id'];
    $item->fname = $data['fname'];
    $item->lname = $data['lname'];
    $item->email = $data['email'];

    // update the user
    if ($item->updateUser()) {
        // Return a JSON response indicating success
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    } else {
        // Return a JSON response indicating failure
        header('Content-Type: application/json');
        echo json_encode(array('success' => false));
    }
} else {
    // Return a JSON response containing error messages
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'errors' => $errors));
}
