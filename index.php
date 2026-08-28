<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>香韵音乐Saas管理后台</title>
  <link rel="shortcut icon" type="image/x-icon" href="https://chaoyinmusic.cn/icon/icon.png">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Inter", "Microsoft Yahei", -apple-system, BlinkMacSystemFont, sans-serif;
    }

    :root {
      --primary: #165DFF;
      --primary-light: #E8F3FF;
      --primary-hover: #4080FF;
      --primary-gradient: linear-gradient(135deg, #165DFF 0%, #4080FF 100%);
      --success: #00B42A;
      --warning: #FF7D00;
      --danger: #F53F3F;
      --pending: #86909C;
      --reject: #9E1030;
      --gray-50: #F9FAFB;
      --gray-100: #F2F3F5;
      --gray-200: #E5E6EB;
      --gray-300: #C9CDD4;
      --gray-400: #86909C;
      --gray-500: #4E5969;
      --gray-600: #272E3B;
      --gray-700: #1D2129;
      
      --shadow-sm: 0 2px 6px rgba(0, 0, 0, 0.04);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
      --radius-sm: 4px;
      --radius-md: 8px;
      --radius-lg: 12px;
      --radius-full: 999px;
      
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
      background-color: var(--gray-50);
      color: var(--gray-600);
      font-size: 14px;
      line-height: 1.57;
      -webkit-font-smoothing: antialiased;
    }

    a {
      text-decoration: none;
      color: var(--primary);
      transition: var(--transition);
    }

    a:hover {
      color: var(--primary-hover);
    }

    ul {
      list-style: none;
    }

    button {
      cursor: pointer;
      border: none;
      background: transparent;
      transition: var(--transition);
    }

    .icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 1em;
      height: 1em;
      font-size: inherit;
      color: inherit;
    }
    
    .icon-add::before { content: "+"; font-weight: 700; }
    .icon-arrow-right::before { content: "→"; font-size: 0.9em; }
    
    .icon-img {
      display: inline-block;
      width: 1em;
      height: 1em;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      font-size: inherit;
    }
    
    .icon-stats { background-image: url("#"); }
    .icon-coop { background-image: url("#"); }
    .icon-music { background-image: url("#"); }
    
    .icon-singer { 
      background-image: url("#"); 
      border-radius: 50%;
      box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    .icon-calendar { 
      background-image: url("#"); 
      border-radius: 2px;
    }
    .icon-album { 
      background-image: url("https://s1.aigei.com/src/img/png/13/130941bc484249e6b67c1fbb0e73fb72.png?imageMogr2/auto-orient/thumbnail/!282x282r/gravity/Center/crop/282x282/quality/85/%7CimageView2/2/w/282&e=2051020800&token=P7S2Xpzfz11vAkASLTkfHN7Fw-oOZBecqeJaxypL:L61ZGVSasDQmm2AbkFtCOVJglEg="); 
      border-radius: 2px;
    }
    .icon-play { 
      background-image: url("#"); 
      border-radius: 50%;
      box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    #app {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      width: 100%;
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 20px;
    }

    header {
      background-color: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      box-shadow: var(--shadow-sm);
      padding: 0;
      position: sticky;
      top: 0;
      z-index: 100;
      border-bottom: 1px solid var(--gray-100);
    }

    .header-inner {
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 72px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo-img {
      width: 48px;
      height: 48px;
      border-radius: var(--radius-md);
      background: var(--primary-gradient);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 20px;
      box-shadow: 0 4px 12px rgba(22, 93, 255, 0.2);
    }

    .logo-text {
      font-size: 20px;
      font-weight: 600;
      color: var(--gray-700);
      letter-spacing: -0.5px;
    }

    .header-nav {
      display: flex;
      gap: 32px;
    }

    .nav-item a {
      color: var(--gray-500);
      font-weight: 500;
      padding: 0 8px;
      height: 72px;
      line-height: 72px;
      display: inline-block;
      border-bottom: 3px solid transparent;
      font-size: 15px;
    }

    .nav-item a.active {
      color: var(--primary);
      border-bottom-color: var(--primary);
      font-weight: 600;
    }

    .user-area {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .user-name {
      color: var(--gray-500);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .user-name::before {
      content: '';
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background-color: var(--success);
    }

    .logout-btn {
      color: var(--gray-400);
      font-size: 14px;
      padding: 6px 12px;
      border-radius: var(--radius-sm);
      background-color: var(--gray-100);
    }

    .logout-btn:hover {
      color: var(--danger);
      background-color: #FFF1F0;
    }

    .sidebar {
      width: 240px;
      background-color: white;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-md);
      padding: 24px 0;
      flex-shrink: 0;
      overflow: hidden;
    }

    .sidebar-menu {
      padding: 8px 0;
    }

    .menu-title {
      padding: 0 28px;
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 16px;
      color: var(--gray-700);
      letter-spacing: -0.3px;
    }

    .menu-item {
      padding: 0 28px;
    }

    .menu-item a {
      display: block;
      padding: 12px 16px;
      color: var(--gray-500);
      border-radius: var(--radius-md);
      position: relative;
      font-weight: 500;
      font-size: 15px;
      margin: 2px 0;
    }

    .menu-item a.active {
      color: var(--primary);
      background-color: var(--primary-light);
      font-weight: 600;
    }

    .menu-item a.active::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      width: 4px;
      height: 100%;
      background-color: var(--primary);
      border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    }
    
    .menu-item a:hover:not(.active) {
      background-color: var(--gray-50);
      color: var(--gray-600);
    }

    footer {
      background-color: white;
      padding: 24px 0;
      text-align: center;
      color: var(--gray-400);
      font-size: 14px;
      margin-top: auto;
      border-top: 1px solid var(--gray-100);
    }
    
    footer p {
      margin-top: 8px;
    }

    .main-content {
      flex: 1;
      display: flex;
      padding: 24px 0;
      gap: 24px;
    }

    .content {
      flex: 1;
      padding-top: 4px;
    }

    .breadcrumb {
      margin-bottom: 20px;
      color: var(--gray-400);
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .breadcrumb span {
      color: var(--gray-300);
      font-size: 12px;
    }
    
    .breadcrumb a:last-of-type {
      color: var(--gray-500);
      font-weight: 500;
    }

    .card {
      background-color: white;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-sm);
      padding: 24px;
      margin-bottom: 24px;
      border: 1px solid var(--gray-100);
      transition: var(--transition);
    }
    
    .card:hover {
      box-shadow: var(--shadow-md);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--gray-100);
    }

    .card-title {
      font-size: 18px;
      font-weight: 600;
      color: var(--gray-700);
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .card-title::before {
      content: '';
      width: 4px;
      height: 20px;
      background: var(--primary-gradient);
      border-radius: var(--radius-sm);
    }

    .card-more {
      font-size: 14px;
      color: var(--primary);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    
    .card-more .icon {
      transition: var(--transition);
    }
    
    .card-more:hover .icon {
      transform: translateX(2px);
    }

    .audit-filter {
      display: flex;
      gap: 12px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    
    .filter-btn {
      padding: 8px 16px;
      border-radius: var(--radius-md);
      background-color: var(--gray-100);
      color: var(--gray-600);
      font-weight: 500;
      font-size: 14px;
      text-decoration: none;
    }
    
    .filter-btn.active {
      background-color: var(--primary);
      color: white;
    }
    
    .filter-btn:hover:not(.active) {
      background-color: var(--gray-200);
    }
    
    .audit-actions {
      display: flex;
      gap: 8px;
      margin-top: 12px;
    }
    
    .audit-btn {
      padding: 6px 12px;
      border-radius: var(--radius-sm);
      font-size: 13px;
      font-weight: 500;
      transition: var(--transition);
      color: white;
      cursor: pointer;
    }
    
    .audit-btn-pass {
      background-color: var(--success);
    }
    
    .audit-btn-pass:hover {
      background-color: #00A327;
    }
    
    .audit-btn-reject {
      background-color: var(--danger);
    }
    
    .audit-btn-reject:hover {
      background-color: #E03333;
    }
    
    .audit-btn-offline {
      background-color: var(--warning);
    }
    
    .audit-btn-offline:hover {
      background-color: #E67000;
    }

    .audit-album-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px;
    }
    
    .audit-album-card {
      background-color: white;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--gray-200);
      overflow: hidden;
      transition: var(--transition);
    }
    
    .audit-album-card:hover {
      box-shadow: var(--shadow-md);
      border-color: var(--primary-light);
    }
    
    .audit-album-header {
      padding: 16px;
      border-bottom: 1px solid var(--gray-100);
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }
    
    .audit-album-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--gray-700);
      margin-bottom: 4px;
    }
    
    .audit-album-meta {
      font-size: 12px;
      color: var(--gray-500);
    }
    
    .audit-album-status {
      padding: 2px 8px;
      border-radius: var(--radius-full);
      font-size: 12px;
      font-weight: 500;
      color: white;
      white-space: nowrap;
    }
    
    .status-pending { background-color: var(--pending); }
    .status-online { background-color: var(--success); }
    .status-offline { background-color: var(--warning); }
    .status-reject { background-color: var(--danger); }
    
    .api-audit-status {
      padding: 2px 6px;
      border-radius: var(--radius-sm);
      font-size: 11px;
      font-weight: 500;
      color: white;
      display: inline-block;
      margin-left: 8px;
    }
    .api-pending { background-color: #86909C; }
    .api-processing { background-color: #165DFF; }
    .api-failed { background-color: #F53F3F; }
    .api-success { background-color: #00B42A; }
    
    .audit-album-body {
      padding: 16px;
      display: grid;
      grid-template-columns: 80px 1fr;
      gap: 16px;
    }
    
    .audit-album-cover {
      width: 80px;
      height: 80px;
      border-radius: var(--radius-md);
      overflow: hidden;
      flex-shrink: 0;
    }
    
    .audit-album-cover img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .audit-album-info {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    .audit-info-item {
      display: flex;
      font-size: 13px;
      color: var(--gray-600);
    }
    
    .audit-info-label {
      width: 70px;
      color: var(--gray-500);
      flex-shrink: 0;
    }
    
    .audit-info-value {
      flex: 1;
      word-break: break-all;
    }
    
    .view-songs-btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 4px 8px;
      background-color: var(--primary-light);
      color: var(--primary);
      border-radius: var(--radius-sm);
      font-size: 12px;
      margin-top: 8px;
      cursor: pointer;
    }
    
    .view-songs-btn:hover {
      background-color: #D1E9FF;
      color: var(--primary-hover);
    }
    
    .audit-album-footer {
      padding: 16px;
      border-top: 1px solid var(--gray-100);
      background-color: var(--gray-50);
    }

    .message-box {
      padding: 12px 16px;
      border-radius: var(--radius-md);
      margin-bottom: 20px;
      font-size: 14px;
      font-weight: 500;
    }
    
    .message-success {
      background-color: #F0F9FF;
      color: var(--success);
      border: 1px solid #DCF2E8;
    }
    
    .message-error {
      background-color: #FFF1F0;
      color: var(--danger);
      border: 1px solid #FFCCC7;
    }

    @media (max-width: 992px) {
      .main-content {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        margin-bottom: 16px;
      }
      .audit-album-list {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 576px) {
      .header-nav {
        display: none;
      }
      .audit-album-list {
        grid-template-columns: 1fr;
      }
      .audit-album-body {
        grid-template-columns: 1fr;
      }
      .audit-album-cover {
        width: 100%;
        height: 180px;
      }
      .logo-text {
        font-size: 18px;
      }
      .header-inner {
        height: 64px;
      }
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      opacity: 0;
      visibility: hidden;
      transition: var(--transition);
    }
    
    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }
    
    .modal-container {
      background-color: white;
      border-radius: var(--radius-lg);
      width: 100%;
      max-width: 420px;
      box-shadow: var(--shadow-lg);
      padding: 24px;
      position: relative;
      transform: translateY(-20px);
      transition: var(--transition);
    }
    
    .modal-overlay.active .modal-container {
      transform: translateY(0);
    }
    
    .modal-close {
      position: absolute;
      top: 16px;
      right: 16px;
      font-size: 20px;
      color: var(--gray-400);
      cursor: pointer;
    }
    
    .modal-close:hover {
      color: var(--danger);
    }
    
    .modal-title {
      font-size: 18px;
      font-weight: 600;
      color: var(--gray-700);
      margin-bottom: 20px;
      text-align: center;
    }
    
    .login-form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    .form-label {
      font-size: 14px;
      font-weight: 500;
      color: var(--gray-600);
    }
    
    .form-input {
      padding: 12px 16px;
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      font-size: 14px;
      transition: var(--transition);
    }
    
    .form-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px var(--primary-light);
    }
    
    .login-btn {
      padding: 12px 0;
      background: var(--primary-gradient);
      color: white;
      border-radius: var(--radius-md);
      font-size: 16px;
      font-weight: 600;
      transition: var(--transition);
    }
    
    .login-btn:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }
    
    .error-message {
      color: var(--danger);
      font-size: 13px;
      text-align: center;
      padding: 8px;
      background-color: #FFF1F0;
      border-radius: var(--radius-sm);
    }
    
    .login-note {
      text-align: center;
      font-size: 13px;
      color: var(--gray-500);
      margin-top: 12px;
    }
    
    #songModal .modal-container {
      max-width: 800px;
      max-height: 90vh;
      overflow-y: auto;
    }
    
    .song-modal-header {
      display: flex;
      align-items: center;      gap: 16px;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--gray-100);
    }
    
    .song-modal-cover {
      width: 80px;
      height: 80px;
      border-radius: var(--radius-md);
      overflow: hidden;
      flex-shrink: 0;
    }
    
    .song-modal-cover img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .song-modal-info h3 {
      font-size: 18px;
      font-weight: 600;
      color: var(--gray-700);
      margin-bottom: 4px;
    }
    
    .song-modal-info p {
      font-size: 14px;
      color: var(--gray-500);
    }
    
    .song-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    
    .song-item {
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      overflow: hidden;
    }
    
    .song-header {
      padding: 12px 16px;
      background-color: var(--gray-50);
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 8px;
    }
    
    .song-name {
      font-size: 15px;
      font-weight: 500;
      color: var(--gray-700);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .song-tag {
      font-size: 11px;
      padding: 2px 6px;
      border-radius: var(--radius-sm);
      background-color: var(--primary-light);
      color: var(--primary);
    }
    
    .song-meta {
      font-size: 12px;
      color: var(--gray-500);
      display: flex;
      gap: 16px;
    }
    
    .song-actions {
      display: flex;
      gap: 8px;
    }
    
    .play-btn {
      padding: 4px 8px;
      background-color: #E8F3FF;
      color: var(--primary);
      border-radius: var(--radius-sm);
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 4px;
      cursor: pointer;
    }
    
    .play-btn:hover {
      background-color: var(--primary-light);
      color: var(--primary-hover);
    }
    
    .play-btn.disabled {
      background-color: var(--gray-100);
      color: var(--gray-400);
      cursor: not-allowed;
    }
    
    .push-btn {
      padding: 4px 8px;
      background-color: #E8F3FF;
      color: var(--primary);
      border-radius: var(--radius-sm);
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 4px;
      cursor: pointer;
    }
    
    .push-btn:hover {
      background-color: var(--primary-light);
      color: var(--primary-hover);
    }
    
    .push-btn.disabled {
      background-color: var(--gray-100);
      color: var(--gray-400);
      cursor: not-allowed;
    }
    
    .edit-lyrics-btn {
      padding: 4px 8px;
      background-color: #F0F9FF;
      color: var(--primary);
      border-radius: var(--radius-sm);
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 4px;
      cursor: pointer;
    }
    
    .edit-lyrics-btn:hover {
      background-color: var(--primary-light);
      color: var(--primary-hover);
    }
    
    .edit-lyrics-btn.disabled {
      background-color: var(--gray-100);
      color: var(--gray-400);
      cursor: not-allowed;
    }
    
    .audio-player {
      padding: 12px 16px;
      background-color: #F8FAFC;
      border-bottom: 1px solid var(--gray-200);
    }
    
    .audio-player audio {
      width: 100%;
      outline: none;
    }
    
    .lyrics-editor-container {
      padding: 16px;
    }
    
    .lyrics-editor {
      width: 100%;
      min-height: 200px;
      padding: 12px;
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      font-size: 14px;
      line-height: 1.8;
      resize: vertical;
      margin-bottom: 12px;
      font-family: inherit;
    }
    
    .lyrics-editor:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px var(--primary-light);
    }
    
    .lyrics-editor-actions {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
    }
    
    .lyrics-save-btn {
      padding: 6px 12px;
      background-color: var(--primary);
      color: white;
      border-radius: var(--radius-sm);
      font-size: 12px;
      cursor: pointer;
    }
    
    .lyrics-save-btn:hover {
      background-color: var(--primary-hover);
    }
    
    .lyrics-cancel-btn {
      padding: 6px 12px;
      background-color: var(--gray-200);
      color: var(--gray-600);
      border-radius: var(--radius-sm);
      font-size: 12px;
      cursor: pointer;
    }
    
    .song-lyrics {
      padding: 16px;
      font-size: 14px;
      line-height: 1.8;
      color: var(--gray-600);
      max-height: 300px;
      overflow-y: auto;
      white-space: pre-line;
    }
    
    .no-lyrics {
      color: var(--gray-400);
      font-style: italic;
      text-align: center;
      padding: 20px 0;
    }
    
    .no-songs {
      text-align: center;
      padding: 40px 0;
      color: var(--gray-400);
      font-size: 15px;
    }
    
    .edit-tip {
      font-size: 12px;
      color: var(--gray-400);
      margin-top: 4px;
      font-style: italic;
    }
  </style>
