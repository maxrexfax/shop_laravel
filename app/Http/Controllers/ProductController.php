<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\PriceHelper;
use App\Http\Requests\StoreProductRequest;
use App\Product;
use App\Services\ProductStoreService;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function create($id = null)
    {
        if (!empty($id)) {
            $product = Product::find($id);
            if ($product) {
                return view('admin.partials.product._product_edit_create', [
                    'categories' => Category::all(),
                    'product' => $product
                ]);
            }

            return redirect('admin/product/list');
        }

        return view('admin.partials.product._product_edit_create', [
            'categories' => Category::all()
        ]);

    }

    public function store($id = null, StoreProductRequest $request)
    {
        $product = Product::find($id);

        if (!$product) {
            $product = new Product();
        }

        (new ProductStoreService())->store($request, $product);

        return redirect('admin/product/list');
    }

    public function show($id)
    {
        if (!Session::has('arrayOfVisitedProducts')) {
            Session::put('arrayOfVisitedProducts', []);
        }

        $product = Product::find($id);

        if ($product) {
            (new ProductStoreService())->addProductToSessionArray($id);
            return view('products.show', [
                'product' => $product,
                'alternativeTitle' => $product->title,
                'alternativeDescription' => $product->description,
                'arrayOfVisitedProducts' => Product::find(Session::get('arrayOfVisitedProducts')),
            ]);
        }

        return redirect('/');
    }

    public function images($id = null)
    {
        $product = Product::find($id);
        if ($product) {
            return view('images._images_edit', [
                'product' => $product,
                'images' => $product->getProductImages(),
            ]);
        }

        return redirect('admin/product/list');
    }

}
