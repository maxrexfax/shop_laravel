@extends('layouts.app_admin')
@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="col-3 text-left admin-menu p-0">
                            <div class="dashboard-menu border_bottom oneHeight pl-2">
                                <i class="fa fa-dashboard fw ml-2"></i>
                                <span class=""><a class="url_no_decoration my-roboto-font-family font-weight-bold" href="{{route('admin')}}">{{ __('actions.dashboard') }}</a></span>
                            </div>
                            <div>
                                <div class="accordion_header border_bottom oneHeight pl-2">
                                    <i class="fa fa-tags fw ml-2"></i>
                                    <span class="ml-2"><b>{{__('actions.catalog')}}</b></span>
                                </div>

                                <div class="accordion_content p-0">
                                    <p class="w-100 border_bottom oneHeight"><a class="url_in_accordion ml-4 mb-0" href="{{route('admin.category.list')}}">{{ __('actions.categories') }}</a></p>
                                    <p class="w-100 border_bottom oneHeight"><a class="url_in_accordion ml-4 mb-0" href="{{route('admin.product.list')}}">{{ __('actions.products') }}</a></p>

                                </div>
                            </div>
                            <div>
                                <div class="accordion_header border_bottom oneHeight pl-2">
                                    <i class="fa fa-tags fw ml-2"></i>
                                    <span class="ml-2"><b>{{__('actions.settings')}}</b></span>
                                </div>

                                <div class="accordion_content p-0">
                                    <p class="w-100 border_bottom oneHeight"><a class="url_in_accordion ml-4 mb-0" href="{{route('admin.stores.list')}}">{{ __('actions.stores') }}</a></p>
                                    <p class="w-100 border_bottom oneHeight"><a class="url_in_accordion ml-4 mb-0" href="{{route('admin.currency.list')}}">{{ __('actions.currency') }}</a></p>
                                    <p class="w-100 border_bottom oneHeight"><a class="url_in_accordion ml-4 mb-0" href="{{route('admin.locales.list')}}">{{ __('actions.locales') }}</a></p>
                                    <p class="w-100 border_bottom oneHeight"><a class="url_in_accordion ml-4 mb-0" href="{{route('admin.deliveries.list')}}">{{ __('actions.deliveries') }}</a></p>
                                </div>
                            </div>
                            <div>
                                <div class="accordion_header border_bottom oneHeight pl-2">
                                    <i class="fa fa-tags fw ml-2"></i>
                                    <span class="ml-2"><b>{{__('actions.management')}}</b></span>
                                </div>

                                <div class="accordion_content p-0">
                                    <p class="w-100 border_bottom oneHeight"><a class="url_in_accordion ml-4 mb-0" href="{{route('admin.users.list')}}">{{ __('actions.users') }}</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 p-0 bg-secondary">
                            <main>
                                <div class="">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            @yield('admin.content')
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="place-holder"></section>
@endsection
