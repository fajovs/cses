<?php

$uploadDir = base_path('public/uploads/');

// Make sure a file is requested
if (!isset($_GET['file']) || empty($_GET['file'])) {
    http_response_code(400);
    echo "No file specified.";
    exit;
}

// Prevent directory traversal attacks
$filename = basename($_GET['file']);

// Full file path
$filePath = $uploadDir . $filename;

if (!file_exists($filePath)) {
    http_response_code(404);
    echo "File not found.";
    exit;
}

// Force file download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));

readfile($filePath);
exit;
