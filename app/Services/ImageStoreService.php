<?php

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Image;

class ImageStoreService
{
    public function store($request)
    {
        $savingImage = new Image();
        $image = $request->file('imageAdd');
        (new ImageHelper())->storeImageFile($image, '/img/images');
        $savingImage->image_name = $image->getClientOriginalName();
        $savingImage->product_id = $request->post('product_id');
        $savingImage->sort_number = $request->post('sort_number');
        $savingImage->save();
    }
}
