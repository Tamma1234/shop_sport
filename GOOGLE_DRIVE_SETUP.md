# Hướng dẫn cấu hình Google Drive API

## Bước 1: Tạo Google Cloud Project

1. Truy cập [Google Cloud Console](https://console.cloud.google.com/)
2. Tạo project mới hoặc chọn project có sẵn
3. Kích hoạt Google Drive API

## Bước 2: Tạo OAuth 2.0 Credentials

1. Vào "APIs & Services" > "Credentials"
2. Click "Create Credentials" > "OAuth 2.0 Client IDs"
3. Chọn "Web application"
4. Thêm Authorized redirect URIs:
   - `http://localhost:8000/auth/google/callback` (cho development)
   - `https://yourdomain.com/auth/google/callback` (cho production)
5. Lưu Client ID và Client Secret

## Bước 3: Lấy Refresh Token

### Cách 1: Sử dụng Google OAuth Playground
1. Truy cập [Google OAuth Playground](https://developers.google.com/oauthplayground/)
2. Click settings (biểu tượng bánh răng) ở góc phải
3. Check "Use your own OAuth credentials"
4. Nhập Client ID và Client Secret
5. Chọn scope: `https://www.googleapis.com/auth/drive`
6. Click "Authorize APIs"
7. Click "Exchange authorization code for tokens"
8. Copy Refresh Token

### Cách 2: Tạo script PHP để lấy token
Tạo file `get_google_token.php`:

```php
<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('YOUR_CLIENT_ID');
$client->setClientSecret('YOUR_CLIENT_SECRET');
$client->setRedirectUri('http://localhost:8000/auth/google/callback');
$client->setScopes(['https://www.googleapis.com/auth/drive']);

$authUrl = $client->createAuthUrl();
echo "Truy cập URL này để authorize: " . $authUrl . "\n";
echo "Sau khi authorize, copy code từ URL và nhập vào đây: ";
$code = trim(fgets(STDIN));

$token = $client->fetchAccessTokenWithAuthCode($code);
echo "Refresh Token: " . $token['refresh_token'] . "\n";
```

## Bước 4: Tạo thư mục trên Google Drive

1. Truy cập [Google Drive](https://drive.google.com)
2. Tạo thư mục mới (ví dụ: "Shop Sport Images")
3. Copy ID của thư mục từ URL (phần cuối của URL)

## Bước 5: Cấu hình .env

Thêm các biến môi trường vào file `.env`:

```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REFRESH_TOKEN=your_refresh_token_here
GOOGLE_DRIVE_FOLDER_ID=your_folder_id_here
```

## Bước 6: Chạy Migration

```bash
php artisan migrate
```

## Lưu ý quan trọng

1. **Bảo mật**: Không bao giờ commit file `.env` lên git
2. **Quota**: Google Drive API có giới hạn quota, hãy kiểm tra trong Google Cloud Console
3. **Permissions**: Đảm bảo thư mục Google Drive có quyền public hoặc được chia sẻ phù hợp
4. **Error Handling**: Code đã có xử lý lỗi cơ bản, có thể mở rộng thêm theo nhu cầu

## Troubleshooting

### Lỗi "Invalid Credentials"
- Kiểm tra lại Client ID và Client Secret
- Đảm bảo OAuth consent screen đã được cấu hình

### Lỗi "Access Denied"
- Kiểm tra quyền truy cập thư mục Google Drive
- Đảm bảo Refresh Token còn hiệu lực

### Lỗi "Quota Exceeded"
- Kiểm tra quota trong Google Cloud Console
- Cân nhắc sử dụng Google Cloud Storage thay thế
