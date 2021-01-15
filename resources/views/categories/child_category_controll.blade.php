<li>{{ $child_category->category_name }}</li>
@if ($child_category->categories)
    <ul>
        @foreach ($child_category->categories as $childCategory)
            @include('categories.child_category_controll', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
