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
                return view('admin.partials._product_edit_create', [
                    'NameOfForm' => 'Edit product '.$product->product_name,
                    'alt_title' => 'Edit product '.$product->product_name,
                    'categories' => Category::all(),
                    'product' => $product
                ]);
            } else {
                return redirect('admin/product/list');
            }
        } else {
            return view('admin.partials._product_edit_create', [
                'NameOfForm' => 'Create new product',
                'alt_title' => 'Create new product',
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
                'alt_title' => $product->title,
                'altDescription' => $product->description,
            ]);
        }
        return redirect('/');
    }

}
