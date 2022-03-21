<div>
    <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-bag"></i>
        @if (Cart::instance('cart')->count() > 0)
            <span>{{ Cart::instance('cart')->count() }}</span>
        @endif
    </a>
</div>
