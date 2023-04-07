<?php
// user class file
class User
{
    // database connection and table name
    private $conn;
    public $db_table = "users";
    // object properties
    public $id;
    public $fname;
    public $lname;
    public $email;

    // constructor with $db as database connection
    public function __construct($db)
    {
        // Assign the database connection to the $conn property
        $this->conn = $db;
    }

    // Create a new user record function
    public function createUser()
    {
        // Create a new SQL query
        $sqlQuery = "INSERT INTO
                " . $this->db_table . "
            SET
                fname = ?, 
                lname = ?, 
                email = ?
                ";
        // Prepare the SQL query
        $stmt = $this->conn->prepare($sqlQuery);
        // Sanitize the input data
        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind the input data to the SQL query
        $stmt->bind_param("sss", $this->fname, $this->lname, $this->email);
        // Execute the SQL query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read users
    public function getUsers()
    {
        // Create a new SQL query
        $sqlQuery = "SELECT id, fname, lname, email, created FROM " . $this->db_table . "";
        // Prepare the SQL query
        $stmt = $this->conn->prepare($sqlQuery);
        // Execute the SQL query
        $stmt->execute();
        // Return the result
        $result = $stmt->get_result();
        // Return the result as an array
        return $result;
    }


    // Update a user record function
    public function updateUser()
    {
        // Create a new SQL query
        $sqlQuery = "UPDATE
            " . $this->db_table . "
        SET
            fname = ?,
            lname = ?,
            email = ?
        WHERE
            id = ?";
        // Prepare the SQL query
        $stmt = $this->conn->prepare($sqlQuery);
        // Sanitize the input data
        $this->fname = ($this->fname !== null) ? htmlspecialchars(strip_tags($this->fname)) : null;
        $this->lname = ($this->lname !== null) ? htmlspecialchars(strip_tags($this->lname)) : null;
        $this->email = ($this->email !== null) ? htmlspecialchars(strip_tags($this->email)) : null;
        $this->id = ($this->id !== null) ? htmlspecialchars(strip_tags($this->id)) : null;
        // Bind the input data to the SQL query
        $stmt->bind_param("sssi", $this->fname, $this->lname, $this->email, $this->id);
        // Execute the SQL query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a user record function
    function deleteUser()
    {
        // Create a new SQL query
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        // Sanitize the input data
        $this->id = htmlspecialchars(strip_tags($this->id));
        //  Bind the input data to the SQL query
        $stmt->bind_param("i", $this->id);
        // Execute the SQL query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
