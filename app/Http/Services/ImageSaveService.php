<?php

namespace App\Http\Services;

class ImageSaveService
{

    public static function saveImage($image, $path, $option){
        try {
            return $image?->store($path, $option);
        } catch (\Exception $e) {
            echo 'Image Helper saveImage ' .$e->getMessage();
        }
    }

}
