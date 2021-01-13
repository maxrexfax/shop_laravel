<div class="container">
    <div class="row">
        @foreach($categories as $category)
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-10 col-12 border m-2 text-center">

                <img height="100px" src="/img/empty.png" alt="tmpalt"/>
                <h3>
                    <a class="url_no_decoration" href="{{ url('/') }}/product/category/{{$category->id}}">
                        {{$category->category_name}}
                    </a>
                </h3>

            <p>Category description</p>
        </div>
        @endforeach
    </div>
</div>
