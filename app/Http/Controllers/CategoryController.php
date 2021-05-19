<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\Category;
use App\Helpers\PriceHelper;
use App\Http\Requests\StoreCategoryRequest;
use App\Repository\CategoryRepositoryInterface;
use App\Services\CategoryStoreService;
use App\Services\GetProductsService;
use App\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        if (!Session::has('defaultCurrency')) {
            Session::put('defaultCurrency', (new PriceHelper())->getCurrentCurrency());
        }
        $this->categoryRepository = $categoryRepository;
    }


    public function create()
    {
        return view('admin.partials.category._category_edit_create', [
                'categories' => $this->categoryRepository->all()
            ]);
    }

    public function edit($id = null)
    {
        if($id == null) {
            return redirect('admin/category/list');
        }

        return view('admin.partials.category._category_edit_create', [
            'categories' => $this->categoryRepository->all(),
            'category' => $this->categoryRepository->findById($id)
        ]);
    }

    public function update($id = null, StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->findById($id);

        $this->categoryRepository->storeCategory($request, $category);

        return redirect('admin/category/list');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();

        $this->categoryRepository->storeCategory($request, $category);

        return redirect('admin/category/list');
    }

    public function show($id, Request $request)
    {
        $category = null;
        if($id != null) {
            $category = $this->categoryRepository->findById($id);
        }

        $paginateQuantity = (new PaginationQuantityHelper())->getPaginationQuantity($request->get('paginateQuantity'));
        $products = (new GetProductsService())
                ->getUserListBySortData($id, $request
                ->get('sortType'), $paginateQuantity);

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
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        return view('categories.index', [
            'categories' => $this->categoryRepository->all(),
            'categoriesHierarchically' => $categoriesHierarchically,
        ]);
    }

    public function categoriesRootList()
    {
        $rootCategories = Category::whereNull('category_id')->get();
        return response()->json($rootCategories);
    }

    public function destroy($id)
    {
        $category = $this->categoryRepository->findById($id);
        if ($category) {
            $this->categoryRepository->destroy($id);
        }

        return back();
    }

}
