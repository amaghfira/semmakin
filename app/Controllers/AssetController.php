<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AssetController extends Controller
{
    public function serveAsset($path)
    {
        $filePath = FCPATH . 'dist/' . $path;
        if (file_exists($filePath)) {
            $mimeType = mime_content_type($filePath);
            header('Content-Type: ' . $mimeType);
            readfile($filePath);
        } else {
            // Handle file not found
            // For example: show a 404 page or redirect to a default asset
        }
    }
}

?>