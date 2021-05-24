<?php

namespace App\Repository\Eloquent;

use App\Category;
use App\Helpers\ImageHelper;
use App\Http\Requests\StoreCategoryRequest;
use App\Image;
use App\Repository\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function paginateModel(int $numberToShow)
    {
        return Category::paginate($numberToShow);
    }

    public function getCategoriesWithChildren()
    {
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        return $categoriesHierarchically;
    }

    public function getRootCategories()
    {
        return Category::whereNull('category_id')->get();
    }

    public function storeCategory($request)
    {
        $category = $this->model->find($request->post('id'));
        if (empty($category)) {
            $category = new Category();
        }
        $category->category_name = $request->post('category_name');
        $category->sort_number = $request->post('sort_number');
        $category->category_id = $request->post('category_id');
        $category->category_description = $request->post('category_description');
        if ($request->has('category_logo')) {
            if ($category->category_logo) {
                (new ImageHelper())->deleteImage($category->category_logo, Image::PATH_TO_SAVE_LOGOS);
            }

            $image = $request->file('category_logo');
            $category->category_logo = $image->getClientOriginalName();
            (new ImageHelper())->storeImageFile($image, '/img/logo/');
        }
        $category->save();
    }
}