<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($productId)
    {
        $images = Image::where('product_id', $productId)->get();
        if($images) {
            return $images;
        }

        return null;
    }

    public function store(Request $request)
    {
        $savingImage = new Image();
        $image = $request->file('imageAdd');
        $savingImage->image_name = $image->getClientOriginalName();
        $savingImage->product_id = $request->post('product_id');
        $image->move(public_path('img/images'), $image->getClientOriginalName());
        $savingImage->save();

        return redirect('product/images/' . $request->post('product_id'));

    }

    public function delete($imageId)
    {
        $image = Image::find($imageId);
        if($image) {
            $image->delete();
        }
    }
}
