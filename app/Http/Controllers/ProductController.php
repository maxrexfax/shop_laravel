<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\PriceHelper;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Product;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Services\ProductStoreService;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        if (!Session::has('arrayOfVisitedProducts')) {
            Session::put('arrayOfVisitedProducts', []);
        }

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function create($id = null)
    {
        return view('admin.partials.product._product_edit_create', [
            'categories' => $this->categoryRepository->all()
        ]);
    }

    public function edit(EditProductRequest $request)
    {
        return view('admin.partials.product._product_edit_create', [
            'categories' => $this->categoryRepository->all(),
            'product' => $this->productRepository->findById($request->get('id'))
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $this->productRepository->store($request);

        return redirect('admin/product/list');
    }

    public function update(StoreProductRequest $request)
    {
        $this->productRepository->store($request);

        return redirect('admin/product/list');
    }

    public function show($id)
    {
        $product = $this->productRepository->findById($id);

        if ($product) {
            (new ProductStoreService())->addProductToSessionArray($id);
            return view('products.show', [
                'product' => $product,
                'alternativeTitle' => $product->title,
                'alternativeDescription' => $product->description,
                'arrayOfVisitedProducts' => $this->productRepository->getArrayOfProductsByIds(Session::get('arrayOfVisitedProducts')),
            ]);
        }

        return redirect('/');
    }

    public function images($id = null)
    {
        $product = $this->productRepository->findById($id);
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
        $product = $this->productRepository->findById($id);
        if ($product) {
            $this->productRepository->destroy($id);
        }

        return back();
    }

    public function productsList($category_id)
    {
        $category = $this->categoryRepository->findById($category_id);

        return !empty($category) ? response()->json($category->getProducts()) : 0;
    }

    public function productInfo($product_id)
    {
        $product = $this->productRepository->findById($product_id);

        return $product ? response()->json($product) : 'null';
    }

}