</head>
<body>
  <div id="app">
<header>
  <div class="container header-inner">
    <div class="logo">
      <div class="logo-img">香</div>
      <div class="logo-text">Saas管理后台</div>
    </div>
    
    <div class="header-nav">
      <div class="nav-item"><a href="#" class="active">公共管理</a></div>
      <div class="nav-item">
        <a href="https://aichaoyin.cn/yiren/admin/saas.html" class="saas-notice-link">Saas总台通知</a>
      </div>
    </div>
    
    <div class="user-area">
      <div class="user-name">
        深圳香韵文化管理账号 (管理员)
      </div>
      <a href="?logout=1" class="logout-btn">退出登录</a>
    </div>
  </div>
</header>

<aside class="sidebar">
  <div class="sidebar-menu">
    <div class="menu-title">内容管理</div>
    <div class="menu-item"><a href="index.php" class="active">专辑审核</a></div>
    <div class="menu-item"><a href="mv.php">视频审核</a></div>
    <div class="menu-item"><a href="fanchang.php">翻唱曲库</a></div>
    <div class="menu-item"><a href="aibanzou.php">伴奏曲库</a></div>
    <div class="menu-item"><a href="xiaoxi.php">消息设置</a></div>
  </div>
</aside>

<main class="content">
  <div class="breadcrumb">
    <a href="#">公共管理后台</a>
    <span>/</span>
    <a href="#" class="active">专辑审核</a>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">专辑审核管理</div>
    </div>
    
    <div class="audit-filter">
      <a href="?status=pending" class="filter-btn active" data-status="pending">审核中</a>
      <a href="?status=online" class="filter-btn" data-status="online">已发布</a>
      <a href="?status=offline" class="filter-btn" data-status="offline">已下架</a>
      <a href="?status=reject" class="filter-btn" data-status="reject">已驳回</a>
      <a href="?status=all" class="filter-btn" data-status="all">全部专辑</a>
    </div>
    
    <div class="audit-album-list" id="albumList">
      <!-- 专辑列表由 JS 动态加载 -->
    </div>
  </div>
