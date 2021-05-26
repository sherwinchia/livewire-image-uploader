<?php

namespace Sherwinchia\LivewireImageUploader\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ImageUploader extends Component
{
    use WithFileUploads;
    public $rawImages;
    public $images = [];
    public $imagesName = [];
    public $model, $oldImages, $multiple, $name, $size;

    protected $messages = [
        'rawImages.*.image' => 'The image format not valid.',
        'rawImages.*.mimes' => 'The image format not valid.',
        'rawImages.*.max' => 'The image exceed the size limit.',
    ];

    public function mount(string $name, bool $multiple = null, int $size=1024, array $oldImages = null)
    {
        $this->multiple = $multiple;
        $this->name = $name;
        $this->size = $size;
        
        $multiple ?? $this->rawImages=[];

        $oldImages ?? $this->oldImages = $oldImages;
    }

    public function updatingRawImages()
    {
        $this->multiple ? $this->rawImages = [] : $this->rawImages = null;
        $this->images = [];
    }

    public function updatedRawImages($value)
    {
        $this->validate(
            ['rawImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:'.$this->size],
        );

        $this->multiple ? $this->images = $value : $this->images = [$value];
    }


    public function uploadImages()
    {
        if (!empty($this->imagesName)) {
            foreach ($this->imagesName as $image) {
                Storage::delete('public/image-uploader/' . $image);
            }
            $this->imagesName = array();
        }

        foreach ($this->images as $image) {
            $image->store('public/image-uploader');
            array_push($this->imagesName, $image->hashName());
        }
        return $this->handleImagesUpdated();
    }

    public function handleRemoveImage($index, $old = false)
    {
        if ($old) {
            $this->emitUp('deleteImage', $this->oldImages[$index]);
            // $this->oldImages[$index]->delete();
            unset($this->oldImages[$index]);
        } else {
            Storage::delete("public/image-uploader/" . $this->imagesName[$index]);
            unset($this->images[$index]);
            unset($this->imagesName[$index]);
            return $this->handleImagesUpdated();
        }
    }

    public function handleImagesUpdated()
    {
        $this->emitUp('imagesUpdated', $this->name, $this->imagesName);
    }

    public function render()
    {
        return view('livewire-image-uploader::livewire.image-uploader');
    }
}
