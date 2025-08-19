<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Lấy URL ảnh từ Google Drive hoặc local storage
     */
    public static function getImageUrl($imagePath, $googleDriveId = null)
    {
        if ($googleDriveId) {
            // Nếu có Google Drive ID, sử dụng URL Google Drive
            return 'https://drive.google.com/uc?id=' . $googleDriveId;
        }
        
        if ($imagePath && str_starts_with($imagePath, 'http')) {
            // Nếu là URL đầy đủ
            return $imagePath;
        }
        
        if ($imagePath) {
            // Nếu là đường dẫn local
            return asset('storage/' . $imagePath);
        }
        
        // Trả về ảnh mặc định
        return asset('images/no-image.png');
    }
    
    /**
     * Kiểm tra xem ảnh có phải từ Google Drive không
     */
    public static function isGoogleDriveImage($imagePath)
    {
        return str_contains($imagePath, 'drive.google.com');
    }
    
    /**
     * Lấy thumbnail URL từ Google Drive
     */
    public static function getGoogleDriveThumbnail($fileId, $size = 'medium')
    {
        $sizes = [
            'small' => 'w220-h220',
            'medium' => 'w400-h400',
            'large' => 'w800-h800'
        ];
        
        $sizeParam = $sizes[$size] ?? $sizes['medium'];
        
        return "https://drive.google.com/thumbnail?id={$fileId}&sz={$sizeParam}";
    }
}
