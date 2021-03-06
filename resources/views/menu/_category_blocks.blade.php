<div class="container">
    <div class="row">
        @foreach($categories as $category)
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-10 col-12 border m-2 text-center pt-1">
            <a class="url-no-decoration" href="{{route ('product.category', ['id' => $category->id] )}}">
                @if($category->category_logo)
                    <img width="150px" src="{{ asset('img/logo/' . $category->category_logo) }}" alt="{{$category->category_name}}"/>
                @else
                    <img width="150px" src="{{ asset('img/empty.png') }}" alt="No logo"/>
                @endif
            </a>
                <h3>
                    <a class="url-no-decoration" href="{{route ('product.category', ['id' => $category->id] )}}">
                        {{$category->category_name}}
                    </a>
                </h3>
            <p>Category description</p>
        </div>
        @endforeach
    </div>
</div>