</main>

<footer>
  <div class="container">
    <p>© 深圳市香韵音乐文化传媒有限公司 运营 | 领创互娱科技（潍坊市）有限公司开发 </p>
  </div>
</footer>

<!-- 登录模态框 -->
<div class="modal-overlay" id="loginModal">
  <div class="modal-container">
    <span class="modal-close" onclick="closeLoginModal()">&times;</span>
    <div class="modal-title">香韵音乐登录系统</div>
    <form class="login-form" method="POST" action="">
      <div class="form-group">
        <label class="form-label" for="username">用户名</label>
        <input type="text" id="username" name="username" class="form-input" placeholder="请输入账号" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="password">密码</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="请输入密码" required>
      </div>
      <button type="submit" name="login" class="login-btn">登录</button>
      <div class="login-note">
        仅限 <strong>管理员/审核员</strong> 登录，普通用户无访问权限
      </div>
    </form>
  </div>
</div>

<!-- 歌曲查看弹窗 -->
<div class="modal-overlay" id="songModal">
  <div class="modal-container">
    <span class="modal-close" onclick="closeSongModal()">&times;</span>
    <div class="song-modal-header">
      <div class="song-modal-cover">
        <img id="modalAlbumCover" src="" alt="专辑封面">
      </div>
      <div class="song-modal-info">
        <h3 id="modalAlbumTitle"></h3>
        <p id="modalSongCount">歌曲列表</p>
        <input type="hidden" id="modalAlbumId" value="">
        <input type="hidden" id="modalAlbumStatus" value="">
      </div>
    </div>
    <div id="songListContainer" class="song-list">
      <!-- 歌曲列表由 JS 动态加载 -->
    </div>
  </div>
