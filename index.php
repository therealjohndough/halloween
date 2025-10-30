<?php
/**
 * Simple router for theme testing
 */

$request_uri = $_SERVER['REQUEST_URI'];
$request_path = parse_url($request_uri, PHP_URL_PATH);

// Serve static files directly
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|webp|mp4|pdf)$/', $request_path)) {
    $file_path = __DIR__ . $request_path;
    if (file_exists($file_path)) {
        // Set appropriate content type
        $ext = pathinfo($file_path, PATHINFO_EXTENSION);
        $content_types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp',
            'mp4' => 'video/mp4',
            'pdf' => 'application/pdf'
        ];
        
        if (isset($content_types[$ext])) {
            header('Content-Type: ' . $content_types[$ext]);
        }
        
        readfile($file_path);
        exit;
    }
}

// For all other requests, load the theme tester
include 'test-theme.php';
?>