<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $genre = htmlspecialchars($_POST['genre']);
    $cover = htmlspecialchars($_POST['cover']);

    // Load the existing XML file
    $xml = simplexml_load_file('ebooks.xml');

    // Create a new book entry
    $newBook = $xml->addChild('book');
    $newBook->addChild('title', $title);
    $newBook->addChild('author', $author);
    $newBook->addChild('genre', $genre);
    $newBook->addChild('cover', $cover);

    // Save the updated XML file
    $xml->asXML('ebooks.xml');

    // Redirect back to the main page
    header('Location: index.php');
    exit;
}
?>