</div>

<script>
// ========== 全局状态 ==========
const isLoggedIn = true;
const API_BASE = ''; // 同目录下的 api 文件夹

// ========== 登录弹窗控制 ==========
function openLoginModal() {
  document.getElementById('loginModal').classList.add('active');
  document.body.style.overflow = 'hidden';
  setTimeout(() => document.getElementById('username').focus(), 300);
}

function closeLoginModal() {
  document.getElementById('loginModal').classList.remove('active');
  document.body.style.overflow = '';
}

document.getElementById('loginModal').addEventListener('click', function(e) {
  if (e.target === this) closeLoginModal();
});

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeLoginModal();
    closeSongModal();
  }
});

// ========== 页面初始化 ==========
window.addEventListener('DOMContentLoaded', function() {
  if (!isLoggedIn) {
    setTimeout(openLoginModal, 500);
  }
  // 获取当前筛选状态
  const activeBtn = document.querySelector('.filter-btn.active');
  const status = activeBtn ? activeBtn.dataset.status : 'pending';
  loadAlbums(status);
});

// ========== 筛选按钮 ==========
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    loadAlbums(this.dataset.status);
  });
});

// ========== 加载专辑列表 ==========
function loadAlbums(status) {
  const container = document.getElementById('albumList');
  container.innerHTML = '<div style="text-align:center;padding:60px 0;color:var(--gray-400);">加载中...</div>';

  fetch(`${API_BASE}api/get_albums.php?status=${status}`)
    .then(res => res.json())
    .then(data => {
      if (data.success && data.albums.length > 0) {
        renderAlbumList(data.albums, container);
      } else {
        container.innerHTML = '<div style="text-align:center;padding:60px 0;color:var(--gray-400);">暂无符合条件的专辑数据</div>';
      }
    })
    .catch(err => {
      container.innerHTML = `<div style="text-align:center;padding:60px 0;color:var(--danger);">加载失败：${err.message}</div>`;
    });
}

