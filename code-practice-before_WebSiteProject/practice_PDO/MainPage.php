<?php
require 'database.php';

//fetch all posts:
$sql = 'SELECT * FROM posts';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            <?php foreach ($results as $post): ?>

                <div class="post">
                    <a href="post.php?id=<?= $post['id'] ?>">
                        <div class="title"> <?= $post['title'] ?> </div>
                    </a>

                    <div class="body"><?= $post['body'] ?></div>
                </div>

            <?php endforeach; ?>
        </section>

        <div class="button">
            <a href="CreatePost.php"><button>Create</button></a>
        </div>
    </main>
</body>

</html>