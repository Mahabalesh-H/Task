function login() {
    // Validate form fields
    var formData = {
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    // Perform client-side validation
    if (!validateForm(formData)) {
        return;
    }

    // Send data to the server using fetch
    fetch('/Guvi/php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(formData).toString(),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Store the username in localStorage
                localStorage.setItem('userEmail', formData.email);
                window.location.href = 'profile.html';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error.message);
        });
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
