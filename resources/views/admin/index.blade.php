@extends('layouts.app')
@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="col-2 text-left admin-menu p-0">
                            <div class="dashboard-menu border_bottom oneHeight">
                                <i class="fa fa-dashboard fw ml-2"></i>
                                <span class="ml-2 "><a class="url_in_accordion" href="{{route('admin')}}">{{ __('Dashboard') }}</a></span>
                            </div>
<div id="accordion">
                            <div class="accordion_header border_bottom oneHeight">
                                <i class="fa fa-tags fw ml-2"></i>
                                <span class="ml-2 "><b>Catalog</b></span>
                            </div>

                            <div class="accordion_content p-0">
                                <p class="p-in-accordion border_bottom oneHeight"><a class="url_in_accordion ml-2 mb-0" href="{{route('admin.category.list')}}">{{ __('Categories') }}</a></p>
                                <p class="p-in-accordion border_bottom oneHeight"><a class="url_in_accordion ml-2 mb-0" href="{{route('admin.product.list')}}">{{ __('Products') }}</a></p>
                            </div>
</div>
                        </div>
                        <div class="col-10 p-0">
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
@endsection