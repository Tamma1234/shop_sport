<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    protected $service;

    public function __construct()
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setAccessToken(['refresh_token' => config('services.google.refresh_token')]);
        $client->setScopes([GoogleDrive::DRIVE]);

        $this->service = new GoogleDrive($client);
    }

    public function uploadFile(UploadedFile $file, $folderId = null)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        $fileMetadata = new DriveFile([
            'name' => $fileName,
            'parents' => $folderId ? [$folderId] : []
        ]);

        $content = file_get_contents($file->getRealPath());
        
        $file = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $file->getMimeType(),
            'uploadType' => 'multipart',
            'fields' => 'id,webViewLink'
        ]);

        return [
            'id' => $file->getId(),
            'name' => $fileName,
            'webViewLink' => $file->getWebViewLink(),
            'url' => 'https://drive.google.com/uc?id=' . $file->getId()
        ];
    }

    public function deleteFile($fileId)
    {
        try {
            $this->service->files->delete($fileId);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getFileUrl($fileId)
    {
        return 'https://drive.google.com/uc?id=' . $fileId;
    }
}
