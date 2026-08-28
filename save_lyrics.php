<?php
/**
 * API: 保存歌曲歌词
 * 方法: POST
 * 参数: album_id, song_id, lyrics
 * 返回: JSON
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '仅支持 POST 请求']);
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

$albumId = $_POST['album_id'] ?? 0;
$songId  = $_POST['song_id']  ?? 0;
$lyrics  = $_POST['lyrics']   ?? '';

if (!$songId) {
    echo json_encode(['success' => false, 'message' => '缺少 song_id']);
    exit;
}

try {
    $sql = "UPDATE songs SET lyrics = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lyrics, $songId]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => '歌词保存成功']);
    } else {
        // rowCount 为 0 可能是没变化，也认为是成功
        echo json_encode(['success' => true, 'message' => '歌词已保存（无变更）']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '保存失败: ' . $e->getMessage()]);
}
