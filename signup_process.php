<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Load the existing XML file
    $xml = simplexml_load_file('users.xml');

    // Check if email already exists
    foreach ($xml->user as $user) {
        if ($user->email == $email) {
            header('Location: signup.html?error=email_taken');
            exit;
        }
    }

    // Create a new user entry
    $newUser = $xml->addChild('user');
    $newUser->addChild('username', $username);
    $newUser->addChild('email', $email);
    $newUser->addChild('password', $password);

    // Save the updated XML file
    $xml->asXML('users.xml');

    // Redirect to login page
    header('Location: login.html?success=registered');
    exit;
}
?>
