<?php
/**
 * API: 获取专辑列表
 * 用法: api/get_albums.php?status=pending|online|offline|reject|all
 * 返回: JSON
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理 OPTIONS 预检请求
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

// 状态映射
$statusMap = [
    'pending' => 0,
    'online'  => 1,
    'offline' => 2,
    'reject'  => 3,
    'all'     => 'all'
];

$status = $_GET['status'] ?? 'pending';
$statusValue = $statusMap[$status] ?? 0;

try {
    if ($statusValue === 'all') {
        $sql = "SELECT a.*, u.username as creator_name, 
                (SELECT COUNT(*) FROM songs s WHERE s.album_id = a.id) as song_count 
                FROM albums a 
                LEFT JOIN users u ON a.user_id = u.id 
                ORDER BY a.created_at DESC";
        $stmt = $pdo->query($sql);
    } else {
        $sql = "SELECT a.*, u.username as creator_name,
                (SELECT COUNT(*) FROM songs s WHERE s.album_id = a.id) as song_count 
                FROM albums a 
                LEFT JOIN users u ON a.user_id = u.id 
                WHERE a.status = ? 
                ORDER BY a.created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$statusValue]);
    }
    $albums = $stmt->fetchAll();
    echo json_encode(['success' => true, 'albums' => $albums]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '查询失败: ' . $e->getMessage()]);
}
