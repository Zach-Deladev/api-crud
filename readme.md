# RESTful API with CRUD functionality – By Zach Delapenha

## CONTENTS

1. INTRODUCTION
2. MODEL
   - Database Scheme
   - Database Connection
   - User Class and Functions
3. VIEW
   - Create
   - Read
   - Update
   - Delete
4. CONTROLLER
   - Create
   - Read
   - Update
   - Delete

## INTRODUCTION

In this assignment, I was tasked to create an API to consume a minimal front end application with full CRUD functionality.
I also used the MVC pattern where the Model represents the data, the View represents the user interface, and the Controller handles the requests and responses.

## MODEL - Manages Data and Business Logic

### 1. Database Scheme

This database is very simple, it holds a users table in which the users information can be stored. This table is structured to store an auto-incremented (ID), a first name (fname), a last name (lname) and email address (email), there is also a column for the date of creation which is set to the current_timestamp.

### 2. Database Connection

My database.php file holds the Database class. This establishes a connection to the database and allows me to easily reuse the connection by calling the getConnection() function.

### 3. Users Object and Functions

My users.php file holds the User class which defines the properties of the database table and holds different functions. These functions can be called upon by different files to use the CRUD functionality.

The functions in this class include:

1. createUser() – this function insert a new user into the database.
2. getUsers() – this function reads the data from the users table allowing the database to be read.
3. updateUser() – this function updates a specific users data.
4. deleteUser() – this functions deletes a specified user from the database

## VIEW - Handles Layout and Display

### 1. CREATE

The Add user button will open a modal with an attached form where a new user can be added to the database.
The adduser.js file validates the form inputs based on the specified regex patterns on keyup and then surrounds the input with an orange border if the input does not meet the requirement or a green border if the input does meet the requirements.
Once all inputs are valid the form can be submitted, the adduser.js then sends a post request to adduser.php, if the users does not already exist in the database then the request is sent and the new user is created.

### 2. READ

The index.php displays a table which is dynamically rendered by my tabledata.php file with the data from the database.

### 3. UPDATE

The tabledata.php file changes the table row into a form if the edit button is clicked, this allows the users to update the users details without needing to be redirected to another page.

This form is handled by two files handleFormSubmission.js and update.php.

When the form is submitted the handleFormSubmission function sends a POST request to the update.php file and waits for a response. If the form data meets the form validation requirements of updata.php file then the success message is rendered in the div with the ID of success-message and the users information is updated. If the form data does not meet the requirements or there is another error then the div with the id of form-err will be populated with the error message and the form will not be submitted.

Because the function redirects the user to the index.php page if successful I had to store the success message in the sessionStorage and then add an event listener to the dom, once the event triggered a function would be called to retrieve the success message and displays it.

### 4. DELETE

The delete functionality is very simple. When the delete button is pressed the handleDelete.js file opens a confirm alert to the user to confirm they want to delete the user, if they user confirms the delete a request is sent to the delete.php file to handle the delete. If successful the pages refreshes displayed the data with that user removed.

## Controller - Routes commands to the model and view

### 1. adduser.php

Once the data request is received the adduser.php file decodes the JSON and stores the user data into variables.
It then creates a new instance of database and the user class.
The file then checks to see if the email received from the form matches any email in the database and throws an error if so. If there user is not already in the database then a new users is created.

### 2. tabledata.php

When the dom loads the tabledata.php creates a database connection and then selects all data from the database and renders it into a table.

### 3. update.php

The update.php file receives the POST data and stores it. It the creates an empty errors array. After this it checks to see if any of the fields were empty or do not match to the form validation requirements if there is any errors it stores them to the $errors array.
If there are no errors then the data is set in the user object and updated in the database.
If there is errors then the error messages are returned to the handleFormSubmission function to handle the errors and the user will not be updated.

### 4. delete.php

The delete.php file is very simple, it creates a new connection and user class instance and checks if an ID is present in the query string, if so it assigns it to the user id and calls the deletUser() function and deletes the user from the database.
If the id is missing it will return a response indicating the issue.
