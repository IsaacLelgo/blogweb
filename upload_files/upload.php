<?php
// Directory where files will be saved
$targetDir = "uploads/";

// Create uploads directory if it doesn't exist
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow only image and video file types
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi'];
    if (in_array($fileType, $allowedTypes)) {
        // Check file size (limit to 10MB for example)
        if ($file['size'] <= 10 * 1024 * 1024) {
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                echo "The file has been uploaded successfully.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File size exceeds the limit of 10MB.";
        }
    } else {
        echo "Only images and videos are allowed.";
    }
} else {
    echo "No file was uploaded.";
}
?>
