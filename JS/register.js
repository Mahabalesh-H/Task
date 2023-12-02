function register() {
    // Validate form fields
    var formData = {
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
        phoneNumber: document.getElementById('phoneNumber').value,
        password: document.getElementById('password').value,
    };

    // Perform client-side validation
    if (!validateForm(formData)) {
        return;
    }

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Guvi/php/register.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Display the result on the page
                document.getElementById('registrationResult').textContent = xhr.responseText;
            } else {
                console.error('AJAX Error:', xhr.status, '-', xhr.statusText);
            }
        }
    };

    // Convert form data to URL-encoded format
    var urlEncodedData = Object.keys(formData)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(formData[key]))
        .join('&');

    xhr.send(urlEncodedData);
}

// Function to perform client-side validation
function validateForm(formData) {
    for (var key in formData) {
        if (!formData[key]) {
            alert('All fields are required.');
            return false;
        }
    }
    return true;
}
