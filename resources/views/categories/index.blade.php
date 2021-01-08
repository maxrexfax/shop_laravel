@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                   <p>Some content for index of categories</p>

                    @include('menu._category_menu')
                </div>
            </div>
        </div>
    </div>
@endsection
