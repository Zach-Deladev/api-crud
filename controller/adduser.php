<?php
header('Content-Type:application/json');
header('Access-control-Allow-Origin: *');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// decode the json data
$data = json_decode(file_get_contents("php://input"), true);

// set the values from the json data
$fname = $data['fname'];
$lname = $data['lname'];
$email = $data['email'];

require_once('../model/database.php');
require_once('../model/users.php');

// create a new instance of the database class
$database = new Database();

// get the database connection
$conn = $database->getConnection();

// create a new instance of the User class
$user = new User($conn);

// check if the email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // email already exists, return error response
    echo json_encode(array("message" => "Email already exists", "status" => false));
} else {
    // email does not exist, insert user record using the createUser() method
    $user->fname = $fname;
    $user->lname = $lname;
    $user->email = $email;

    if ($user->createUser()) {
        echo json_encode(array("message" => "User record inserted", "status" => true));
    } else {
        echo json_encode(array("message" => "User record not inserted", "status" => false));
    }
}