// ========== 渲染专辑列表 ==========
function renderAlbumList(albums, container) {
  container.innerHTML = '';
  const statusConfig = {
    '0': { class: 'status-pending', text: '审核中' },
    '1': { class: 'status-online',  text: '已发布' },
    '2': { class: 'status-offline', text: '已下架' },
    '3': { class: 'status-reject',  text: '已驳回' }
  };

  albums.forEach(album => {
    const sc = statusConfig[album.status] || statusConfig['0'];
    const canAudit = album.status == 0;
    const esc = s => (s || '').replace(/'/g, "\\'");

    const card = document.createElement('div');
    card.className = 'audit-album-card';
    card.innerHTML = `
      <div class="audit-album-header">
        <div>
          <div class="audit-album-title">${esc(album.title)}</div>
          <div class="audit-album-meta">${album.song_count || 0}首歌曲 · ${esc(album.creator_name)}</div>
        </div>
        <span class="audit-album-status ${sc.class}">${sc.text}</span>
      </div>
      <div class="audit-album-body">
        <div class="audit-album-cover">
          <img src="https://xiangyun.chaoyinmusic.cn//music/${esc(album.cover_image)}" 
               alt="封面" 
               onerror="this.src='https://xiangyun.chaoyinmusic.cn//music/default_cover.png'">
        </div>
        <div class="audit-album-info">
          <div class="audit-info-item"><span class="audit-info-label">专辑ID</span><span class="audit-info-value">${album.id}</span></div>
          <div class="audit-info-item"><span class="audit-info-label">歌手</span><span class="audit-info-value">${esc(album.singer_name)}</span></div>
          <div class="audit-info-item"><span class="audit-info-label">发行时间</span><span class="audit-info-value">${esc(album.release_date)}</span></div>
        </div>
      </div>
      <div class="audit-album-footer">
        <div class="view-songs-btn" onclick="openSongModal(${album.id}, '${esc(album.title)}', '${esc(album.cover_image)}', ${album.status})">
          🎵 查看歌曲
        </div>
        ${canAudit ? `
          <div style="margin-top:12px;display:flex;gap:8px;">
            <button class="audit-btn audit-btn-pass" onclick="auditAlbum(${album.id}, 'pass')">通过</button>
            <button class="audit-btn audit-btn-reject" onclick="auditAlbum(${album.id}, 'reject')">驳回</button>
          </div>
        ` : ''}
      </div>
    `;
    container.appendChild(card);
  });
}

// ========== 审核专辑 ==========
function auditAlbum(albumId, action) {
  const isPass = action === 'pass';
  if (!confirm(isPass ? '确认通过该专辑？' : '确认驳回该专辑？')) return;

  const formData = new FormData();
  formData.append('album_id', albumId);
  formData.append('action', action);

  fetch(`${API_BASE}api/audit_album.php`, {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message || (data.success ? '操作成功' : '操作失败'));
    if (data.success) {
      const activeBtn = document.querySelector('.filter-btn.active');
      const status = activeBtn ? activeBtn.dataset.status : 'pending';
      loadAlbums(status);
    }
  })
  .catch(err => alert('操作失败：' + err.message));
}

