<?php

namespace App\Http\Controllers;

use App\Helpers\GetProductsHelper;
use App\Helpers\GetPaginationQuantityHelper;
use App\Category;
use App\CategoryProduct;
use App\Http\Requests\StoreCategoryRequest;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const DEFAULT_PAGINATION_QUANTITY = 12;
    const ASCENDING_TYPE_OF_SORT = 'asc';
    const DESCENDING_TYPE_OF_SORT = 'desc';

    public function index()
    {
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $categories = Category::all()->sortBy('sort_number');
        return view('categories.index', [
            'categoriesHierarchically' => $categoriesHierarchically,
            'categories' => $categories
        ]);
    }

    public function create($id = null)
    {
        if(!empty($id)) {
            $category = Category::find($id);
            if($category) {
                return view('admin.partials._category_edit_create', [
                    'NameOfForm' => 'Edit category '.$category->category_name,
                    'alt_title' => 'Edit category '.$category->category_name,
                    'categories' => Category::all(),
                    'category' => $category
                ]);
            } else {
                return redirect('admin/category/list');
            }
        } else {
            return view('admin.partials._category_edit_create', [
                'NameOfForm' => 'Create new category',
                'alt_title' => 'Create new category',
                'categories' => Category::all()
            ]);
        }
    }

    public function store($id = null, StoreCategoryRequest $request)
    {
        $category = Category::find($id);

        if ($category) {
            $category->category_name = $request->post('category_name');
            $category->sort_number = $request->post('sort_number');
            $category->category_id = $request->post('category_id');
            $category->category_description = $request->post('category_description');
            if($request->has('category_logo')) {
                $image = $request->file('category_logo');
                $category->category_logo = $image->getClientOriginalName();
                $image->move(public_path('img/logo'), $image->getClientOriginalName());
            }
            $category->save();
            return redirect('admin/category/list');
        }

        $category = new Category();

        if($request->has('category_logo')) {
            $image = $request->file('category_logo');
            $category->category_logo = $image->getClientOriginalName();
            $image->move(public_path('img/logo'), $image->getClientOriginalName());
        }

        $category->category_name = $request->post('category_name');
        $category->sort_number = $request->post('sort_number');
        $category->category_id = $request->post('category_id') ? $request->post('category_id') : null;
        $category->save();

        return redirect('admin/category/list');
    }

    public function list()
    {
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $categories = Category::all()->sortBy('sort_number');
        return view('categories.categories', [
            'categories' => $categories,
            'categoriesHierarchically' => $categoriesHierarchically
        ]);
    }

    public function show($id, Request $request)
    {
        $category = Category::find($id);
        $paginateQuantity = (new GetPaginationQuantityHelper())->getPaginationQuantity($request);
        $products = (new GetProductsHelper())->getUserListBySortData($id, $request->get('sortType'), $paginateQuantity);

        if($category) {
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
