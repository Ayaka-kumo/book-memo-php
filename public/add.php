<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $memo = $_POST['memo'] ?? '';
    $created_at = $_POST['created_at'] ?? '';

    if ($title === '' || $summary === '' || $memo === '' || $created_at === '') {
        $error = 'すべての項目を入力してください。';
    } else {
        require '../app/config/db.php';

        $sql = 'INSERT INTO memos (title, summary, memo, created_at) VALUES (?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $summary, $memo, $created_at]);

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書メモ登録</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="edit-page">
        <div class="edit-card">
            <h1>読書メモ登録</h1>

            <?php if ($error !== ''): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <form class="edit-form" action="add.php" method="post">
                <div class="form-item">
                    <label for="title">タイトル</label>
                    <input type="text" id="title" name="title"
                        value="<?php echo htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>

                <div class="form-item">
                    <label for="summary">要約</label>
                    <textarea id="summary" name="summary"><?php echo htmlspecialchars($summary ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="form-item">
                    <label for="memo">感想</label>
                    <textarea id="memo" name="memo"><?php echo htmlspecialchars($memo ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="form-item">
                    <label for="created_at">日付</label>
                    <input type="date" id="created_at" name="created_at"
                        value="<?php echo htmlspecialchars($created_at ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>

                <div class="form-actions">
                    <button class="button primary" type="submit">保存</button>
                    <a class="button" href="index.php">一覧へ戻る</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>