// ========== 播放音频 ==========
function playAudio(audioFile, playerId) {
  if (!audioFile) {
    alert('该歌曲暂无音频文件可播放');
    return;
  }
  const audioUrl = `https://xiangyun.chaoyinmusic.cn//music/${audioFile}`;
  const audioPlayer = document.getElementById(playerId);
  if (audioPlayer) {
    audioPlayer.src = audioUrl;
    audioPlayer.play().catch(error => {
      alert('播放失败: ' + error.message);
    });
  }
}

// ========== 推送歌曲 ==========
function pushToXml(albumId, songId, audioFile, coverImage, songName, singerName, singerUrl, creatorName) {
  if (!audioFile) {
    alert('该歌曲暂无音频文件，无法推送');
    return;
  }
  if (!confirm(`确认推送歌曲【${songName}】到潮音音乐集团曲库吗？`)) return;

  const formData = new FormData();
  formData.append('album_id', albumId);
  formData.append('song_id', songId);
  formData.append('audio_file', audioFile);
  formData.append('cover_image', coverImage);
  formData.append('song_name', songName);
  formData.append('singer_name', singerName);
  formData.append('singer_url', singerUrl);
  formData.append('creator_name', creatorName);

  fetch(`${API_BASE}api/push_to_xml.php`, {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message || (data.success ? '推送成功' : '推送失败'));
  })
  .catch(err => alert('推送失败：' + err.message));
}

