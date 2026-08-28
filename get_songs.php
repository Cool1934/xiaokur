<?php
/**
 * API: 获取指定专辑的歌曲列表
 * 用法: api/get_songs.php?album_id=123
 * 返回: JSON
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

// ========== 数据库配置（按需修改）==========
$host = 'localhost';
$db   = 'xiangyun';
$user = 'your_username';
$pass = 'your_password';
$charset = 'utf8mb4';
// ============================================

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '数据库连接失败: ' . $e->getMessage()]);
    exit;
}

$albumId = intval($_GET['album_id'] ?? 0);
if ($albumId <= 0) {
    echo json_encode(['success' => false, 'message' => '缺少或无效的 album_id']);
    exit;
}

try {
    $sql = "SELECT * FROM songs WHERE album_id = ? ORDER BY track_number ASC, id ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$albumId]);
    $songs = $stmt->fetchAll();
    echo json_encode(['success' => true, 'songs' => $songs]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '查询失败: ' . $e->getMessage()]);
}
