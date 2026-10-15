<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
    data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <span class="nd-avatar nd-avatar--lg me-4">{{ auth()->user()->initials }}</span>
            <div class="d-flex flex-column min-w-0">
                <span class="fw-bold fs-6 text-gray-900 text-truncate">{{ auth()->user()->name }}</span>
                <span class="fw-semibold fs-7 text-muted text-truncate">{{ auth()->user()->email }}</span>
            </div>
        </div>
    </div>
    <!--end::Menu item-->
    <div class="separator my-2"></div>
    <!--begin::Menu item-->
    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
        <a href="#" class="menu-link px-5">
            <span class="menu-icon">
                {!! getIcon('night-day', 'fs-3 theme-light-show') !!}
                {!! getIcon('moon', 'fs-3 theme-dark-show') !!}
            </span>
            <span class="menu-title">Mode tampilan</span>
            <span class="menu-arrow"></span>
        </a>
        @include('partials/theme-mode/__menu')
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a class="menu-link px-5" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="menu-icon">{!! getIcon('exit-right', 'fs-3') !!}</span>
            <span class="menu-title">Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
