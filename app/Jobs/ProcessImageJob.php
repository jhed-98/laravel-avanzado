<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class ProcessImageJob implements ShouldQueue
{
    use Queueable;

    public $image_path;
    /**
     * Create a new job instance.
     */
    public function __construct($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $image = Storage::get($this->image_path);
        // create new manager instance with desired driver
        $img = ImageManager::gd()->read($image);
        // scale down to fixed width & encode as the originally read image format but with a certain quality
        $img->scaleDown(width: 1280);
        $img->encode(new AutoEncoder(quality: 10));

        $pointer = $img->toJpeg()->toFilePointer();
        Storage::put($this->image_path, $pointer);
        Log::info('📩 Imagen redimencionada: ' . $this->image_path);
    }
}
