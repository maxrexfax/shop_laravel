<?php

namespace App\Repository\Eloquent;

use App\Helpers\ImageHelper;
use App\Image;
use App\Repository\ImageRepositoryInterface;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    protected $model;

    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        $savingImage = new Image();
        $image = $request->file('imageAdd');
        (new ImageHelper())->storeImageFile($image, Image::PATH_TO_SAVE_PRODUCT_IMAGES);
        $savingImage->image_name = $image->getClientOriginalName();
        $savingImage->product_id = $request->post('product_id');
        $savingImage->sort_number = $request->post('sort_number');
        $savingImage->save();
    }

}