// ========== 歌曲弹窗 ==========
function openSongModal(albumId, albumTitle, coverImage, albumStatus) {
  document.getElementById('modalAlbumTitle').textContent = albumTitle;
  document.getElementById('modalAlbumCover').src = `https://xiangyun.chaoyinmusic.cn//music/${coverImage || 'default_cover.png'}`;
  document.getElementById('modalAlbumId').value = albumId;
  document.getElementById('modalAlbumStatus').value = albumStatus;
  
  const container = document.getElementById('songListContainer');
  container.innerHTML = '<div style="text-align:center;padding:40px;color:var(--gray-400);">加载中...</div>';

  fetch(`${API_BASE}api/get_songs.php?album_id=${albumId}`)
    .then(res => res.json())
    .then(data => {
      container.innerHTML = '';
      if (data.success && data.songs.length > 0) {
        data.songs.forEach((song, index) => {
          const esc = s => (s || '').replace(/'/g, "\\'");
          const item = document.createElement('div');
          item.className = 'song-item';
          item.innerHTML = `
            <div class="song-header">
              <div class="song-name">${index + 1}. ${esc(song.song_name)}<span class="song-tag">${esc(song.music_type)}</span></div>
              <div class="song-meta">
                <span>歌手：${esc(song.singer_name)}</span>
                <span>曲目编号：${esc(song.track_number)}</span>
              </div>
              <div class="song-actions">
                <button class="play-btn ${song.audio_file ? '' : 'disabled'}" 
                        onclick="${song.audio_file ? `playAudio('${esc(song.audio_file)}', 'audioPlayer-${song.id}')` : 'return false'}">▶ 播放</button>
                <button class="push-btn ${song.audio_file ? '' : 'disabled'}"
                        onclick="${song.audio_file ? `pushToXml(${albumId}, ${song.id}, '${esc(song.audio_file)}', '${esc(coverImage)}', '${esc(song.song_name)}', '${esc(song.singer_name)}', '${esc(song.singer_url)}', '${esc(song.creator_name)}')` : 'return false'}">📤 推送</button>
                <button class="edit-lyrics-btn" onclick="openLyricsEditor(${albumId}, ${song.id}, \`${(song.lyrics || '').replace(/`/g, '\\`')}\`, ${albumStatus})">✏️ 编辑歌词</button>
              </div>
            </div>
            ${song.audio_file ? `<div class="audio-player"><audio id="audioPlayer-${song.id}" controls></audio></div>` : ''}
            <div class="song-lyrics" id="lyrics-${song.id}">
              ${song.lyrics ? song.lyrics : '<div class="no-lyrics">暂无歌词</div>'}
            </div>
          `;
          container.appendChild(item);
        });
      } else {
        container.innerHTML = '<div class="no-songs">该专辑暂无歌曲数据</div>';
      }
    })
    .catch(err => {
      container.innerHTML = `<div class="no-songs">加载失败：${err.message}</div>`;
    });

  document.getElementById('songModal').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeSongModal() {
  document.getElementById('songModal').classList.remove('active');
  document.body.style.overflow = '';
  document.querySelectorAll('audio').forEach(a => a.pause());
}

