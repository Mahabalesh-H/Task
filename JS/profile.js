// Assume you have stored the user's email in local storage during login
var userEmail = localStorage.getItem(userEmail);

$(document).ready(function () {
    // Assume you have stored the user's email in local storage during login
    var userEmail = localStorage.getItem("userEmail");

    // Fetch user details based on email
    $.ajax({
        type: 'GET',
        url: '/Guvi/php/profile.php',
        data: { email: userEmail },
        success: function (response) {
            var user = JSON.parse(response);

            if (user.error) {
                // Handle the case where the user is not found
                console.error('User not found:', user.error);
            } else {
                // Update the HTML with user details
                $('#firstName').text(user.firstName);
                $('#lastName').text(user.lastName);
                $('#email').text(user.email);
                $('#phoneNumber').text(user.phoneNumber);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, '-', error);
        }
    });
});
