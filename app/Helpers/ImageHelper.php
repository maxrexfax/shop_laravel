<?php

namespace App\Helpers;

use App\Image;

class ImageHelper
{
    public function storeImageFile($image, $path)
    {
        $image->move(public_path($path), $image->getClientOriginalName());
    }

    public function deleteImage($image, $path)
    {
        $image_path = public_path() . $path . $image;
        unlink($image_path);
    }
}
