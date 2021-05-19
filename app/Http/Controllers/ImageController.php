<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\ImageHelper;
use App\Http\Requests\StoreImageRequest;
use App\Image;
use App\Product;
use App\Repository\ImageRepositoryInterface;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    protected $imageRepository;
    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->middleware('auth');
        $this->imageRepository = $imageRepository;
    }

    /**
     * Store Image function in controller
     * @param StoreImageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(StoreImageRequest $request)
    {
        $this->imageRepository->store($request);

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