document.getElementById('songModal').addEventListener('click', function(e) {
  if (e.target === this) closeSongModal();
});

// ========== 编辑歌词 ==========
function openLyricsEditor(albumId, songId, lyrics, albumStatus) {
  if (albumStatus != 0) {
    alert('仅审核中的专辑可以编辑歌词');
    return;
  }
  const box = document.getElementById(`lyrics-${songId}`);
  box.innerHTML = `
    <textarea class="lyrics-editor" id="lyricsEditor-${songId}">${lyrics || ''}</textarea>
    <div class="lyrics-editor-actions">
      <button class="lyrics-save-btn" onclick="saveLyrics(${albumId}, ${songId})">保存歌词</button>
      <button class="lyrics-cancel-btn" onclick="cancelLyricsEdit(${songId}, \`${lyrics || ''}\`)">取消</button>
    </div>
    <div class="edit-tip">提示：支持换行，保留原有格式</div>
  `;
}

function saveLyrics(albumId, songId) {
  const editor = document.getElementById(`lyricsEditor-${songId}`);
  const newLyrics = editor.value.trim();
  const formData = new FormData();
  formData.append('album_id', albumId);
  formData.append('song_id', songId);
  formData.append('lyrics', newLyrics);

  fetch(`${API_BASE}api/save_lyrics.php`, {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message || (data.success ? '保存成功' : '保存失败'));
    if (data.success) {
      const box = document.getElementById(`lyrics-${songId}`);
      box.innerHTML = newLyrics || '<div class="no-lyrics">暂无歌词</div>';
    }
  })
  .catch(err => alert('保存失败：' + err.message));
}

function cancelLyricsEdit(songId, originalLyrics) {
  const box = document.getElementById(`lyrics-${songId}`);
  box.innerHTML = originalLyrics ? originalLyrics : '<div class="no-lyrics">暂无歌词</div>';
}
</script>
</body>
</html>
