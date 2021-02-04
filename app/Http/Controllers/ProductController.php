<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Product;
use App\Services\ProductStoreService;

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
            } else {
                return redirect('admin/product/list');
            }
        } else {
            return view('admin.partials.product._product_edit_create', [
                'categories' => Category::all()
            ]);
        }
    }

    public function store($id = null, StoreProductRequest $request)
    {
        $product = Product::find($id);

        if ($product) {
            (new ProductStoreService())->store($request, $product);

            return redirect('admin/product/list');
        }

        $product = new Product($request->post());
        (new ProductStoreService())->store($request, $product);

        return redirect('admin/product/list');
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('products.show', [
                'product' => $product,
                'alternativeTitle' => $product->title,
                'alternativeDescription' => $product->description,
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
