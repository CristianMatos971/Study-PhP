<?php
require_once 'database.php';

$isDeleteRequest = ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'delete');

if ($isDeleteRequest) {
    $sql = 'DELETE FROM posts WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_POST['id']]);
}
header('Location: MainPage.php');
exit;
