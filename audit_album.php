<?php
/**
 * API: 审核专辑（通过 / 驳回）
 * 方法: POST
 * 参数: album_id, action (pass|reject)
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

$albumId = intval($_POST['album_id'] ?? 0);
$action  = $_POST['action'] ?? '';

$statusMap = ['pass' => 1, 'reject' => 3];
$newStatus = $statusMap[$action] ?? null;

if ($albumId <= 0 || $newStatus === null) {
    echo json_encode(['success' => false, 'message' => '参数错误']);
    exit;
}

try {
    $sql = "UPDATE albums SET status = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$newStatus, $albumId]);
    
    if ($stmt->rowCount() > 0) {
        $msg = $action === 'pass' ? '专辑已通过审核' : '专辑已驳回';
        echo json_encode(['success' => true, 'message' => $msg]);
    } else {
        echo json_encode(['success' => false, 'message' => '操作失败，专辑不存在']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '操作失败: ' . $e->getMessage()]);
}
