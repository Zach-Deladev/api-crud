// Handles the delete button on the users table
document.addEventListener("DOMContentLoaded", function () {
  // Get all the delete buttons
    const deleteButtons = document.querySelectorAll(".delete");
  // Loop through the buttons
    deleteButtons.forEach((button) => {
      // Add an event listener to each button
      button.addEventListener("click", function (e) {
    
        e.preventDefault();
  // Ask the user to confirm they want to delete the user
        const confirmation = confirm("Are you sure you want to delete this user?");
  // If the user confirms, send a request to the server
        if (confirmation) {
          // Create a new XMLHttpRequest object
          const xhr = new XMLHttpRequest();
          // Open a GET request to the href of the button
          xhr.open("GET", e.target.href);
          // Set the request header to json
          xhr.setRequestHeader("Content-Type", "application/json");
  // When the request is ready, check the status code
          xhr.onreadystatechange = function () {
           
            if (this.readyState == 4 && this.status == 200) {
              // Parse the response
              const response = JSON.parse(this.responseText);
              // Log the response
              console.log(response);
  // If the response message is "User deleted", reload the page
              if (response.message === "User deleted.") {
                // Reload the page
                window.location.reload();
              } else {
                // Otherwise, log the error
                console.error("Error:", response.message);
              }
            }
          };
  // Send the request
          xhr.send();
        }
      });
    });
  });