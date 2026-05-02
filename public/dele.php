<?php
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    require '../app/config/db.php';

    $sql = 'DELETE FROM memos WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
