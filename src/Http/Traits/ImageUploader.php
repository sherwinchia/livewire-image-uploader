<?php

namespace Sherwinchia\LivewireImageUploader\Http\Traits;

trait ImageUploader
{
    public function getListeners()
    {
        return $this->listeners + [
            'imagesUpdated', 'deleteImage'
        ];
    }

    public function imagesUpdated($propertyName, $imagesName)
    {
        //return array of images name
        $this->$propertyName = $imagesName;
    }

    public function deleteImage($oldImage)
    {
        //return image URL
        //delete image
        dd($oldImage);
    }
}
