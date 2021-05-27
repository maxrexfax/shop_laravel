<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\Category;
use App\Helpers\PriceHelper;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Services\CategoryStoreService;
use App\Services\GetProductsService;
use App\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, ProductRepositoryInterface $productRepository)
    {
        if (!Session::has('defaultCurrency')) {
            Session::put('defaultCurrency', (new PriceHelper())->getCurrentCurrency());
        }
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }


    public function create()
    {
        return view('admin.partials.category._category_edit_create', [
                'categories' => $this->categoryRepository->all()
            ]);
    }

    public function edit(EditCategoryRequest $request)
    {
        return view('admin.partials.category._category_edit_create', [
            'categories' => $this->categoryRepository->all(),
            'category' => $this->categoryRepository->findById($request->get('id'))
        ]);
    }

    public function update(StoreCategoryRequest $request)
    {
        $this->categoryRepository->storeCategory($request);

        return redirect('admin/category/list');
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->storeCategory($request);

        return redirect('admin/category/list');
    }

    public function show($id, Request $request)
    {
        $category = null;
        if($id != null) {
            $category = $this->categoryRepository->findById($id);
        }

        $paginateQuantity = (new PaginationQuantityHelper())->getPaginationQuantity($request->get('paginateQuantity'));
        $products = $this->productRepository->getUserListBySortData($id, $request->get('sortType'), $paginateQuantity);

        if ($category) {
            return view('categories.products', [
                'products' => $products,
                'categoriesAll' => $this->categoryRepository->all(),
                'currentCategory' => $category,
                'paginateQuantity' => $paginateQuantity,
                'sortType' => $request->get('sortType'),
                'defaultCurrency' => Session::get('defaultCurrency'),
                'alternativeTitle' => $category->category_name,
            ]);
        } else {
            return redirect('category/list');
        }
    }

    public function list()
    {
        return view('categories.index', [
            'categories' => $this->categoryRepository->all(),
            'categoriesHierarchically' => $this->categoryRepository->getCategoriesWithChildren(),
        ]);
    }

    public function categoriesRootList()
    {
        $rootCategories = $this->categoryRepository->getRootCategories();
        return response()->json($rootCategories);
    }

    public function destroy(EditCategoryRequest $request)
    {
        $this->categoryRepository->destroy($request->get('id'));

        return back();
    }

}
