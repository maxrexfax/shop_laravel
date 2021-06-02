@extends('layouts.app_admin')
@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="parent-container-dashboard bg-secondary">
                        <div class="div-left-column text-left admin-menu p-0">
                            <div class="dashboard-menu border-bottom oneHeight pl-2">
                                <i class="fa fa-dashboard fw ml-2"></i>
                                <span class=""><a class="url-no-decoration roboto-font-family font-weight-bold" href="{{route('admin')}}">{{ __('actions.dashboard') }}</a></span>
                            </div>
                            <div>
                                <div class="accordion-header border-bottom oneHeight pl-2">
                                    <i class="fa fa-tags fw ml-2"></i>
                                    <span class="ml-2"><b>{{__('actions.catalog')}}</b></span>
                                </div>

                                <div class="accordion-content p-0">
                                    <p class="w-100 border-bottom oneHeight"><a class="url-in-accordion ml-4 mb-0" href="{{route('admin.category.list')}}">{{ __('actions.categories') }}</a></p>
                                    <p class="w-100 border-bottom oneHeight"><a class="url-in-accordion ml-4 mb-0" href="{{route('admin.product.list')}}">{{ __('actions.products') }}</a></p>

                                </div>
                            </div>
                            <div>
                                <div class="accordion-header border-bottom oneHeight pl-2">
                                    <i class="fa fa-tags fw ml-2"></i>
                                    <span class="ml-2"><b>{{__('actions.sales')}}</b></span>
                                </div>

                                <div class="accordion-content p-0">
                                    <p class="w-100 border-bottom oneHeight"><a class="url-in-accordion ml-4 mb-0" href="{{route('admin.promocodes.list')}}">{{ __('actions.promocodes') }}</a></p>
                                    <p class="w-100 border-bottom oneHeight"><a class="url-in-accordion ml-4 mb-0" href="{{route('admin.orders.list')}}">{{ __('actions.orders') }}</a></p>
                                </div>
                            </div>
                            <div>
                                <div id="settings" class="accordion-header border-bottom oneHeight pl-2">
                                    <i class="fa fa-tags fw ml-2"></i>
                                    <span class="ml-2"><b>{{__('actions.settings')}}</b></span>
                                </div>

                                <div class="accordion-content p-0">
                                    <p class="w-100 border-bottom oneHeight"><a id="settingsPaymethod" class="url-in-accordion ml-4 mb-0" href="{{route('admin.paymethod.list')}}">{{ __('actions.paymethod') }}</a></p>
                                    <p class="w-100 border-bottom oneHeight"><a id="settingsStores" class="url-in-accordion ml-4 mb-0" href="{{route('admin.stores.list')}}">{{ __('actions.stores') }}</a></p>
                                    <p class="w-100 border-bottom oneHeight"><a id="settingsCurrency" class="url-in-accordion ml-4 mb-0" href="{{route('admin.currency.list')}}">{{ __('actions.currency') }}</a></p>
                                    <p class="w-100 border-bottom oneHeight"><a id="settingsLocales" class="url-in-accordion ml-4 mb-0" href="{{route('admin.locales.list')}}">{{ __('actions.locales') }}</a></p>
                                    <p class="w-100 border-bottom oneHeight"><a id="settingsDeliveries" class="url-in-accordion ml-4 mb-0" href="{{route('admin.deliveries.list')}}">{{ __('actions.deliveries') }}</a></p>
                                </div>
                            </div>
                            <div>
                                <div id="management" class="accordion-header border-bottom oneHeight pl-2">
                                    <i class="fa fa-tags fw ml-2"></i>
                                    <span class="ml-2"><b>{{__('actions.management')}}</b></span>
                                </div>

                                <div class="accordion-content p-0">
                                    <p class="w-100 border-bottom oneHeight"><a id="managementUsers" class="url-in-accordion ml-4 mb-0" href="{{route('admin.users.list')}}">{{ __('actions.users') }}</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="div-right-column">
                            <div class="col-md-12 p-0">
                                @yield('admin.content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="place-holder"></section>
@endsection
