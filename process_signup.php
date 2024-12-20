<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address");
    }

    // Store user in database (optional)
    // Here, you can add database logic to store the user information

    // Send the email
    $subject = "Welcome to PharmEase!";
    $message = "
        <html>
        <head>
            <title>Welcome to PharmEase!</title>
        </head>
        <body>
            <h2>Hello, $fullname!</h2>
            <p>Thank you for signing up with PharmEase. We're thrilled to have you!</p>
            <p>Explore our platform and start selling OTC products today.</p>
            <p>If you have any questions, feel free to contact us at support@pharmease.com.</p>
        </body>
        </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: support@pharmease.com" . "\r\n";

    // Send email
    if (mail($email, $subject, $message, $headers)) {
        echo "Thank you for signing up! A confirmation email has been sent to $email.";
    } else {
        echo "Error: Unable to send the email.";
    }
} else {
    echo "Invalid request.";
}
?>
