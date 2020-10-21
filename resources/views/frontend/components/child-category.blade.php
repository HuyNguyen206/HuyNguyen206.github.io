@if($parentC->childCategory()->count() > 0)
    <ul role="menu" class="sub-menu">
        @foreach ($parentC->childCategory as $child)
            <li>
                <a href="shop.html">{{$child->name}}</a>
                @include('frontend.components.child-category', ['parentC' => $child])
            </li>

        @endforeach
    </ul>
@endif
