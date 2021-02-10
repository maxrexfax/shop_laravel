@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card background-as-nav">
                @include('menu._category_menu')
            </div>
            <div class="card">
                @include('menu._category_blocks')
            </div>
        </div>
    </div>
@endsection
