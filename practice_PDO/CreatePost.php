<?php
require_once 'database.php';

$title = '';
$body = '';
$isSubmitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($isSubmitted && isset($_POST['submit'])) {
    echo 'test';
    $title = htmlspecialchars($_POST['title'] ?? '');
    $body = htmlspecialchars($_POST['body'] ?? '');

    $sql = 'INSERT INTO posts (title, body) VALUES (:title, :body) ';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'body' => $body]);

    header('Location: MainPage.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post - Study PDO Blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="createPost.css">
</head>

<body>
    <header>
        <h1>Study PDO Blog</h1>
    </header>
    <main>
        <form method="post">
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>


            <div>
                <label for="body">Body</label>
                <textarea id="body" name="body" required></textarea>
            </div>

            <div class="form-buttons">

                <button type="submit" name="submit">Create Post</button>
                <a href="MainPage.php"><button type="button">Back to Posts</button></a>
            </div>

        </form>
    </main>
</body>

</html>