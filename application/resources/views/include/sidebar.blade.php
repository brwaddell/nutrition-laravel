<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand " href="{{route('dashboard')}}">
            <div class="logo-img">
                <img src="{{isset($site->image1) ? asset(path_site_logo_image(). $site->image1) : asset('front/assets/images/logo.png')}}" class="header-brand-img" title="Hospital">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    $segment3 = request()->segment(3);
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment2 == 'users') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Users')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->)
                        <a href="{{route('users.admins.index', 'admins')}}" class="menu-item {{ ($segment3 == 'admins') ? 'active' : '' }}">{{ __('Admin')}}</a>
                        <a href="{{route('users.admins.index', 'doctors')}}" class="menu-item {{ ($segment3 == 'doctors') ? 'active' : '' }}">{{ __('Doctor')}}</a>
                        <a href="{{route('users.admins.index', 'medical-assistants')}}" class="menu-item {{ ($segment3 == 'medical-assistants') ? 'active' : '' }}">{{ __('Medical Assistant')}}</a>
                        <a href="{{route('users.admins.index', 'pharmasists')}}" class="menu-item {{ ($segment3 == 'pharmasists') ? 'active' : '' }}">{{ __('Pharmacist')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment2 == 'patients') ? 'active open' : '' }}">
                    <a href="{{ route('patient.index') }}"><i class="ik ik-user"></i><span>{{ __('Patients')}}</span></a>
                </div>
                {{-- <div class="nav-item {{ ($segment2 == 'users') ? 'active' : '' }}">
                    <a href="{{route('users.index')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('User')}}</span></a>
                </div> --}}
                <div class="nav-item {{ ($segment2 == 'clinics') ? 'active' : '' }}">
                    <a href="{{route('clinic.index')}}"><i class="fa fa-hospital"></i><span>{{ __('Clinics')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment2 == 'vaccines') ? 'active' : '' }}">
                    <a href="{{route('vaccine.index')}}"><i class="fa fa-syringe"></i><span>{{ __('Vaccines')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment2 == 'messages') ? 'active' : '' }}">
                    <a href="{{route('messages.index')}}"><i class="fa fa-envelope"></i><span>{{ __('Messages')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment2 == 'site') ? 'active' : '' }}">
                    <a href="{{route('sites.create')}}"><i class="fa fa-cog"></i><span>{{ __('Site')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment2 == 'form') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="fa fa-rss-square"></i><span>{{ __('Add Public Health Question')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{route('publichealthquestion.form.index', 4)}}" class="menu-item {{ ($segment3 == 4) ? 'active' : '' }}">Agricultural Form</a>
                        <a href="{{route('publichealthquestion.form.index', 1)}}" class="menu-item {{ ($segment3 == 1) ? 'active' : '' }}">Intermittent Form</a>
                        <a href="{{route('publichealthquestion.form.index', 3)}}" class="menu-item {{ ($segment3 == 3) ? 'active' : '' }}">Material Health Form</a>
                        <a href="{{route('publichealthquestion.form.index', 2)}}" class="menu-item {{ ($segment3 == 2) ? 'active' : '' }}">Parental History Form</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment2 == 'languages') ? 'active' : '' }}">
                    <a href="{{route('languages.index')}}"><i class="fa fa-language"></i><span>{{ __('Add Language')}}</span></a>
                </div>

            </nav>
        </div>
    </div>
</div>
