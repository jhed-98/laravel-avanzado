<?php

namespace App\Tasks;

use Illuminate\Support\Facades\Log;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class DeleteStorageImage
{
    public function __invoke()
    {
        $files = Storage::files('images');
        $images  = Image::pluck('url')->toArray();
        Storage::delete(array_diff($files, $images));
        Log::info('🚀 Eliminando images no publicadas...');
    }
}
