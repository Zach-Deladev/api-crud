<?php

// database class file
class Database
{
    // database connection properties
    private $host = "localhost";
    private $database_name = "crud";
    private $username = "root";
    private $password = "";

    // database connection
    public $conn;
    // database connection function
    public function getConnection()
    {
        // set the connection to null
        $this->conn = null;
        // create a new connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database_name);
        // Check if the connection was successful
        if ($this->conn->connect_errno) {
            // If the connection was not successful, display the error message
            echo "Failed to connect to the database: " . $this->conn->connect_error;
            // Set the connection to null
            $this->conn = null;
        } else {
            // If the connection was successful, set the character set to utf8
            $this->conn->set_charset("utf8");
        }
        // Return the connection
        return $this->conn;
    }
}
