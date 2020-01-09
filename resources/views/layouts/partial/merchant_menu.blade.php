<li class="nav-item {{ Request::is('merchant/product*')?'active':'' }}">
    <a class="nav-link" href="{{ route('merchant.product.index') }}">Product</a>
</li>

<li class="nav-item {{ Request::is('merchant/order*')?'active':'' }}">
    <a class="nav-link" href="{{ route('merchant.order.index') }}">Order</a>
</li>