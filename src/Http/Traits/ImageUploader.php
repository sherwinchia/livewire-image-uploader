<?php

namespace Sherwinchia\LivewireImageUploader\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageUploader
{
    public function getListeners()
    {
        return ['imagesUpdated', 'deleteImage'];
    }

    public function imagesUpdated($propertyName, $imagesName)
    {
        //return array of uploaded images name
        $this->$propertyName = $imagesName;
    }

    public function deleteImage($oldImage)
    {
        //delete image
        Storage::delete('public/image-uploader/' . $oldImage);
    }
}
