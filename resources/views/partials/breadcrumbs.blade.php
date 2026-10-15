{{-- Breadcrumb hanya untuk halaman bertingkat; halaman satu level cukup diwakili judulnya. --}}
@if (count($breadcrumbs) > 1)
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        @foreach ($breadcrumbs as $breadcrumb)
            @unless ($loop->first)
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
            @endunless

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item text-muted">
                    <a href="{{ $breadcrumb->url }}" class="text-muted text-hover-primary">{{ $breadcrumb->title }}</a>
                </li>
            @else
                <li class="breadcrumb-item text-gray-700">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ul>
@endif
