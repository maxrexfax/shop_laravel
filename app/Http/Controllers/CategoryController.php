<?php

namespace App\Http\Controllers;

use App\Helpers\GetPaginationQuantityHelper;
use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Services\CategoryStoreService;
use App\Services\GetProductsService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create($id = null)
    {
        if (!empty($id)) {
            $category = Category::find($id);
            if($category) {
                return view('admin.partials._category_edit_create', [
                    'alt_title' => 'Edit category '.$category->category_name,
                    'categories' => Category::all(),
                    'category' => $category
                ]);
            } else {
                return redirect('admin/category/list');
            }
        } else {
            return view('admin.partials._category_edit_create', [
                'alt_title' => 'Create new category',
                'categories' => Category::all()
            ]);
        }
    }

    public function store($id = null, StoreCategoryRequest $request)
    {
        $category = Category::find($id);

        if ($category) {
            (new CategoryStoreService())->storeCategory($request, $category);

            return redirect('admin/category/list');
        }

        $category = new Category();
        (new CategoryStoreService())->storeCategory($request, $category);

        return redirect('admin/category/list');
    }

    public function show($id, Request $request)
    {
        $category = Category::find($id);
        $paginateQuantity = (new GetPaginationQuantityHelper())->getPaginationQuantity($request);
        $products = (new GetProductsService())->getUserListBySortData($id, $request->get('sortType'), $paginateQuantity);

        if ($category) {
            return view('categories.products', [
                'products' => $products,
                'categoriesAll' => Category::all(),
                'currentCategory' => $category,
                'paginateQuantity' => $paginateQuantity,
                'sortType' => $request->get('sortType'),
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
