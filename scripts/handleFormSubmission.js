// Handles the form submission for the edit user form
async function handleFormSubmission(event) {
    event.preventDefault();
    // Get the form element
    const form = event.target;
    // Create a new FormData object
    const formData = new FormData(form);
    // Send a POST request to the form's action
    const response = await fetch(form.action, {
        method: 'POST',
        body: formData
    });
// Get the response as JSON
    const result = await response.json();

    // get the errors div
    const errorsDiv = document.querySelector('.errors');
    // clear the errors div
    errorsDiv.innerHTML = '';
// If the response is successful, redirect to the index page
    if (result.success) {
        sessionStorage.setItem('successMessage', 'User updated successfully.');
    window.location.href = './index.php';
    } else {
        // Otherwise, display the errors
        if (result.errors) {
            for (const error of result.errors) {
                const errorParagraph = document.createElement('p');
                errorParagraph.classList.add('text-danger');
                errorParagraph.innerText = error;
                errorsDiv.appendChild(errorParagraph);
            }
        } else {
            // If there are no errors, display a generic error message
            const errorParagraph = document.createElement('p');
            errorParagraph.classList.add('text-danger');
            errorParagraph.innerText = 'An error occurred while updating the user.';
            errorsDiv.appendChild(errorParagraph);
        }
    }
}
// Add an event listener to the dom 
document.addEventListener('DOMContentLoaded', function() {
    //
    const successMessage = sessionStorage.getItem('successMessage');
    if (successMessage) {
        // Get the success message div
        const successMessageDiv = document.getElementById('success-message');
        // Create a paragraph element
        const successParagraph = document.createElement('p');
        // Add the text-success class to the paragraph
        successParagraph.classList.add('text-success');
        // Set the paragraph's text to the success message
        successParagraph.innerText = successMessage;
        // Append the paragraph to the success message div
        successMessageDiv.appendChild(successParagraph);

        // Remove the success message from sessionStorage
        sessionStorage.removeItem('successMessage');
    }
});