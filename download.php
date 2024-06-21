<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Path to your upload directory
    $filePath = 'uploads/' . basename($file);

    // Check if file exists
    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clear output buffer
        ob_clean();
        flush();

        // Read the file and send it to the output buffer
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
