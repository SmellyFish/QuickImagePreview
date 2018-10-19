<?php
require_once 'UserUploadedImage.php';

class UserUploadedImageManager
{
    private $userUploadedImageRootPath = 'images/uploads/';
    
    /**
     * @param UserUploadedImage $image
     * @return string
     */
    public function getImageUrl($image)
    {
        return $this->userUploadedImageRootPath . $image->getImageName();
    }
    
    /**
     * @param string $imageSourcePath
     * @param string $imageName
     * @return UserUploadedImage|null
     */
    public function saveNewUserUploadedImage($imageSourcePath, $imageName)
    {
        $targetPath = $this->userUploadedImageRootPath . $imageName;
        if (move_uploaded_file($imageSourcePath, $targetPath)) {
            return (new UserUploadedImage())->setImageName($imageName);
        }
        return null;
    }
}
