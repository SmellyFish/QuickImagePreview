<?php

require_once 'traits/ValueObject.php';

class UserUploadedImage
{
    use ValueObject;

    /**
     * @var string
     */
    protected $imageName;

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     * @return UserUploadedImage
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        return $this;
    }
}