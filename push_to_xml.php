<?php
/**
 * API: 推送歌曲到潮音音乐集团曲库（生成 XML 文件）
 * 方法: POST
 * 参数: album_id, song_id, audio_file, cover_image, song_name, singer_name, singer_url, creator_name
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

// ========== 读取 POST 参数 ==========
$albumId    = $_POST['album_id']    ?? 0;
$songId     = $_POST['song_id']     ?? 0;
$audioFile  = $_POST['audio_file']  ?? '';
$coverImage = $_POST['cover_image'] ?? '';
$songName   = $_POST['song_name']   ?? '';
$singerName = $_POST['singer_name'] ?? '';
$singerUrl  = $_POST['singer_url']  ?? '';
$creatorName = $_POST['creator_name'] ?? '';

if (!$songId || !$audioFile) {
    echo json_encode(['success' => false, 'message' => '参数不完整：缺少 song_id 或 audio_file']);
    exit;
}

// ========== 写入 XML 文件 ==========
$xmlFile = __DIR__ . '/../music/pushed_songs.xml';

// 确保目录存在
$xmlDir = dirname($xmlFile);
if (!is_dir($xmlDir)) {
    mkdir($xmlDir, 0755, true);
}

// 读取或创建 XML
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
    if ($xml === false) {
        echo json_encode(['success' => false, 'message' => 'XML 文件解析失败']);
        exit;
    }
} else {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><songs></songs>');
}

// 检查是否已存在
foreach ($xml->song as $s) {
    if ((string)$s->song_id === (string)$songId) {
        echo json_encode(['success' => false, 'message' => '该歌曲已推送过']);
        exit;
    }
}

// 添加新节点
$songNode = $xml->addChild('song');
$songNode->addChild('song_id', htmlspecialchars($songId));
$songNode->addChild('album_id', htmlspecialchars($albumId));
$songNode->addChild('song_name', htmlspecialchars($songName));
$songNode->addChild('singer_name', htmlspecialchars($singerName));
$songNode->addChild('singer_url', htmlspecialchars($singerUrl));
$songNode->addChild('creator_name', htmlspecialchars($creatorName));
$songNode->addChild('audio_file', htmlspecialchars($audioFile));
$songNode->addChild('cover_image', htmlspecialchars($coverImage));
$songNode->addChild('push_time', date('Y-m-d H:i:s'));

// 保存
if ($xml->asXML($xmlFile)) {
    chmod($xmlFile, 0644);
    echo json_encode(['success' => true, 'message' => '推送成功！歌曲已加入潮音音乐集团曲库']);
} else {
    echo json_encode(['success' => false, 'message' => 'XML 文件写入失败']);
}
