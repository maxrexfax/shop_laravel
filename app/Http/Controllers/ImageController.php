<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\ImageHelper;
use App\Http\Requests\StoreImageRequest;
use App\Image;
use App\Product;
use App\Services\ImageStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreImageRequest $request)
    {
        (new ImageStoreService())->store($request);

        return redirect('product/images/' . $request->post('product_id'));

    }

    public function delete($imageId, Request $request)
    {
        $image = Image::find($imageId);
        if ($image) {
            $image->delete();
            (new ImageHelper())->deleteImage($image->image_name, '/img/' . $request->get('subPath') . '/');
        }

        return redirect()->back();
    }

    public function changeSortOrder(Request $request)
    {
        $image = Image::find($request->post('image_id'));
        $image->sort_number = $request->post('sort_number');
        $image->save();

        return redirect()->back();
    }
}
