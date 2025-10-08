<?php
require_once 'database.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;
$title = '';
$body = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title'] ?? '');
    $body = htmlspecialchars($_POST['body'] ?? '');
    $sql = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'body' => $body, 'id' => $id]);
    header('Location: MainPage.php');
    exit;
} elseif ($id) {
    $sql = 'SELECT * FROM posts WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($post) {
        $title = $post['title'];
        $body = $post['body'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Study PDO Blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="createPost.css">
</head>

<body>
    <header>
        <h1>Edit Post!</h1>
    </header>
    <main>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required value="<?= htmlspecialchars($title) ?>">
            </div>
            <div>
                <label for="body">Body</label>
                <textarea id="body" name="body" required><?= htmlspecialchars($body) ?></textarea>
            </div>
            <div class="form-buttons">
                <button type="submit" name="submit">Apply Changes</button>
                <a href="MainPage.php"><button type="button">Back to Posts</button></a>
            </div>
        </form>
    </main>
</body>

</html>