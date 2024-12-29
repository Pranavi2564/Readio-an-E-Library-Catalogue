<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>READIO</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .book-carousel {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .genre-section {
            margin-top: 40px;
        }

        .genre-section h3 {
            text-align: center;
            color: #0076be;
            margin-bottom: 20px;
        }

        .book-card {
            flex: 0 1 calc(25% - 20px);
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .book-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .book-card h4 {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .book-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .book-card {
                flex: 0 1 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .book-card {
                flex: 0 1 calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <header class="top-header">
        <div class="archive-header">
            <a href="#" class="archive-logo">Internet Archive</a>
            <div class="header-right">
                <button class="donate-button">Donate</button>
                <select class="language-select">
                    <option value="en">English</option>
                    <option value="es">Español</option>
                    <option value="fr">Français</option>
                </select>
            </div>
        </div>
        <nav class="main-nav">
            <div class="nav-container">
                <a href="#" class="logo">Readio.</a>
                <div class="nav-links">
                    <a href="#books"><b>My Books</b></a>
                    <div class="dropdown">
                        <button class="dropbtn"><b>Browse</b></button>
                        <div class="dropdown-content">
                            <a href="#">Subjects</a>
                            <a href="#">Trending</a>
                            <a href="#">Library</a>
                        </div>
                    </div>
                </div>
                <div class="auth-buttons">
                    <a href="login.html"><button class="login-btn">Log In</button></a>
                    <a href="signup.html"><button class="signup-btn">Sign Up</button></a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- Welcome Section -->
        <section class="welcome-section">
            <h1>Welcome to Readio.</h1>
            <div class="features-container">
                <div class="feature-card">
                    <img src="https://openlibrary.org/static/images/onboarding/read.png" alt="Read Books">
                    <h3>Read Free Library Books Online</h3>
                    <p>Millions of books available through Controlled Digital Lending</p>
                </div>
                <div class="feature-card">
                    <img src="https://openlibrary.org/static/images/onboarding/reading_goal.svg" alt="Track Reading">
                    <h3>Set a Yearly Reading Goal</h3>
                    <p>Learn how to set a yearly reading goal and track what you read</p>
                </div>
                <div class="feature-card">
                    <img src="https://openlibrary.org/static/images/onboarding/track.png" alt="Organize Books">
                    <h3>Keep Track of Your Favorite Books</h3>
                    <p>Organize your books using lists & the Reading Log</p>
                </div>
            </div>
        </section>

        <!-- My Books Section -->
        <section id="books" class="ebooks-section">
            <h2>My Books</h2>
            <?php
            $xml = simplexml_load_file('ebooks.xml');
            $genres = [];
            foreach ($xml->book as $book) {
                $genres[(string)$book->genre][] = $book;
            }
            foreach ($genres as $genre => $books) {
                echo '<div class="genre-section">';
                echo '<h3>' . htmlspecialchars($genre) . '</h3>';
                echo '<div class="book-carousel">';
                foreach ($books as $book) {
                    echo '<div class="book-card">';
                    echo '<img src="' . htmlspecialchars($book->cover) . '" alt="' . htmlspecialchars($book->title) . ' Cover">';
                    echo '<h4>' . htmlspecialchars($book->title) . '</h4>';
                    echo '<p>Author: ' . htmlspecialchars($book->author) . '</p>';
                    echo '<p>Genre: ' . htmlspecialchars($book->genre) . '</p>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
        </section>

        <!-- Add a New Book Section -->
        <section class="add-book-section">
            <h2>Add a New Book</h2>
            <form action="add_book.php" method="post">
                <div class="form-group">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" required>
                </div>
                <div class="form-group">
                    <label for="cover">Cover Image URL:</label>
                    <input type="url" id="cover" name="cover" required>
                </div>
                <button type="submit">Add Book</button>
            </form>
        </section>

    </main>

    <footer>
        <p>&copy; 2024 Readio. All rights reserved.</p>
    </footer>
</body>
</html>
