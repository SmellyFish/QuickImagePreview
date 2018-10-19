<?php
if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        
        // Not using autoloading for simplicity's sake
        require_once '../src/UserUploadedImage.php';
        require_once '../src/UserUploadedImageManager.php';
        
        $uploadedImageManager = new UserUploadedImageManager();
        $image = $uploadedImageManager->saveNewUserUploadedImage(
            $_FILES['userImage']['tmp_name'],
            $_FILES['userImage']['name']
        );
        
        if (!empty($image)) {
            echo json_encode([
                'status' => 'success',
                'imageName' => $image->getImageName(),
                'imageUrl' => $uploadedImageManager->getImageUrl($image)
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unable to save image to server'
            ]);
        }
    }
}
