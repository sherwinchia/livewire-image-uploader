<div class="image-uploader-container">
    @if (!is_null($oldImages) && !empty($oldImages))
        <h4>Current Images</h4>
        <div class="image-wrapper mb-4">
            @foreach ($oldImages as $index => $image)
                <div class="single-image">
                    <img src="{{ asset('storage/image-uploader/' . $image) }}" width="" alt="">
                    <button type="button" wire:loading.attr="disabled"
                        wire:target="handleRemoveImage({{ $index }}, true)"
                        wire:click.prevent="handleRemoveImage({{ $index }}, true)">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
    <h4 class=" mb-4">Selected image(s)</h4>
    @if (empty($images))
        <div class="image-uploader-no-image">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
            </svg>
            <label>No image selected</label>
        </div>
    @else
        <div class="image-wrapper">
            @foreach ($images as $index => $image)
                <div class="single-image mb-4">
                    <img src="{{ $image->temporaryUrl() }}" alt="uploaded-image">
                    <label class="">{{ $image->getClientOriginalName() }}</label>
                    <button type="button" wire:loading.attr="disabled"
                        wire:target="handleRemoveImage({{ $index }})"
                        wire:click.prevent="handleRemoveImage({{ $index }})">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
    <div class="input-wrapper">
        <input id="imagesInput" type="file" accept="image/*" wire:model="rawImages"
            {{ $multiple ? 'multiple' : null }}>
        <div class="drop-zone">
            <div class="" wire:loading wire:target="rawImages">
                Uploading...
            </div>

            <p wire:loading.remove wire:target="rawImages" class="text-gray-400">
                @if ($multiple)
                    Drop files anywhere to upload
                    <br />
                    or <br> Select Files
                @else
                    Drop file anywhere to upload
                    <br />
                    or <br> Select File
                @endif
            </p>
        </div>
    </div>
    @error('rawImages.*')
        <span class="error-msg">{{ $message }}</span>
    @enderror
    @error('rawImages')
        <span class="error-msg">{{ $message }}</span>
    @enderror
</div>
