require '../app/config/database.php';

$sql = "INSERT INTO memos (title, summary, memo, created_at) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$title, $summary, $memo, $date]);