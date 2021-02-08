<?php

namespace App\Services;

use App\Image;

class ImageStoreService
{
    public function store($request)
    {
        $savingImage = new Image();
        $image = $request->file('imageAdd');
        $savingImage->image_name = $image->getClientOriginalName();
        $savingImage->product_id = $request->post('product_id');
        $savingImage->sort_number = $request->post('sort_number');
        $image->move(public_path('img/images'), $image->getClientOriginalName());
        $savingImage->save();
    }
}
