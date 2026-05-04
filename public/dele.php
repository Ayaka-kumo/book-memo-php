<?php
require '../app/config/db.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = 'DELETE FROM memos WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: index.php');
    exit;
}

$sql = 'SELECT id, title FROM memos WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$memo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$memo) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書メモ削除</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="delete-page">
        <section class="delete-card">
            <h1>読書メモ削除</h1>
            <p class="delete-message">
                「<?php echo htmlspecialchars($memo['title'], ENT_QUOTES, 'UTF-8'); ?>」を削除しますか？
            </p>
            <p class="delete-note">削除したメモは元に戻せません。</p>

            <form class="delete-actions" action="dele.php?id=<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" method="post">
                <button class="button danger" type="submit">削除する</button>
                <a class="button" href="index.php">キャンセル</a>
            </form>
        </section>
    </main>
</body>

</html>
