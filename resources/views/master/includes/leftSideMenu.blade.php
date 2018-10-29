<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img width="48px" height="48px" class="app-sidebar__user-avatar" src="{{ asset('storage/'.Auth::user()->profile->picture) }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ mb_strimwidth(Auth::user()->name, 0, 18, "...") }}</p>
            <p class="app-sidebar__user-designation"><i class="fa fa-phone-square"></i><span class="m-sm-2">{{ Auth::user()->profile->hp }}</span></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><span class="app-menu__item">MAIN NAVIGATION</span></li>

        <li><a class="app-menu__item {{ Request::path() == '/' ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li><a class="app-menu__item {{ Request::path() == 'product/listing' ? 'active' : '' }}" href="{{ route('products') }}"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Purchase Products</span></a></li>

        <li><a class="app-menu__item {{ Request::path() == 'purchase-history' ? 'active' : '' }}" href="{{ route('history') }}"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Purchase History</span></a></li>

        <li><a class="app-menu__item {{ Request::path() == 'team' ? 'active' : '' }}" href="{{ route('team') }}"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Team Members</span></a></li>


        {{--Admin menu--}}

        @if(Auth::user()->admin == 1)
        <li><span class="app-menu__item">ADMIN NAVIGATION</span></li>

        <li><a class="app-menu__item {{ Request::path() == 'item' ? 'active' : '' }}" href="{{ route('item.index') }}"><i class="app-menu__icon fa fa-first-order"></i><span class="app-menu__label">Item</span></a></li>

        <li><a class="app-menu__item {{ Request::path() == 'orders' ? 'active' : '' }}" href="{{ route('order.index') }}"><i class="app-menu__icon fa fa-shopping-bag"></i><span class="app-menu__label">Orders</span></a></li>

        <li><a class="app-menu__item {{ Request::path() == 'transactions' ? 'active' : '' }}" href="{{ route('transactions') }}"><i class="app-menu__icon fa fa-credit-card"></i><span class="app-menu__label">Transaction Details</span></a></li>

        <li><a class="app-menu__item {{ Request::path() == 'user' ? 'active' : '' }}" href="{{ route('user.index') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Users &amp; Roles</span></a></li>
        @endif
    </ul>
</aside>