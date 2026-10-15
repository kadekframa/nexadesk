<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    @php
        $user = auth()->user();
        $hour = now()->hour;
        $greeting = match (true) {
            $hour < 4 => 'Selamat malam',
            $hour < 11 => 'Selamat pagi',
            $hour < 15 => 'Selamat siang',
            $hour < 18 => 'Selamat sore',
            default => 'Selamat malam',
        };
        $steps = [
            [
                'icon' => 'element-plus',
                'title' => 'Buat halaman baru',
                'text' => 'Tambahkan route di dalam grup middleware auth, lengkap dengan controller dan view-nya.',
                'file' => 'routes/web.php',
            ],
            [
                'icon' => 'menu',
                'title' => 'Daftarkan menunya',
                'text' => 'Atur label, ikon, dan hak akses (Gate) menu yang tampil di sidebar.',
                'file' => 'config/menu.php',
            ],
            [
                'icon' => 'element-11',
                'title' => 'Susun dashboard',
                'text' => 'Ganti isi halaman ini dengan ringkasan data yang Anda butuhkan.',
                'file' => 'resources/views/home.blade.php',
            ],
        ];
    @endphp

    @push('styles')
        <style>
            /* Kartu sapaan. Palet di public/assets/css/nexadesk-theme.css */
            .nd-hero {
                position: relative;
                overflow: hidden;
                background: var(--nexadesk-gradient);
                box-shadow: 0 24px 48px -28px rgba(11, 36, 71, .65);
            }

            .nd-hero::before {
                content: "";
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(520px circle at 85% 15%, rgba(108, 180, 255, .35), transparent 60%),
                    radial-gradient(420px circle at 5% 120%, rgba(108, 180, 255, .18), transparent 60%);
            }

            /* Tekstur titik yang menebal ke kanan */
            .nd-hero::after {
                content: "";
                position: absolute;
                inset: 0;
                background-image: radial-gradient(rgba(255, 255, 255, .14) 1px, transparent 1px);
                background-size: 20px 20px;
                -webkit-mask-image: linear-gradient(90deg, transparent 15%, #000 75%);
                mask-image: linear-gradient(90deg, transparent 15%, #000 75%);
            }

            .nd-hero__rings {
                position: absolute;
                top: 50%;
                right: 9%;
                pointer-events: none;
            }

            .nd-hero__rings span {
                position: absolute;
                border: 1px solid rgba(255, 255, 255, .12);
                border-radius: 50%;
                transform: translate(50%, -50%);
            }

            .nd-hero__rings span:nth-child(1) { width: 220px; height: 220px; }
            .nd-hero__rings span:nth-child(2) { width: 360px; height: 360px; }
            .nd-hero__rings span:nth-child(3) { width: 500px; height: 500px; }

            .nd-hero .card-body {
                position: relative;
                z-index: 1;
            }

            .nd-hero__date {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                padding: .35rem .85rem;
                border: 1px solid rgba(255, 255, 255, .2);
                border-radius: 99px;
                background: rgba(255, 255, 255, .1);
                color: #ffffff;
                font-size: .85rem;
                font-weight: 600;
            }

            .nd-hero__badge {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                width: 6.5rem;
                height: 6.5rem;
                border: 1px solid rgba(255, 255, 255, .22);
                border-radius: 1.75rem;
                background: rgba(255, 255, 255, .1);
                -webkit-backdrop-filter: blur(6px);
                backdrop-filter: blur(6px);
                box-shadow: 0 20px 40px -20px rgba(4, 18, 40, .6);
            }

            .nd-hero__badge img {
                height: 3.75rem;
                border-radius: 22%;
            }

            /* Langkah memulai */
            .nd-step {
                height: 100%;
                padding: 1.5rem;
                border: 1px solid var(--nexadesk-soft-line);
                border-radius: 1rem;
                background: linear-gradient(180deg, var(--nexadesk-hover) 0%, transparent 100%);
                transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
            }

            .nd-step:hover {
                transform: translateY(-3px);
                border-color: var(--nexadesk-line);
                box-shadow: 0 18px 36px -24px rgba(11, 36, 71, .45);
            }

            .nd-step__icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 2.9rem;
                height: 2.9rem;
                border-radius: .9rem;
                background: var(--bs-primary-light);
                color: var(--nexadesk-accent);
            }

            .nd-step__no {
                font-family: Rubik, Inter, sans-serif;
                font-size: 1.6rem;
                font-weight: 600;
                line-height: 1;
                color: var(--bs-gray-300);
            }

            /* Plugin Keenicons memaksa ikon berwarna --bs-text-muted; ikut warna wadahnya saja. */
            .nd-step__icon .ki-duotone,
            .nd-hero__date .ki-duotone {
                color: inherit;
            }

            /* Menimpa gaya `code` bawaan Metronic (pink, berbayang, bermargin) */
            .nd-step code.nd-step__file {
                display: inline-block;
                margin: 0;
                padding: .3rem .6rem;
                border: 0;
                border-radius: .5rem;
                background: var(--bs-primary-light);
                box-shadow: none;
                color: var(--nexadesk-accent);
                font-size: .82rem;
                font-weight: 600;
            }
        </style>
    @endpush

    <!--begin::Hero-->
    <div class="card nd-hero nd-rise border-0 mb-6 mb-xl-8">
        <div class="nd-hero__rings" aria-hidden="true"><span></span><span></span><span></span></div>
        <div class="card-body p-8 p-lg-12">
            <div class="d-flex align-items-center justify-content-between gap-8">
                <div>
                    <span class="nd-hero__date">
                        {!! getIcon('calendar', 'fs-5') !!}
                        {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                    <h1 class="text-white fw-bolder fs-2x fs-lg-2hx mt-5 mb-2">{{ $greeting }}, {{ $user->name }} 👋</h1>
                    <p class="text-white opacity-75 fw-semibold fs-5 mb-0">
                        Senang melihat Anda kembali di {{ config('app.name') }}.
                    </p>
                </div>
                <div class="nd-hero__badge d-none d-md-flex">
                    <img src="{{ asset(config('settings.KT_THEME_ASSETS.logo')) }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!--end::Hero-->

    <!--begin::Getting started-->
    <div class="card nd-rise" style="animation-delay: .08s">
        <div class="card-header border-0 pt-7">
            <div class="card-title flex-column align-items-start">
                <h3 class="fw-bold text-gray-900 fs-3 mb-1">Mulai mengembangkan {{ config('app.name') }}</h3>
                <span class="text-gray-500 fw-semibold fs-6">Tiga langkah untuk menambahkan modul pertama Anda.</span>
            </div>
        </div>
        <div class="card-body pt-4 pb-8">
            <div class="row g-5">
                @foreach ($steps as $step)
                    <div class="col-md-4">
                        <div class="nd-step">
                            <div class="d-flex align-items-start justify-content-between mb-5">
                                <span class="nd-step__icon">{!! getIcon($step['icon'], 'fs-2') !!}</span>
                                <span class="nd-step__no">{{ sprintf('%02d', $loop->iteration) }}</span>
                            </div>
                            <div class="fw-bold text-gray-900 fs-5 mb-2">{{ $step['title'] }}</div>
                            <div class="text-gray-600 fw-semibold fs-7 mb-5">{{ $step['text'] }}</div>
                            <code class="nd-step__file">{{ $step['file'] }}</code>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Getting started-->
</x-default-layout>
