<?php
require_once 'database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: MainPage.php');
    exit;
}

$sql = 'Select * FROM posts WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['body'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];

    $sql = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'body' => $body, 'id' => $id]);

    header('Location: MainPage.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice PDO Blog</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Study PDO Blog</h1>
    </header>
    <main>
        <section class="posts" id="posts">
            <div class="post">
                <div class="title"> <?= $post['title'] ?> </div>
                <div class="body"><?= $post['body'] ?></div>
            </div>
        </section>

        <a href="MainPage.php"><button type="button">Back to Posts</button></a>

        <div class="delete-button">
            <form action="delete.php" method="post">
                <input type="hidden" name="_method" value="delete">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <button type="submit" name="submit">Delete</button>
            </form>
        </div>

        <div class="edit-button">
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <button type="submit">Edit</button>
            </form>
        </div>


    </main>
</body>

</html>