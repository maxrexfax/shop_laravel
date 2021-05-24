<?php

namespace App\Http\Controllers;

use App\Category;
use App\Currency;
use App\Delivery;
use App\Helpers\PaginationQuantityHelper;
use App\Image;
use App\Locale;
use App\Order;
use App\PaymentMethod;
use App\Product;
use App\Promocode;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\CurrencyRepositoryInterface;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\ImageRepositoryInterface;
use App\Repository\LocaleRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\PaymentMethodRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\StoreRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller
{
    protected $imageRepository;
    protected $productRepository;
    protected $userRepository;
    protected $categoryRepository;
    protected $storeRepository;
    protected $currencyRepository;
    protected $localeRepository;
    protected $deliveryRepository;
    protected $promocodeRepository;
    protected $paymentMethodRepository;
    protected $ordersRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ImageRepositoryInterface $imageRepository,
                                ProductRepositoryInterface $productRepository,
                                UserRepositoryInterface $userRepository,
                                CategoryRepositoryInterface $categoryRepository,
                                StoreRepositoryInterface $storeRepository,
                                CurrencyRepositoryInterface $currencyRepository,
                                LocaleRepositoryInterface $localeRepository,
                                DeliveryRepositoryInterface $deliveryRepository,
                                ProductRepositoryInterface $promocodeRepository,
                                PaymentMethodRepositoryInterface $paymentMethodRepository,
                                OrderRepositoryInterface $ordersRepository
    )
    {
        $this->middleware('auth');
        $this->imageRepository = $imageRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->storeRepository = $storeRepository;
        $this->currencyRepository = $currencyRepository;
        $this->localeRepository = $localeRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->promocodeRepository = $promocodeRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->ordersRepository = $ordersRepository;

    }

    public function index()
    {
        return view('admin.index');
    }

    public function categoryList()
    {
        return view('admin.partials.category._category_list', [
            'categoriesHierarchically' => $this->categoryRepository->getCategoriesWithChildren(),
            'categories' =>$this->categoryRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.categories_list'),
        ]);
    }

    public function productList()
    {
        return view('admin.partials.product._product_list', [
            'products' => $this->productRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'images' => $this->imageRepository->all(),
            'categoriesHierarchically' => $this->categoryRepository->getCategoriesWithChildren(),
            'alternativeTitle' => Lang::get('messages.product_list'),
        ]);
    }

    public function userList()
    {
        return view('admin.partials.user._users_list', [
            'users' => $this->userRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.users_list'),
        ]);
    }

    public function storeList()
    {
        return view('admin.partials.store._stores_list', [
            'stores' => $this->storeRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.stores_list'),
        ]);
    }

    public function currencyList()
    {
        return view('admin.partials.currency._currency_list', [
                'currencies' => $this->currencyRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
                'alternativeTitle' => Lang::get('messages.currency_list'),
            ]
        );
    }

    public function localesList()
    {
        return view('admin.partials.locale._locales_list', [
            'locales' => $this->localeRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.locales_list'),
        ]);
    }

    public function deliveriesList()
    {
        return view('admin.partials.delivery._deliveries_list', [
            'deliveries' => $this->deliveryRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.deliveries_list'),
        ]);
    }

    public function promocodesList()
    {
        return view('admin.partials.promocode._promocodes_list', [
            'promocodes' => $this->promocodeRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
        ]);
    }

    public function paymethodList()
    {
        return view('admin.partials.paymethod._paymethods_list', [
            'paymentMethods' => $this->paymentMethodRepository->paginateModel(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('text.paymethods_list'),
        ]);
    }

    public function ordersList()
    {
        return view('admin.partials.orders._orders_list', [
            'orders' => $this->ordersRepository->ordersWithProducts(),
            'alternativeTitle' => Lang::get('text.orders_list'),
        ]);
    }

}
