// Set initial form action when the page loads
document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector('form');
    form.action = "includes/login.inc.php"; // Set default action to login
});

// Switching between "Login" and "Sign Up"
function toggleForm() {
    let submitButton = document.getElementById('form-submit');
    let toggleButton = document.getElementById('form-context');
    let toggleButtonLabel = document.getElementById('form-context-label');
    let form = document.querySelector('form');
    let dealerCodeDiv = document.getElementById('dealer-code');
    let dealerCodeInput = dealerCodeDiv.querySelector('input[name="dealercode"]');

    if (submitButton.value === "Login") {
        // Sign up
        dealerCodeDiv.classList.remove('d-none');
        dealerCodeInput.required = true;
        submitButton.value = "Sign Up";
        submitButton.className = "btn btn-success";
        toggleButton.innerText = "Login";
        toggleButton.className = "btn btn-primary";
        toggleButtonLabel.innerText = "Existing user?";
        form.action = "includes/signup.inc.php"; // Change action for signup
    } else {
        // Login
        dealerCodeDiv.classList.add('d-none');
        dealerCodeInput.required = false;
        submitButton.value = "Login";
        submitButton.className = "btn btn-primary";
        toggleButton.innerText = "Sign Up";
        toggleButton.className = "btn btn-success";
        toggleButtonLabel.innerText = "New user?";
        form.action = "includes/login.inc.php"; // Change action for login
    }
}

// Submitting form (AJAX) and displaying server message
document.getElementById("user-form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission
    // Get the form data using the name attribute
    const USERNAME = document.querySelector("input[name='username']").value;
    const PASSWORD = document.querySelector("input[name='password']").value;
    let formAlert = document.getElementById('form-alert');
    let form = document.querySelector('form');

    const formData = new FormData();
    formData.append("username", USERNAME);
    formData.append("password", PASSWORD);
    // Only append dealercode for signup
    if (form.action.includes("signup.inc.php")) {
        const DEALERCODE = document.querySelector("input[name='dealercode']").value;
        formData.append("dealercode", DEALERCODE); // Fallback to default
    }
    fetch(form.action, {
        method: "POST",
        body: formData
    })
        .then(response => response.text()) // Expecting JSON response
        .then(text => {
            console.log(text);
            try {
                const data = JSON.parse(text); // Try parsing the response as JSON
                if (data.error) {
                    formAlert.textContent = data.error;
                    formAlert.className = "alert alert-danger mt-2";
                } else if (data.success) {
                    formAlert.textContent = data.success;
                    formAlert.className = "alert alert-success mt-2";
                }
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } catch (e) {
                console.error("Error parsing JSON: ", e);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
});