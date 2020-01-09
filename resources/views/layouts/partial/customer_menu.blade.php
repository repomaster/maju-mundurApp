<li class="nav-item {{ Request::is('customer/rewards*')?'active':'' }}">
    <a class="nav-link" href="{{ route('customer.reward.index') }}">Reward</a>
</li>

<li class="nav-item {{ Request::is('customer/carts*')?'active':'' }}">
    <a class="nav-link" href="{{ route('customer.cart.index') }}">Cart</a>
</li>

<li class="nav-item {{ Request::is('customer/order*')?'active':'' }}">
    <a class="nav-link" href="{{ route('customer.order.index') }}">Order</a>
</li>