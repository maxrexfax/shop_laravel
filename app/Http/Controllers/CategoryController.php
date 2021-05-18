<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\Category;
use App\Helpers\PriceHelper;
use App\Http\Requests\StoreCategoryRequest;
use App\Services\CategoryStoreService;
use App\Services\GetProductsService;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        if (!Session::has('defaultCurrency')) {
            Session::put('defaultCurrency', (new PriceHelper())->getCurrentCurrency());
        }
    }

    /**
     *  Create new or edit existing Category
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
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

    /**
     * Store Categories function in controller
     * @param null $id
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
            'categories' => Category::all(),
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
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }

        return back();
    }

}
