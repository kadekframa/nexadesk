<x-auth-layout>
    @section('title')
        Masuk
    @endsection

    @push('styles')
        <style>
            /* Halaman login. Warna dasar mengikuti public/assets/css/nexadesk-theme.css */
            .nd-auth {
                --nd-bg: #f3f6fb;
                --nd-glow-1: rgba(32, 82, 149, .20);
                --nd-glow-2: rgba(108, 180, 255, .32);
                --nd-dot: rgba(11, 36, 71, .07);
                --nd-ring: rgba(32, 82, 149, .09);
                --nd-card-bg: rgba(255, 255, 255, .88);
                --nd-card-border: rgba(32, 82, 149, .10);
                --nd-input-bg: #f7f9fc;
                --nd-input-bg-focus: #ffffff;
                --nd-input-border: #e2e8f2;
                --nd-accent: var(--nexadesk-bright);

                position: relative;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 2.5rem 1.25rem;
                overflow: hidden;
                background:
                    radial-gradient(640px circle at 12% 8%, var(--nd-glow-1), transparent 62%),
                    radial-gradient(720px circle at 88% 92%, var(--nd-glow-2), transparent 62%),
                    var(--nd-bg);
            }

            [data-bs-theme="dark"] .nd-auth {
                --nd-bg: #0a1120;
                --nd-glow-1: rgba(32, 82, 149, .45);
                --nd-glow-2: rgba(108, 180, 255, .16);
                --nd-dot: rgba(255, 255, 255, .05);
                --nd-ring: rgba(108, 180, 255, .09);
                --nd-card-bg: rgba(17, 25, 41, .88);
                --nd-card-border: rgba(255, 255, 255, .07);
                --nd-input-bg: rgba(255, 255, 255, .03);
                --nd-input-bg-focus: rgba(255, 255, 255, .05);
                --nd-input-border: rgba(255, 255, 255, .10);
                --nd-accent: #6cb4ff;
            }

            /* Tekstur titik halus yang memudar ke tepi layar */
            .nd-auth::before {
                content: "";
                position: absolute;
                inset: 0;
                background-image: radial-gradient(var(--nd-dot) 1px, transparent 1px);
                background-size: 22px 22px;
                -webkit-mask-image: radial-gradient(ellipse 60% 55% at 50% 50%, #000 30%, transparent 100%);
                mask-image: radial-gradient(ellipse 60% 55% at 50% 50%, #000 30%, transparent 100%);
                pointer-events: none;
            }

            /* Cincin konsentris di belakang kartu */
            .nd-auth__rings {
                position: absolute;
                top: 50%;
                left: 50%;
                pointer-events: none;
            }

            .nd-auth__rings span {
                position: absolute;
                border: 1px solid var(--nd-ring);
                border-radius: 50%;
                transform: translate(-50%, -50%);
            }

            .nd-auth__rings span:nth-child(1) { width: 640px; height: 640px; }
            .nd-auth__rings span:nth-child(2) { width: 920px; height: 920px; }
            .nd-auth__rings span:nth-child(3) { width: 1200px; height: 1200px; }

            .nd-auth__main {
                position: relative;
                z-index: 1;
                width: 100%;
                max-width: 440px;
                animation: nd-rise .55s cubic-bezier(.2, .7, .2, 1) both;
            }

            @keyframes nd-rise {
                from { opacity: 0; transform: translateY(14px); }
                to { opacity: 1; transform: none; }
            }

            .nd-auth__brand {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: .75rem;
                margin-bottom: 1.75rem;
            }

            .nd-auth__brand img {
                height: 44px;
                border-radius: 22%;
                box-shadow: 0 8px 20px -6px rgba(11, 36, 71, .45);
            }

            .nd-auth__brand span {
                font-family: Rubik, Inter, sans-serif;
                font-size: 1.6rem;
                font-weight: 600;
            }

            .nd-auth__card {
                background: var(--nd-card-bg);
                border: 1px solid var(--nd-card-border);
                border-radius: 1.25rem;
                padding: 2.5rem 2.25rem;
                box-shadow: 0 30px 60px -20px rgba(11, 36, 71, .25), 0 2px 6px rgba(11, 36, 71, .04);
                -webkit-backdrop-filter: blur(14px);
                backdrop-filter: blur(14px);
            }

            /* Input berikon */
            .nd-field {
                position: relative;
            }

            .nd-field__icon {
                position: absolute;
                top: 50%;
                left: 1rem;
                transform: translateY(-50%);
                font-size: 1.35rem;
                color: var(--bs-gray-500);
                pointer-events: none;
                transition: color .15s ease;
            }

            .nd-field .form-control {
                height: 3.1rem;
                padding-left: 2.9rem;
                border-radius: .85rem;
                background-color: var(--nd-input-bg);
                border-color: var(--nd-input-border);
                transition: border-color .15s ease, box-shadow .15s ease, background-color .15s ease;
            }

            .nd-field .form-control:focus {
                background-color: var(--nd-input-bg-focus);
                border-color: var(--nd-accent);
                box-shadow: 0 0 0 4px rgba(32, 82, 149, .12);
            }

            .nd-field:focus-within .nd-field__icon {
                color: var(--nd-accent);
            }

            /* Ikon bawaan Bootstrap untuk input tidak valid bertabrakan dengan tombol mata */
            .nd-field .form-control.is-invalid {
                background-image: none;
                border-color: var(--bs-form-invalid-border-color);
            }

            .nd-field .form-control.is-invalid:focus {
                border-color: var(--bs-form-invalid-border-color);
                box-shadow: 0 0 0 4px rgba(var(--bs-danger-rgb), .12);
            }

            .nd-field .form-control.is-invalid ~ .nd-field__icon {
                color: var(--bs-danger);
            }

            .nd-field .form-control.nd-field__input--toggle {
                padding-right: 3rem;
            }

            .nd-toggle {
                position: absolute;
                top: 50%;
                right: .5rem;
                transform: translateY(-50%);
                display: inline-flex;
                padding: .4rem;
                border: 0;
                border-radius: .6rem;
                background: transparent;
                color: var(--bs-gray-500);
                line-height: 1;
            }

            .nd-toggle:hover,
            .nd-toggle:focus-visible {
                color: var(--nd-accent);
                background: rgba(32, 82, 149, .08);
            }

            .nd-auth .nd-submit {
                height: 3.1rem;
                border-radius: .85rem;
                font-weight: 600;
            }

            .nd-submit__arrow {
                transition: transform .2s ease;
            }

            .nd-submit:hover .nd-submit__arrow {
                transform: translateX(3px);
            }

            .nd-auth__footer {
                margin-top: 1.75rem;
                text-align: center;
                font-size: .85rem;
            }

            @media (max-width: 575.98px) {
                .nd-auth__card {
                    padding: 2rem 1.5rem;
                }

                .nd-auth__rings {
                    display: none;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                .nd-auth__main {
                    animation: none;
                }
            }
        </style>
    @endpush

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="nd-auth">
            <div class="nd-auth__rings" aria-hidden="true"><span></span><span></span><span></span></div>

            <main class="nd-auth__main">
                <!--begin::Brand-->
                <div class="nd-auth__brand">
                    <img src="{{ asset(config('settings.KT_THEME_ASSETS.logo')) }}" alt="" />
                    <span class="text-gray-900">{{ config('app.name') }}</span>
                </div>
                <!--end::Brand-->

                <!--begin::Card-->
                <div class="nd-auth__card">
                    <div class="mb-8">
                        <h1 class="text-gray-900 fw-bold fs-2 mb-2">Selamat datang kembali</h1>
                        <div class="text-gray-500 fw-semibold fs-6">
                            Masuk ke akun {{ config('app.name') }} Anda untuk melanjutkan.
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form method="POST" action="{{ route('login') }}" id="nd_login_form" novalidate>
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="form-label fw-semibold text-gray-800 fs-7 mb-2">Email</label>
                            <div class="nd-field">
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    placeholder="nama@email.com" autocomplete="username" required
                                    @if (!old('email')) autofocus @endif
                                    class="form-control @error('email') is-invalid @enderror" />
                                {!! getIcon('sms', 'nd-field__icon') !!}
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label fw-semibold text-gray-800 fs-7 mb-2">Password</label>
                            <div class="nd-field">
                                <input id="password" type="password" name="password" placeholder="Masukkan password"
                                    autocomplete="current-password" required
                                    @if (old('email')) autofocus @endif
                                    class="form-control nd-field__input--toggle @error('password') is-invalid @enderror" />
                                {!! getIcon('lock', 'nd-field__icon') !!}
                                <button type="button" class="nd-toggle" data-nd-toggle-password="password"
                                    aria-label="Tampilkan password" aria-pressed="false">
                                    {!! getIcon('eye', 'fs-2 nd-toggle__show') !!}
                                    {!! getIcon('eye-slash', 'fs-2 nd-toggle__hide d-none') !!}
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-8">
                            <label class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" name="remember" value="1"
                                    @checked(old('remember')) />
                                <span class="form-check-label text-gray-700 fw-semibold">Ingat saya</span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 nd-submit" id="nd_login_submit">
                            <span class="indicator-label">
                                Masuk {!! getIcon('arrow-right', 'fs-3 ms-1 nd-submit__arrow') !!}
                            </span>
                            <span class="indicator-progress">
                                Memproses...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </form>
                    <!--end::Form-->

                    <div class="text-center text-gray-500 fw-semibold fs-7 mt-8">
                        Belum punya akun? Hubungi administrator {{ config('app.name') }}.
                    </div>
                </div>
                <!--end::Card-->

                <div class="nd-auth__footer text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}</div>
            </main>
        </div>
    </div>
    <!--end::Root-->

    @push('scripts')
        <script>
            // Tampilkan / sembunyikan password
            document.querySelectorAll('[data-nd-toggle-password]').forEach(function (button) {
                var input = document.getElementById(button.dataset.ndTogglePassword);

                button.addEventListener('click', function () {
                    var show = input.type === 'password';

                    input.type = show ? 'text' : 'password';
                    button.setAttribute('aria-pressed', show);
                    button.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
                    button.querySelector('.nd-toggle__show').classList.toggle('d-none', show);
                    button.querySelector('.nd-toggle__hide').classList.toggle('d-none', !show);
                    input.focus();
                });
            });

            // Indikator "Memproses..." sekaligus mencegah form terkirim dua kali
            document.getElementById('nd_login_form').addEventListener('submit', function () {
                var submit = document.getElementById('nd_login_submit');

                submit.setAttribute('data-kt-indicator', 'on');
                submit.disabled = true;
            });
        </script>
    @endpush
</x-auth-layout>
