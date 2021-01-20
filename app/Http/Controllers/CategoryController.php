<?php

namespace App\Http\Controllers;

use App\Category;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const DEFAULT_PAGINATION_QUANTITY = 6;

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

    public function store($id = null, Request $request)
    {
        $category = Category::find($id);

        if ($category) {
            $category->category_name = $request->post('category_name');
            $category->sort_number = $request->post('sort_number');
            $category->category_id = $request->post('category_id');
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
        $tmpPaginateQuantity = self::DEFAULT_PAGINATION_QUANTITY;
        $category = Category::find($id);
        if($request->get('paginationQuantity')) {
            $tmpPaginateQuantity = $request->get('paginationQuantity');
            //$products = $category->products()->paginate($tmpPaginateQuantity);
        } else {
            //$products = $category->products()->paginate(self::DEFAULT_PAGINATION_QUANTITY);
        }

        $products = $category->products()->paginate($tmpPaginateQuantity);

        if ($request->get('sortType')=='price') {
            $products = $category->getProductsByPriceAsc()->forPage($request->get('page'), $tmpPaginateQuantity);
        } else if ($request->get('sortType')=='product_name') {
            $products = $category->getProductsByName()->forPage($request->get('page'), $tmpPaginateQuantity);
        }

        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        if($category) {
            return view('categories.products', [
                'categoriesHierarchically' => $categoriesHierarchically,
                'products' => $products,
                'categoriesAll' => Category::all(),
                'currentCategoryName' => $category,
                'tmpPaginateQuantity' => $tmpPaginateQuantity,
                'direction' => $request->get('direction') ? $request->get('direction') : '',
                'sortType' => $request->get('sortType') ? $request->get('sortType') : '',
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
