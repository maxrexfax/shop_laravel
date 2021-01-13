<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCategoryMenu" aria-controls="navbarCategoryMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCategoryMenu">
        <ul class="navbar-nav mr-auto">
            @foreach($categoriesHierarchically as $catIer)
                <li class="nav-item active">

                    @if(count($catIer->childrenCategories)>0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$catIer->category_name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="{{ url('/') }}/product/category/{{$catIer->id}}">{{$catIer->category_name}}</a>
                        @foreach ($catIer->childrenCategories as $childCategory)
                                @include('categories.child_category', ['child_category' => $childCategory])
                            @endforeach
                        </div>
                    </li>
                    @else
                        <a class="nav-link" href="{{ url('/') }}/product/category/{{$catIer->id}}">{{$catIer->category_name}}</a>
                    @endif

                </li>
            @endforeach

        </ul>
    </div>
</nav>
</div>