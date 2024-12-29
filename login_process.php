<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Load the user data from XML
    $xml = simplexml_load_file('users.xml');
    foreach ($xml->user as $user) {
        if ($user->email == $email && $user->password == $password) {
            $_SESSION['username'] = (string)$user->username;

            // Redirect to the main page after successful login
            header('Location: index.html');
            exit;
        }
    }

    // Redirect to login page with an error message if login fails
    header('Location: login.html?error=invalid_credentials');
    exit;
}
?>
