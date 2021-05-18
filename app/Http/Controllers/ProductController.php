<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\PriceHelper;
use App\Http\Requests\StoreProductRequest;
use App\Product;
use App\Repository\ProductRepositoryInterface;
use App\Services\ProductStoreService;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        if (!Session::has('arrayOfVisitedProducts')) {
            Session::put('arrayOfVisitedProducts', []);
        }
        $this->productRepository = $productRepository;
    }

    /**
     * Create new or edit existing Product
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
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

    /**
     * Store Product function in controller
     * @param null $id
     * @param StoreProductRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StoreProductRequest $request)
    {
        $product = Product::find($id);

        if (!$product) {
            $product = new Product();
        }

        $this->productRepository->store($request, $product);
        //(new ProductStoreService())->store($request, $product);

        return redirect('admin/product/list');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            (new ProductStoreService())->addProductToSessionArray($id);
            return view('products.show', [
                'product' => $product,
                'alternativeTitle' => $product->title,
                'alternativeDescription' => $product->description,
                'arrayOfVisitedProducts' => Product::find(Session::get('arrayOfVisitedProducts')),//str N59 protects from null
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

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }

        return back();
    }

    public function productsList($category_id)
    {
        $category = Category::find($category_id);
        return !empty($category) ? response()->json($category->getProducts()) : 0;
    }

    public function productInfo($product_id)
    {
        $product = Product::find($product_id);
        return $product ? response()->json($product) : 'null';
    }

}
