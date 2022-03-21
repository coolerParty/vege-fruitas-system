<div>
    <a href="{{ route('wishlist.index') }}"><i class="fa fa-heart"></i>
        @if (Cart::instance('wishlist')->count() > 0)
            <span>{{ Cart::instance('wishlist')->count() }}</span>
        @endif
    </a>
</div>
