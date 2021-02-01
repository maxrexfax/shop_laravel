<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCategoryMenu" aria-controls="navbarCategoryMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCategoryMenu">
        <ul class="navbar-nav mr-auto">
            @foreach($categoriesHierarchically as $categoryH)
                <li class="nav-item active">
                    @if($categoryH->childrenCategories->isNotEmpty())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$categoryH->category_name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="{{ route('product.category', ['id' => $categoryH->id]) }}">{{$categoryH->category_name}}</a>
                        @foreach ($categoryH->childrenCategories as $childCategory)
                                @include('categories.child_category', ['child_category' => $childCategory])
                            @endforeach
                        </div>
                    </li>
                    @else
                        <a class="nav-link" href="{{ route('product.category', ['id' => $categoryH->id]) }}">{{$categoryH->category_name}}</a>
                    @endif
                </li>
            @endforeach
        </ul>
        <ul class="navbar-nav ml-auto form-inline">
            <li class="nav-item active form-group">
                <label class="limiter-label mr-2">{{__('actions.show')}}</label>
                <select class="form-control mr-2" id="selectPaginationQuantity">
                    <option value="6">6 {{__('per_page')}}</option>
                    <option value="12">12 {{__('per_page')}}</option>
                    <option value="40">40 {{__('per_page')}}</option>
                </select>
            </li>
            <li class="nav-item active form-group">
                <label class="limiter-label mr-2">{{__('actions.sort_by')}}</label>
                <select class="form-control" id="selectPaginationQuantity">
                    <option value="1">{{__('actions.price')}}</option>
                    <option value="2">{{__('actions.name')}}</option>
                    <option value="3">{{__('actions.rating')}}</option>
                </select>
            </li>
        </ul>
    </div>
</nav>
</div>
