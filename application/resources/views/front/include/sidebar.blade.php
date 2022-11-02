<!-- main sidebar area start here  -->
<aside class="main-sidebar">
    <div class="sidebar-wraper">
        <div class="logo-area">
            <a href="{{ route('main.dashboard') }}"><img src="{{ asset('front/assets/images/logo.png') }}" alt="logo" /></a>
        </div>
        <nav class="primary-menu">
            <ul id="metismenu">
                {{-- <li class="clinic"><a href="#"><i class="flaticon-hospital"></i> {{ session()->get('clinic_name') }}</a></li> --}}
                <li class="{{ Route::is('main.dashboard', 'main.dashboard.*') ? 'current-menu-item' : '' }}"><a href="{{ route('main.dashboard') }}" ><i class="flaticon-home"></i> {{ trans('Home') }}</a></li>

                <li class="{{ Route::is('clinicals.*', 'patient.*') ? 'current-menu-item' : '' }}"><a href="{{ route('clinicals.index') }}"><i class="flaticon-accident"></i> {{ __('Clinic Flow') }}</a></li>
                {{-- <li class="{{ Route::is('order.*') ? 'current-menu-item' : '' }}"><a href="{{ route('order.index') }}"> <i class="fa fa-shopping-cart"></i> Orders</a></li> --}}
                <li class="{{ Route::is('inventory.*') ? 'current-menu-item' : '' }}"><a href="{{ route('inventory.index') }}"> <i class="flaticon-clipboard"></i> {{ __('Inventory') }}</a></li>
                <li class="{{ Route::is('suppliment.*') ? 'current-menu-item' : '' }}"><a href="{{ route('suppliment.index') }}"> <i class="fa fa-h-square"></i> {{ __('Supplements') }}</a></li>
                <li class="{{ Route::is('profile.*') ? 'current-menu-item' : '' }}"><a href="{{ route('profile.show') }}"><i class="flaticon-user"></i> {{ __('Profile') }}</a></li>
                <li class="{{ Route::is('settings') ? 'current-menu-item' : '' }}"><a href="{{ route('settings') }}"><i class="flaticon-settings"></i> {{ __('Settings') }}</a></li>
            </ul>
        </nav>
    </div>
    <div class="text-box text-center">
        <p>{{ __('Need any help to contact support.') }}</p>
        <a href="#" class="primary-btn" data-toggle="modal" data-target="#Contactadmin">{{ __('Contact') }}</a>
    </div>
</aside>
