@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center">{{__('text.select_category')}}</h1>
            <div class="card">
                @include('menu._category_blocks')
            </div>
        </div>
    </div>
<section class="place-holder"></section>
@endsection
