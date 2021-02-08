<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Services\CategoryStoreService;
use App\Services\GetProductsService;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    public function create($id = null)
    {
        if (!empty($id)) {
            $category = Category::find($id);
            if($category) {
                return view('admin.partials.category._category_edit_create', [
                    'categories' => Category::all(),
                    'category' => $category
                ]);
            }

            return redirect('admin/category/list');
        }

        return view('admin.partials.category._category_edit_create', [
                'categories' => Category::all()
            ]);

    }

    public function store($id = null, StoreCategoryRequest $request)
    {
        $category = Category::find($id);

        if (!$category) {
            $category = new Category();
        }

        (new CategoryStoreService())->storeCategory($request, $category);

        return redirect('admin/category/list');
    }

    public function show($id, Request $request)
    {
        $category = Category::find($id);
        $paginateQuantity = (new PaginationQuantityHelper())->getPaginationQuantity($request->get('paginateQuantity'));
        $products = (new GetProductsService())
                ->getUserListBySortData($id, $request
                ->get('sortType'), $paginateQuantity);
        if ($category) {
            return view('categories.products', [
                'products' => $products,
                'categoriesAll' => Category::all(),
                'currentCategory' => $category,
                'paginateQuantity' => $paginateQuantity,
                'sortType' => $request->get('sortType'),
                'activeCurrency' => session('defaultCurrency'),
                'alternativeTitle' => $category->category_name,
            ]);
        } else {
            return redirect('category/list');
        }
    }

    public function categoriesRootList()
    {
        $rootCategories = Category::whereNull('category_id')->get();
        return response()->json($rootCategories);
    }

}
