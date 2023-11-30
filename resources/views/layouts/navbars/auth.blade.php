<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('images/LGM.png') }}">
            </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            {{ __('LGM TRAVEL') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @if(auth()->user()->role == 'admin')
            <li class="{{ $elementActive == 'staff' ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Staff Management') }}</p>
                </a>
            </li>
            @endif
            <li class="{{ $elementActive == 'package' ? 'active' : '' }}">
                <a href="{{ route('packages.index') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Package Management') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'booking' ? 'active' : '' }}">
                <a href="{{ route('booking.index') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Booking Management') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'customer' ? 'active' : '' }}">
                <a href="{{ route('users.customers') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Customer Management') }}</p>
                </a>
            </li>
            
           
        </ul>
    </div>
</div>
