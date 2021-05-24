<?php

namespace App\Providers;

use App\Repository\CategoryRepositoryInterface;
use App\Repository\CurrencyRepositoryInterface;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\CurrencyRepository;
use App\Repository\Eloquent\DeliveryRepository;
use App\Repository\Eloquent\ImageRepository;
use App\Repository\Eloquent\LocaleRepository;
use App\Repository\Eloquent\OrderProductRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\OrderStatusRepository;
use App\Repository\Eloquent\PaymentMethodRepository;
use App\Repository\Eloquent\PhoneRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\PromocodeRepository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\StoreCurrencyRepository;
use App\Repository\Eloquent\StoreRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\ImageRepositoryInterface;
use App\Repository\LocaleRepositoryInterface;
use App\Repository\OrderProductRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\OrderStatusRepositoryInterface;
use App\Repository\PaymentMethodRepositoryInterface;
use App\Repository\PhoneRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\PromocodeRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\StoreCurrencyRepositoryInterface;
use App\Repository\StoreRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PromocodeRepositoryInterface::class, PromocodeRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(PhoneRepositoryInterface::class, PhoneRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(LocaleRepositoryInterface::class, LocaleRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(OrderStatusRepositoryInterface::class, OrderStatusRepository::class);
        $this->app->bind(OrderProductRepositoryInterface::class, OrderProductRepository::class);
        $this->app->bind(StoreCurrencyRepositoryInterface::class, StoreCurrencyRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
