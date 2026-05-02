<?php
require '../app/config/db.php';

$sql = 'SELECT id, title, summary, memo, created_at FROM memos ORDER BY id DESC';
$stmt = $pdo->query($sql);
$memos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書メモ一覧</title>
</head>

<body>
    <h1>読書メモ一覧</h1>

    <p>
        <a href="add.php">新規登録</a>
    </p>

    <?php if (count($memos) === 0): ?>
        <p>読書メモはまだありません。</p>
    <?php else: ?>
        <?php foreach ($memos as $memo): ?>
            <article>
                <h2><?php echo htmlspecialchars($memo['title'], ENT_QUOTES, 'UTF-8'); ?></h2>

                <p>
                    日付:
                    <?php echo htmlspecialchars($memo['created_at'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <h3>要約</h3>
                <p><?php echo nl2br(htmlspecialchars($memo['summary'], ENT_QUOTES, 'UTF-8')); ?></p>

                <h3>感想</h3>
                <p><?php echo nl2br(htmlspecialchars($memo['memo'], ENT_QUOTES, 'UTF-8')); ?></p>

                <p>
                    <a href="edi.php?id=<?php echo htmlspecialchars($memo['id'], ENT_QUOTES, 'UTF-8'); ?>">編集</a>
                    <a href="dele.php?id=<?php echo htmlspecialchars($memo['id'], ENT_QUOTES, 'UTF-8'); ?>">削除</a>
                </p>
            </article>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>