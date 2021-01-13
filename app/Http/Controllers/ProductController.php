<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProduct;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return $this->showAllProducts();
    }

    public function create($id = null)
    {
        if(!empty($id)) {
            $product = Product::find($id);
            if($product) {
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

    public function store($id = null, Request $request)
    {
        $product = Product::find($id);

        if($product) {
            $product->product_name = $request->post('product_name');
            $product->rating = $request->post('rating');
            $product->price = $request->post('price');
            $product->description = $request->post('description');
            $product->title = $request->post('title');
            $product->short_description = $request->post('short_description');
            $product->full_description = $request->post('full_description');

            if($request->has('logo_image')) {
                $image = $request->file('logo_image');
                $product->logo_image = $image->getClientOriginalName();
                $image->move(public_path('img/logo'), $image->getClientOriginalName());
            }

            $product->save();

            var_dump($request->post('categories'));
            if ($request->post('categories')) {

                CategoryProduct::where('product_id', $product->id)->delete();

                foreach ($request->post('categories') as $category) {
                    $categoryProduct = new CategoryProduct();
                    $categoryProduct->product_id = $product->id;
                    $categoryProduct->category_id = $category;
                    $categoryProduct->save();
                }
            }

            return redirect('admin/product/list');
        }
        $product = new Product($request->post());
        if($request->has('logo_image')) {
            $image = $request->file('logo_image');
            $product->logo_image = $image->getClientOriginalName();
            $image->move(public_path('img/logo'), $image->getClientOriginalName());
        }

        if ($request->post('categories')) {
            foreach ($request->post('categories') as $category) {
                $categoryProduct = new CategoryProduct();
                $categoryProduct->product_id = $product->id;
                $categoryProduct->category_id = $category;
                $categoryProduct->save();
            }
        }
        $product->save();

        return redirect('admin/product/list');
    }

}
