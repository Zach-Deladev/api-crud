<?php
// include database and user files / classes
include_once './model/database.php';
include_once './model/users.php';

// creates a new instance of the database class and gets a database connection
$database = new Database();
$db = $database->getConnection();

// sets the user credentials from the request
$items = new User($db);

// SQL query to select all records from the users table
$sqlQuery = "SELECT id, fname, lname, email FROM " . $items->db_table;
// Executes the SQL query and stores the result in the $result variable
$result = mysqli_query($db, $sqlQuery);

while ($row = mysqli_fetch_assoc($result)) {

    echo "<tr>";
    // If the "id" parameter is set and matches the current row's id, display the edit form
    if (isset($_GET['id']) && $row['id'] == $_GET['id']) {
        echo '<div class="errors"></div>';
        echo '<form id="edit-data" class="form-inline m-2" action="./controller/update.php" method="POST" onsubmit="return handleFormSubmission(event);">';
        echo '<td><input type="text" class="form-control" name="fname" value="' . $row['fname'] . '"></td>';
        echo '<td><input type="text" class="form-control" name="lname" value="' . $row['lname'] . '"></td>';
        echo '<td><input type="email" class="form-control" name="email" value="' . $row['email'] . '"></td>';
        echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
        // hidden input to post id to form
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '</form>';
    } else {
        // If the "id" parameter is not set, display the table data
        echo "<div id='success-message'></div>";
        echo "<td>" . $row["fname"] . "</td>";
        echo "<td>" . $row["lname"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo '<td><a href="./index.php?id=' . $row['id'] . '" class="btn btn-primary edit" data-id="' . $row['id'] . '" role="button">Edit</a></td>';
    }
    echo '<td><a href="./controller/delete.php?id=' . $row['id'] . '" class="btn btn-danger delete" role="button">Delete</a></td>';
    echo "</tr>";
}
// close the database connection
$db->close();
