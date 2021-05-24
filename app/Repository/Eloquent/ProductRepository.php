<?php

namespace App\Repository\Eloquent;

use App\Category;
use App\CategoryProduct;
use App\Helpers\ImageHelper;
use App\Http\Requests\StoreProductRequest;
use App\Image;
use App\Repository\ProductRepositoryInterface;
use App\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function paginateModel(int $numberToShow)
    {
        return Product::paginate($numberToShow);
    }

    public function getArrayOfProductsByIds($arrayOfIds)
    {
        return Product::find($arrayOfIds);
    }

    public function getUserListBySortData($id, $sortType, $paginateQuantity)
    {
        $cmd = '';
        if ($sortType === Category::ASCENDING_TYPE_OF_SORT) {
            $cmd = 'price ASC';
        } else if ($sortType === Category::DESCENDING_TYPE_OF_SORT){
            $cmd = 'price DESC';
        } else {
            $cmd = 'product_name ASC';
        }

        return Product::whereHas('categories', function ($subQuery) use ($id) {
            $subQuery->where('categories.id', $id);
        })
            ->orderByRaw($cmd)
            ->paginate($paginateQuantity);
    }

    /**
     * Store all properties of the Product
     * @param StoreProductRequest $request
     * @param $product
     */
    public function store(StoreProductRequest $request, $product)
    {
        $logo = null;
        $product = $this->model->findById($request->post('id'));
        if (empty($product)) {
            $product = new Product();
        }

        if ($product->logo_image) {
            $logo = $product->logo_image;
        }

        $product->fill($request->post());

        if ($request->has('logo_image')) {
            if ($logo) {
                (new ImageHelper())->deleteImage($logo, Image::PATH_TO_SAVE_LOGOS);
            }

            $image = $request->file('logo_image');
            $product->logo_image = $image->getClientOriginalName();

            (new ImageHelper())->storeImageFile($image, Image::PATH_TO_SAVE_LOGOS);
        } else {
            $product->logo_image = $logo;
        }

        $product->save();

        if ($request->post('categories')) {

            CategoryProduct::where('product_id', $product->id)->delete();

            foreach ($request->post('categories') as $category) {
                $categoryProduct = new CategoryProduct();
                $categoryProduct->product_id = $product->id;
                $categoryProduct->category_id = $category;
                $categoryProduct->save();
            }
        }
    }

}