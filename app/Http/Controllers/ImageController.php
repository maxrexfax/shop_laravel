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

    public function store(Request $request)
    {
        $savingImage = new Image();
        $image = $request->file('imageAdd');
        $savingImage->image_name = $image->getClientOriginalName();
        $savingImage->product_id = $request->post('product_id');
        $savingImage->sort_number = $request->post('sort_number');
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
