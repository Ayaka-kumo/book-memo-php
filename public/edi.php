<?php
require '../app/config/db.php';

$error = '';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $memo = $_POST['memo'] ?? '';
    $created_at = $_POST['created_at'] ?? '';

    if ($title === '' || $summary === '' || $memo === '' || $created_at === '') {
        $error = 'すべての項目を入力してください。';
    } else {
        $sql = 'UPDATE memos SET title = ?, summary = ?, memo = ?, created_at = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $summary, $memo, $created_at, $id]);

        header('Location: index.php');
        exit;
    }
} else {
    $sql = 'SELECT id, title, summary, memo, created_at FROM memos WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $book_memo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book_memo) {
        header('Location: index.php');
        exit;
    }

    $title = $book_memo['title'];
    $summary = $book_memo['summary'];
    $memo = $book_memo['memo'];
    $created_at = $book_memo['created_at'];
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書メモ編集</title>
</head>

<body>
    <h1>読書メモ編集</h1>

    <?php if ($error !== ''): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="edi.php?id=<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" method="post">
        <div>
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div>
            <label for="summary">要約</label>
            <textarea id="summary" name="summary"><?php echo htmlspecialchars($summary, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div>
            <label for="memo">感想</label>
            <textarea id="memo" name="memo"><?php echo htmlspecialchars($memo, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div>
            <label for="created_at">日付</label>
            <input type="date" id="created_at" name="created_at" value="<?php echo htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <button type="submit">更新</button>
    </form>

    <p>
        <a href="index.php">一覧へ戻る</a>
    </p>
</body>

</html>