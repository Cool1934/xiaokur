# 香韵音乐 SaaS 管理后台 - 专辑审核

## 文件结构

```
xiangyun_saas_admin/
├── index.php              # 前台页面（HTML+CSS+JS，JS 已改为 fetch 调用 API）
├── api/
│   ├── get_albums.php     # GET  获取专辑列表
│   ├── get_songs.php      # GET  获取专辑内歌曲列表
│   ├── push_to_xml.php    # POST 推送歌曲到曲库（生成 XML）
│   ├── save_lyrics.php    # POST 保存歌词
│   └── audit_album.php    # POST 审核专辑（通过/驳回）
└── music/                 # 推送的 XML 文件输出目录（自动创建）
    └── pushed_songs.xml
```

## API 接口说明

### 1. 获取专辑列表
```
GET /api/get_albums.php?status=pending|online|offline|reject|all
```
**参数：**
| 参数 | 说明 |
|------|------|
| status | pending(审核中) / online(已发布) / offline(已下架) / reject(已驳回) / all(全部) |

**返回示例：**
```json
{
  "success": true,
  "albums": [
    {
      "id": 1,
      "title": "示例专辑",
      "status": 0,
      "singer_name": "张三",
      "cover_image": "cover.jpg",
      "song_count": 10,
      "creator_name": "admin",
      "release_date": "2026-01-01"
    }
  ]
}
```

### 2. 获取歌曲列表
```
GET /api/get_songs.php?album_id=123
```

### 3. 推送歌曲
```
POST /api/push_to_xml.php
表单字段：album_id, song_id, audio_file, cover_image, song_name, singer_name, singer_url, creator_name
```
推送成功后会在 `music/pushed_songs.xml` 中追加一条记录。

### 4. 保存歌词
```
POST /api/save_lyrics.php
表单字段：album_id, song_id, lyrics
```

### 5. 审核专辑
```
POST /api/audit_album.php
表单字段：album_id, action(pass|reject)
```

## 数据库配置

所有 `api/*.php` 文件顶部都有数据库配置，需要改成你自己的：

```php
$host = 'localhost';
$db   = 'xiangyun';
$user = 'your_username';
$pass = 'your_password';
```

## 部署

1. 将整个 `xiangyun_saas_admin` 文件夹上传到你的服务器
2. 确保 `api/` 目录有写入权限（用于生成 XML）
3. 修改所有 PHP 文件中的数据库配置
4. 确保服务器支持 PDO + MySQL
