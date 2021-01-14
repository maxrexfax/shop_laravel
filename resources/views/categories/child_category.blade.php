<a class="dropdown-item" href="{{ route('product.category', ['id' => $child_category->id]) }}">{{$child_category->category_name}}</a>
@if ($child_category->categories)
    <ul>
        @foreach ($child_category->categories as $childCategory)
            @include('categories.child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
