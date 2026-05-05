<?php

namespace App\Services;

class ImageUploadService
{
    public static function upload(array $file): ?string
    {
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];

        $mimeType = mime_content_type($file['tmp_name']);

        if (!array_key_exists($mimeType, $allowedTypes)) {
            return null;
        }

        $extension = $allowedTypes[$mimeType];
        $fileName = uniqid('product_', true) . '.' . $extension;

        $uploadDir = __DIR__ . '/../../public/uploads/products/';
        $uploadPath = $uploadDir . $fileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return null;
        }

        return '/uploads/products/' . $fileName;
    }
    
    public static function delete(?string $path): void
    {
        if (!$path) return;

        $fullPath = __DIR__ . '/../../public/' . ltrim($path, '/');

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
