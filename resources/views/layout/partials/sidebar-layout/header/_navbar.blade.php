<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Theme mode-->
    <div class="app-navbar-item ms-1 ms-md-3">
        <button type="button" class="nd-icon-btn" data-nd-theme-toggle
            title="Ganti mode terang/gelap" aria-label="Ganti mode terang/gelap">
            {!! getIcon('moon', 'fs-2 theme-light-show') !!}
            {!! getIcon('night-day', 'fs-2 theme-dark-show') !!}
        </button>
    </div>
    <!--end::Theme mode-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-2 ms-md-3" id="kt_header_user_menu_toggle">
        <div class="nd-user-chip cursor-pointer" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <span class="nd-avatar">{{ auth()->user()->initials }}</span>
            <span class="nd-user-chip__text d-none d-md-flex flex-column lh-sm">
                <span class="fw-bold text-gray-900 fs-7 text-truncate">{{ auth()->user()->name }}</span>
                <span class="fw-semibold text-gray-500 fs-8 text-truncate">{{ auth()->user()->email }}</span>
            </span>
            <span class="nd-user-chip__caret d-none d-md-inline-block text-gray-500"></span>
        </div>
        @include('partials/menus/_user-account-menu')
    </div>
    <!--end::User menu-->
</div>
<!--end::Navbar-->

@push('scripts')
    <script>
        // Tombol cepat mode terang/gelap; pilihan di menu pengguna ikut tersinkron.
        document.querySelectorAll('[data-nd-theme-toggle]').forEach(function (button) {
            button.addEventListener('click', function () {
                var next = KTThemeMode.getMode() === 'dark' ? 'light' : 'dark';

                KTThemeMode.setMode(next, next);
            });
        });
    </script>
@endpush
